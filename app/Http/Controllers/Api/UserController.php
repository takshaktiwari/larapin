<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'name'		=>	'required',
			    		'email'		=>	'required|unique:users,email',
			    		'mobile'	=>	'required',
			    		'password'	=>	'required',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
	    	$user = User::create([
			    		'name'		=>	$request->input('name'),
			    		'email'		=>	$request->input('email'),
			    		'password'	=>	\Hash::make($request->input('password')),
	                    'api_token' =>  \Str::random(80),
			    	]);

	    	\App\User_detail::create([
	    		'user_id'	=>	$user->id,
	    		'mobile'	=>	$request->input('mobile'),
	    		'gender'	=>	$request->input('gender')
	    	]);



    		return User::with('detail')->find($user->id);
    	}
    	
    }
}
