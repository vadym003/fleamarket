<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Image;
use App\Models\Productimage;
use App\Models\Producttag;

class FleamarketController extends Controller
{
    //
    public function index(Request $request)
    {
        $type = 1;
        $catlist = Category::all();
        $data['category'] = $catlist;
        $taglist = Tag::all();
        $data['tag'] = $taglist;
        $seltag = $request->input('category');

        if(!empty($seltag)){
            // $products = Product::whereIn('id', function($query) use ($seltag){
            //     $query->select(['product_id'])->from('producttags')->where('tag_id',$seltag);
            // })->paginate(5);
            //$products = Product::where('cat_id', $seltag)->where('type',$type)->paginate(5);
            $products = DB::table('products')
                    ->select('products.*', 'users.name')
                    ->join('users', 'products.user_id','=','users.id')
                    ->where('products.type',$type)
                    ->where('deleted',0)
                    ->where('cat_id',$seltag)
                    //->where('products.allowed_flg',1)
                    ->orderby('products.updated_at', 'desc')->paginate(20);
        }else{
            //$products = DB::table('products')->where('type',$type)->paginate(5);
            $products = DB::table('products')
                    ->select('products.*', 'users.name')
                    ->join('users', 'products.user_id','=','users.id')
                    ->where('products.type',$type)
                    ->where('deleted',0)
                    //->where('products.allowed_flg',1)
                    ->orderby('products.updated_at', 'desc')->paginate(20);
        }

        if(!empty($products)){
            // $products = $products->map(function ($item){
            //     $images = DB::table('images')
            //         ->select('image_url', 'image_type')
            //         ->join('productimages', 'productimages.image_id','=','images.id')
            //         ->where('productimages.product_id',$item->id)
            //         ->orderby('productimages.image_index', 'asc')->first();
                
            //     if(!empty($images)){
            //         $item->image_url = $images->image_url;
            //         $item->image_type = $images->image_type;
            //     }else{
            //         $item->image_url = '';
            //         $item->image_type = '';
            //     }
            //     return $item;
            // });
            foreach($products as $item){
                $images = DB::table('images')
                    ->select('image_url', 'image_type')
                    ->join('productimages', 'productimages.image_id','=','images.id')
                    ->where('productimages.product_id',$item->id)
                    ->orderby('productimages.image_index', 'asc')->first();
                
                if(!empty($images)){
                    $item->image_url = $images->image_url;
                    $item->image_type = $images->image_type;
                }else{
                    $item->image_url = '';
                    $item->image_type = '';
                }
            }
        }
        
        $data['products'] = $products;
        //var_dump($products);
        $data['userid'] = Auth::user()->id;
        return view('user.fleamarket', $data);
    }

    public function addfleamarketpage(Request $request)
    {
        $catlist = Category::all();
        $data['category'] = $catlist;
        $taglist = Tag::all();
        $data['tag'] = $taglist;

        $productid = $request->input('product');
        if($productid != "" || $productid != 0){
            $data['productid'] = $productid;
            $product_no = $productid;

            $products = DB::table('products')
                        ->leftjoin('categories', 'products.cat_id', '=', 'categories.catid')
                        ->leftjoin('users', 'users.id', '=', 'products.user_id')
                        ->select('products.*','users.name','users.email', 'categories.cat_name')
                        ->where('products.id', $product_no)
                        ->first();

            $images = DB::table('images')
                        ->select('image_url', 'image_type','productimages.id', 'productimages.product_id', 'productimages.image_id')
                        ->join('productimages', 'productimages.image_id','=','images.id')
                        ->where('productimages.product_id',$product_no)
                        ->where('images.image_type', '0')
                        ->where('productimages.deleted', '0')
                        ->orderby('productimages.image_index', 'asc')->get();
            
            $files = DB::table('images')
                        ->select('image_url', 'image_type','productimages.id', 'productimages.product_id', 'productimages.image_id')
                        ->join('productimages', 'productimages.image_id','=','images.id')
                        ->where('productimages.product_id',$product_no)
                        ->where('images.image_type', '2')
                        ->where('productimages.deleted', '0')
                        ->orderby('productimages.image_index', 'asc')->get();
            
            
            $tags = DB::table('producttags')
                        ->join('tags', 'tags.tagid','=','producttags.tag_id')
                        ->select('producttags.product_id','tags.*' )
                        ->where('producttags.product_id', $product_no)
                        ->get();
            $data['product'] = $products;
            $data['image'] = $images;
            if(!empty($tags)){
                foreach($taglist as $item){
                    $item->selected = false;
                    foreach($tags as $titem){
                        if($item->tagid == $titem->tagid){
                            $item->selected = true;
                            break;
                        }
                    }
                }
            }
            $data['tags'] = $tags;
            $data['file'] = $files;
            return view('user.editfleamarket', $data);
        }else{
            $data['productid'] = 0;
            return view('user.addfleamarket', $data);
        }
        
        return view('user.addfleamarket', $data);
    }

    public function addfleamarket(Request $request)
    {

        $this->validate($request, [
            'filenames.*' => 'mimes:png,jpg,bmp',
            'p_name' => 'required|max:255',
            'p_price' => 'required|numeric',
            'p_amount' => 'required|numeric'
        ]);

        $p_name = $request->input('p_name'); //product name
        $p_price = $request->input('p_price'); //product price
        $p_amount = $request->input('p_amount'); //product amount
        $p_devlang = $request->input('p_devlang'); //product development Language
        $p_language = $request->input('p_language'); //product suported Language
        $p_service = $request->input('p_service'); //product service
        $p_install = $request->input('p_install'); //product Free Service
        $p_description = $request->input('p_description'); //product Description
        $p_shortdesc = $request->input('p_shortdesc'); //product Short Description
        $p_features = $request->input('p_features'); //product Features
        $category = $request->input('category'); //Product Category
        $tags = $request->input('tag'); //Product Tags

        $newproduct = new Product();
        $newproduct->product_name = $p_name;
        $newproduct->cat_id = $category; 
        $newproduct->user_id = Auth::user()->id;
        $newproduct->description = $p_description;
        $newproduct->shortdescription = $p_shortdesc;
        $newproduct->features = $p_features;
        $newproduct->price = $p_price;
        $newproduct->type = 1; //others
        $newproduct->amount = $p_amount;
        $newproduct->deleted = 0;
        $newproduct->allow_flg = 0;
        $newproduct->dev_language = $p_devlang;
        $newproduct->language = $p_language;
        $newproduct->service = $p_service;
        $newproduct->install = $p_install;
        $newproduct->others = '';
        $newproduct->testflg = 0;
        $newproduct->save();
        $newpid = $newproduct->id;

        //Product Image file.
        $files = [];
        if($request->hasfile('filenames'))
        {
            $index = 1;
            foreach($request->file('filenames') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('img'), $name);  
                $files[] = $name;  
                $newimage = new Image();
                $newimage->image_url = $name;
                $newimage->image_type = 0;//0: local, 1:url
                $newimage->image_name = $p_name.$index++." image file ";
                $newimage->save();
                $newimageid = $newimage->id;

                if($newimageid > 0){
                    $productimg = new Productimage();
                    $productimg->product_id = $newpid;
                    $productimg->image_id = $newimageid;
                    $productimg->image_index = $index++;
                    $productimg->save();
                }

            }
        }

        //Product file.
        $procfiles = [];
        if($request->hasfile('prodfilenames'))
        {
            $index = 1;
            foreach($request->file('prodfilenames') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('prodfile'), $name);  
                $files[] = $name;  
                $newimage = new Image();
                $newimage->image_url = $name;
                $newimage->image_type = 2;//0: local, 1:url, 2: product file.
                $newimage->image_name = $p_name.$index++." Product file ";
                $newimage->save();
                $newimageid = $newimage->id;

                if($newimageid > 0){
                    $productimg = new Productimage();
                    $productimg->product_id = $newpid;
                    $productimg->image_id = $newimageid;
                    $productimg->image_index = $index++;
                    $productimg->save();
                }
            }
        }
        

        if(!empty($tags)){
            foreach($tags as $value){
                $newtags = new Producttag();
                $newtags->product_id = $newpid;
                $newtags->tag_id = $value;
                $newtags->save();
            }
        }
   
        $catlist = Category::all();
        $data['category'] = $catlist;
        $taglist = Tag::all();
        $data['tag'] = $taglist;
      
        $request->session()->flash('status', 'Success Added data.');
        
        return view('user.addfleamarket', $data);
        //return redirect('fleamarket')->with('status', 'New Product Form Data Has Been inserted');
    }

    public function fleamarketdetail(Request $request)
    {
        $product_no = $request->input('product');

        $products = DB::table('products')
                    ->leftjoin('categories', 'products.cat_id', '=', 'categories.catid')
                    ->leftjoin('users', 'users.id', '=', 'products.user_id')
                    ->select('products.*','users.name','users.email', 'categories.cat_name')
                    ->where('products.id', $product_no)
                    ->first();

        $images = DB::table('images')
                    ->select('image_url', 'image_type')
                    ->join('productimages', 'productimages.image_id','=','images.id')
                    ->where('productimages.product_id',$product_no)
                    ->where('images.image_type', '0')
                    ->orderby('productimages.image_index', 'asc')->get();
        
        $tags = DB::table('producttags')
                    ->join('tags', 'tags.tagid','=','producttags.tag_id')
                    ->select('producttags.product_id','tags.*' )
                    ->where('producttags.product_id', $product_no)
                    ->get();
        $data['product'] = $products;
        $data['image'] = $images;
        $data['tags'] = $tags;

        return view('user.fleamarketdetail', $data);
    }

    public function updatefleamarket(Request $request){
        $this->validate($request, [
            'filenames.*' => 'mimes:png,jpg,bmp',
            'p_name' => 'required|max:255',
            'p_price' => 'required|numeric',
            'p_amount' => 'required|numeric'
        ]);

        $p_id = $request->input('productid');
        $p_name = $request->input('p_name'); //product name
        $p_price = $request->input('p_price'); //product price
        $p_amount = $request->input('p_amount'); //product amount
        $p_devlang = $request->input('p_devlang'); //product development Language
        $p_language = $request->input('p_language'); //product suported Language
        $p_service = $request->input('p_service'); //product service
        $p_install = $request->input('p_install'); //product Free Service
        $p_description = $request->input('p_description'); //product Description
        $p_shortdesc = $request->input('p_shortdesc'); //product Short Description
        $p_features = $request->input('p_features'); //product Features
        $category = $request->input('category'); //Product Category
        $tags = $request->input('tag'); //Product Tags

        $newproduct = Product::find($p_id);
        $newproduct->product_name = $p_name;
        $newproduct->cat_id = $category; 
        $newproduct->user_id = Auth::user()->id;
        $newproduct->description = $p_description;
        $newproduct->shortdescription = $p_shortdesc;
        $newproduct->features = $p_features;
        $newproduct->price = $p_price;
        $newproduct->type = 1; //others
        $newproduct->amount = $p_amount;
        $newproduct->deleted = 0;
        $newproduct->allow_flg = 0;
        $newproduct->dev_language = $p_devlang;
        $newproduct->language = $p_language;
        $newproduct->service = $p_service;
        $newproduct->install = $p_install;
        $newproduct->others = '';
        $newproduct->testflg = 0;
        $newproduct->save();
        $newpid = $p_id;

        //Product Image file.
        $files = [];
        if($request->hasfile('filenames'))
        {
            $index = 1;
            foreach($request->file('filenames') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('img'), $name);  
                $files[] = $name;  
                $newimage = new Image();
                $newimage->image_url = $name;
                $newimage->image_type = 0;//0: local, 1:url
                $newimage->image_name = $p_name.$index++." image file ";
                $newimage->save();
                $newimageid = $newimage->id;

                if($newimageid > 0){
                    $productimg = new Productimage();
                    $productimg->product_id = $newpid;
                    $productimg->image_id = $newimageid;
                    $productimg->image_index = $index++;
                    $productimg->save();
                }

            }
        }

        //Product file.
        $procfiles = [];
        if($request->hasfile('prodfilenames'))
        {
            $index = 1;
            foreach($request->file('prodfilenames') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('prodfile'), $name);  
                $files[] = $name;  
                $newimage = new Image();
                $newimage->image_url = $name;
                $newimage->image_type = 2;//0: local, 1:url, 2: product file.
                $newimage->image_name = $p_name.$index++." Product file ";
                $newimage->save();
                $newimageid = $newimage->id;

                if($newimageid > 0){
                    $productimg = new Productimage();
                    $productimg->product_id = $newpid;
                    $productimg->image_id = $newimageid;
                    $productimg->image_index = $index++;
                    $productimg->save();
                }
            }
        }
        
        DB::table('producttags')->where('product_id', '=', $p_id)->delete();
        if(!empty($tags)){
            foreach($tags as $value){
                $newtags = new Producttag();
                $newtags->product_id = $newpid;
                $newtags->tag_id = $value;
                $newtags->save();
            }
        }
   
        $request->session()->flash('status', 'Success updated data.');

        $catlist = Category::all();
        $data['category'] = $catlist;
        $taglist = Tag::all();
        $data['tag'] = $taglist;
        $data['productid'] = $p_id;

        $productid = $p_id;
        if($productid != ""){
            $data['productid'] = $productid;
            $product_no = $productid;

            $products = DB::table('products')
                        ->leftjoin('categories', 'products.cat_id', '=', 'categories.catid')
                        ->leftjoin('users', 'users.id', '=', 'products.user_id')
                        ->select('products.*','users.name','users.email', 'categories.cat_name')
                        ->where('products.id', $product_no)
                        ->first();

            $images = DB::table('images')
                        ->select('image_url', 'image_type','productimages.id', 'productimages.product_id', 'productimages.image_id')
                        ->join('productimages', 'productimages.image_id','=','images.id')
                        ->where('productimages.product_id',$product_no)
                        ->where('images.image_type', '0')
                        ->where('productimages.deleted', '0')
                        ->orderby('productimages.image_index', 'asc')->get();
            
            $files = DB::table('images')
                        ->select('images.image_url', 'images.image_type','productimages.id', 'productimages.product_id', 'productimages.image_id')
                        ->join('productimages', 'productimages.image_id','=','images.id')
                        ->where('productimages.product_id',$product_no)
                        ->where('images.image_type', '2')
                        ->where('productimages.deleted', '0')
                        ->orderby('productimages.image_index', 'asc')->get();
            
            
            $tags = DB::table('producttags')
                        ->join('tags', 'tags.tagid','=','producttags.tag_id')
                        ->select('producttags.product_id','tags.*' )
                        ->where('producttags.product_id', $product_no)
                        ->get();

            if(!empty($tags)){
                foreach($taglist as $item){
                    $item->selected = false;
                    foreach($tags as $titem){
                        if($item->tagid == $titem->tagid){
                            $item->selected = true;
                            break;
                        }
                    }
                }
            }
            $data['product'] = $products;
            $data['image'] = $images;
            $data['tags'] = $tags;
            $data['file'] = $files;
            return view('user.editfleamarket', $data);
        }else{
            return view('user.addfleamarket', $data);
        }
        
        return view('user.addfleamarket', $data);
    }

    public function deletefiles(Request $request){
        $delpimgid = $request->input('delpimgid');
        if($delpimgid != 0){
            Productimage::where('id',$delpimgid)->update(['deleted'=>1,'deleted_at'=>now() ]);
            return response()->json( true );

        }
        return response()->json( false );

    }

    public function deleteproduct(Request $request){
        $delproid = $request->input('delprocid');
        if($delproid != 0){
            Product::where('id', $delproid)->update(['deleted'=>1,'deleted_at'=>now() ]);
            return response()->json( true);
        }
        return response()->json(false);
    }
}
