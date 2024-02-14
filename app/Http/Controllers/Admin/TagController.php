<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\Producttag;

class TagController extends Controller
{
    //
    public function index(){
        $data['tag'] = DB::table('tags')->orderby('tag_index','asc')->paginate(5);
        return view('admin.tag', $data);
    }

    public function addTag(Request $request){
        $this->validate($request, [
            'tag_name' => 'required',
            'tag_index' => 'required|numeric'
        ]);

        $tag_name = $request->input('tag_name');
        $tag_index = $request->input('tag_index');

        $tag = new Tag();
        $tag->tag_name = $tag_name;
        $tag->type = 0;
        $tag->tag_index = $tag_index;

        $tag->save();


        return redirect('admin/tag')->with('status', 'New Tag Form Data Has Been Inserted');
    }

    public function editTag(Request $request){
        $this->validate($request, [
            'tagid' => 'required',
            'tagname' => 'required',
            'tagindex' => 'required|numeric',
        ]);

        $tagid = $request->input('tagid');
        $tag_name = $request->input('tagname');
        $tag_index = $request->input('tagindex');
        
        if($tag_index == ""){
            $tag_index = 0;
        }

        $tag = Tag::where('tagid',$tagid)->update(['tag_name'=>$tag_name, 'tag_index'=>$tag_index]);

        $request->session()->flash('status', 'Success Changed Tag data.');
        return response()->json( true);

    }

    public function deleteTag(Request $request){
        $this->validate($request, [
            'tagid' => 'required',
        ]);

        $tagid = $request->input('tagid');

        $products = Producttag::where('tag_id',$tagid)->first();
        if(!empty($products)){
            return response()->json("This Tag is used in Porudcts. Please check.");
        }

        $category = Tag::where('tagid',$tagid)->delete();
        $request->session()->flash('status', 'Success deleted Tag data.');
        return response()->json( true);

    }
}
