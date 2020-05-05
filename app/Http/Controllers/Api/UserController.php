<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\UsersResource as UsersResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
    	$validation = validator($request->all(), [
			    		'name'		=>	'required',
			    		'email'		=>	'required|unique:users,email',
			    		'mobile'	=>	'required|unique:user_details,mobile',
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

    		return new UsersResource($user);
    	}
    }


    public function login(Request $request)
    {
        $validation = validator($request->all(), [
                            'email_mobile'  =>  'required',
                            'password'      =>  'required'
                        ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
        	$email_mobile = $request->input('email_mobile');
        	$user = User::where('email', $email_mobile)
        					->orWhere(function($query) use ($email_mobile){
        						$query->whereHas('detail', function($query) use ($email_mobile){
        							$query->where('mobile', $email_mobile);
        						});
        					})
        					->first();

        	if ($user) {
                if(\Hash::check($request->input('password'), $user->password)){
                    return new UsersResource($user);
                }else{
                    return response()->json('Authorization Failed');
                }
        	}else{
        		return response()->json('Authorization Failed');
        	}
        }
    }
}
