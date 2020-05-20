<?php

namespace App\Http\Controllers\Api;

use Auth;
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
			    		'mobile'	=>	'required|unique:users,mobile',
			    		'password'	=>	'required',
			    	]);

    	if ($validation->fails()) {
    		return $validation->errors();
    	}else{
	    	$user = User::create([
			    		'name'		=>	$request->input('name'),
			    		'email'		=>	$request->input('email'),
                        'mobile'    =>  $request->input('mobile'),
			    		'password'	=>	\Hash::make($request->input('password')),
	                    'api_token' =>  \Str::random(80),
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
                            ->orWhere('mobile', $email_mobile)
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

    public function change_password(Request $request)
    {
        $validation = validator($request->all(), [
                            'old_pwd'  =>  'required',
                            'new_pwd'  =>  'required'
                        ]);

        if ($validation->fails()) {
            return $validation->errors();
        }else{
            if (\Hash::check($request->input('old_pwd'), Auth::user()->password)) {
                Auth::user()->update(['password' => \Hash::make($request->input('new_pwd'))]);

                $msg = 'Password is succcessfuly changed';
            }else{
                $msg = 'Old password is not correct';
            }

            return response()->json(['data' => ['msg' => $msg]]);
        }
    }
}
