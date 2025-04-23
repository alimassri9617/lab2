<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignupandLogin extends Controller
{
    
    public function signup(Request $request)
    {
        $User=new User();
        $User->name=$request->name;
        $User->email=$request->email;
        $User->password=bcrypt($request->password);
        $User->role=$request->role;
        if($request->hasFile('image')){

            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/',$filename);
            $User->path=$filename;

            // $file=$request->file('profile_picture');
            // $filename=time().'.'.$file->getClientOriginalExtension();
            // $file->move('uploads/profile_pictures',$filename);
            // $User->profile_picture=$filename;

        }
        $User->save();

        if(User::where('email',$request->email)->exists()){
           return redirect()->to("/")->with('success','User Created Successfully');
        }else{
            return redirect()->to("/")->with('error','User Not Created');
    }
}
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } else if ($user->role === 'user') {
            return redirect()->route('user.dashboard')->with('success', 'Welcome!');
        } 
    } else {
        return redirect()->back()->with('error', 'Invalid Credentials');
    }
}

}