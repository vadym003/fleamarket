<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Image;

class ImageController extends Controller
{
    //
    public function index(){
        $data['image'] = Image::all();
        return view('admin.image', $data);
    }
}
