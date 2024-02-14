<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Invoice;

class CategoryController extends Controller
{
    //Category Management Controller.
    public function index(){

        $data['category'] = DB::table('categories')->orderby('cat_index','asc')->paginate(5);
        return view('admin.category', $data);
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'cat_name' => 'required',
            'cat_index' => 'required|numeric'
        ]);

        $cat_name = $request->input('cat_name');
        $cat_index = $request->input('cat_index');
        $parentcat = $request->input('parentcat');
        if($parentcat == ""){
            $parentcat = 0;
        }
        $category = new Category();
        $category->cat_name = $cat_name;
        $category->parent_cat = $parentcat;
        $category->type = 0;
        $category->cat_index = $cat_index;

        $category->save();


        return redirect('admin/category')->with('status', 'New Category Form Data Has Been Inserted');

    }

    public function editcategory(Request $request){
        $this->validate($request, [
            'catid' => 'required',
            'catname' => 'required',
            'catindex' => 'required|numeric',
        ]);

        $catid = $request->input('catid');
        $cat_name = $request->input('catname');
        $catindex = $request->input('catindex');
        $parentcat = 0;
        if($parentcat == ""){
            $parentcat = 0;
        }
        if($catindex == ""){
            $catindex = 0;
        }

        $category = Category::where('catid',$catid)->update(['cat_name'=>$cat_name, 'cat_index'=>$catindex]);

        $request->session()->flash('status', 'Success Changed Category data.');
        return response()->json( true);

    }

    public function deletecategory(Request $request){
        $this->validate($request, [
            'catid' => 'required',
        ]);

        $catid = $request->input('catid');

        $products = Product::where('cat_id',$catid)->first();
        if(!empty($products)){
            return response()->json("This category is used in Porudcts. Please check.");
        }

        $category = Category::where('catid',$catid)->delete();
        $request->session()->flash('status', 'Success deleted category data.');
        return response()->json( true);

    }
    
}
