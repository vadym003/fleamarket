<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Invoice;

class CategoryController extends Controller
{
    //Category Management Controller.
    public function index(){

        $data['category'] = DB::table('categories')->paginate(5);
        return view('admin.category', $data);
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'cat_name' => 'required',
        ]);

        $cat_name = $request->input('cat_name');
        $parentcat = $request->input('parentcat');
        if($parentcat == ""){
            $parentcat = 0;
        }
        $category = new Category();
        $category->cat_name = $cat_name;
        $category->parent_cat = $parentcat;
        $category->type = 0;
        $category->cat_index = 1;

        $category->save();


        return redirect('admin/category')->with('status', 'New Category Form Data Has Been inserted');

    }
    
}
