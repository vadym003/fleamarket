<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Image;
use App\Models\Productimage;
use App\Models\Producttag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
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
                    ->orderby('products.updated_at', 'desc')->take(4)->get();
        }else{
            //$products = DB::table('products')->where('type',$type)->paginate(5);
            $products = DB::table('products')
                    ->select('products.*', 'users.name')
                    ->join('users', 'products.user_id','=','users.id')
                    ->where('products.type',$type)
                    ->where('deleted',0)
                    //->where('products.allowed_flg',1)
                    ->orderby('products.updated_at', 'desc')->take(4)->get();
        }

        if(!empty($products)){
            foreach($products as $item){
                if(!empty($item)){
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
        }
        
        $data['products'] = $products;
        return view('home', $data);
    }
}
