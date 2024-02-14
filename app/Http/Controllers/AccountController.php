<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AccountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('user.account.user-account');
    }
    public function adminindex()
    {
        return view('admin.account.user-account');
    }
    public function adminaccountupdate(Request $request){
        $this->validate($request, [
            'avatar.*' => 'mimes:png,jpg,bmp',
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'price' => 'numeric',
            'phone' => 'max:15',
            'address' => 'max:255'
        ]);

        $userid = $request->input('userid'); //user name
        $username = $request->input('username'); //user name
        $email = $request->input('email'); //email
        $price = $request->input('price'); //price
        $phone = $request->input('phone'); //price
        $address = $request->input('address'); //address

        if($userid != ''){
            User::where('id',$userid)->update(['name'=>$username, 'email'=>$email,'address'=>$address, 'phone'=>$phone]);

            if($request->hasfile('avatar'))
            {
                echo 'a';
                $index = 1;
                
                $file = $request->file('avatar');
                    echo 'b';
                    var_dump($file);
                    $name = time().rand(1,100).'.'.$file->extension();
                    var_dump($userid);
                    $file->move(public_path('profile'), $name);  
                    User::where('id',$userid)->update(['image'=>$name]);

            }

        }

        return redirect('admin/overview')->with('status', 'Success Updated Profile');
    }

    public function accountupdate(Request $request){
        $this->validate($request, [
            'avatar.*' => 'mimes:png,jpg,bmp',
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'price' => 'numeric',
            'phone' => 'max:15',
            'address' => 'max:255'
        ]);

        $userid = $request->input('userid'); //user name
        $username = $request->input('username'); //user name
        $email = $request->input('email'); //email
        $price = $request->input('price'); //price
        $phone = $request->input('phone'); //price
        $address = $request->input('address'); //address

        if($userid != ''){
            User::where('id',$userid)->update(['name'=>$username, 'email'=>$email,'address'=>$address, 'phone'=>$phone]);

            if($request->hasfile('avatar'))
            {
                
                $index = 1;
                
                $file = $request->file('avatar');
                
                $name = time().rand(1,100).'.'.$file->extension();
                
                $file->move(public_path('profile'), $name);  
                User::where('id',$userid)->update(['image'=>$name]);

            }

        }

        return redirect('overview')->with('status', 'Success Updated Profile');
    }

    public function userlist()
    {
        $data['users'] = DB::table('users')->orderby('updated_at','desc')->paginate(5);
        return view('admin.account.userlist', $data);
    }
}
