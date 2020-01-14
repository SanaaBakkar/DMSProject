<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
     public function index()
    {
    	return view('settings.home');
    }

    public function EditUserProfile(Request $request,$id)
    {
    	$this->validate($request,[
                'name'=>'required',
                'email'=>'required'
            ]);
    	if(empty($request->input('confirm_password')))
    	{
    		    $data= array(
                'name'=>$request->input('name'),
                'email'=>$request->input('email')
                 );

            User::where('id',$id)->update($data);
            return back()->with('update','msg');

    	}else
    	{
    		if ($request->input('new_password') == $request->input('confirm_password')) 
    		{
    			$data= array(
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>bcrypt($request->input('new_password'))
                 );

    			User::where('id',$id)->update($data);
                return back()->with('update','msg');

    		}else
    		{
    			return back()->with('error', 'msg');
    		}
    	}

           
    }

}
