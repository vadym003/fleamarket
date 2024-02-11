<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagController extends Controller
{
    //
    public function index(){
        $data['tag'] = DB::table('tags')->paginate(5);
        return view('admin.tag', $data);
    }

    public function addTag(Request $request){
        $this->validate($request, [
            'tag_name' => 'required',
        ]);

        $tag_name = $request->input('tag_name');

        $tag = new Tag();
        $tag->tag_name = $tag_name;
        $tag->type = 0;
        $tag->tag_index = 1;

        $tag->save();


        return redirect('admin/tag')->with('status', 'New Tag Form Data Has Been inserted');
    }
}
