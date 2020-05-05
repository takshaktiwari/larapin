<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index($value='')
    {
    	return view('admin/dashboard');
    }

    public function change_password()
    {
    	return view('admin/change_password');
    }

    public function change_password_do(Request $request)
    {
    	$request->validate([
    		'old_password'	=>	'required|min:6',
    		'new_password'	=>	'required|confirmed|min:6',
    	]);

    	if(\Hash::check($request->post('old_password'), Auth::user()->password)){
    		User::where('id', Auth::user()->id)
    				->update(['password' => \Hash::make($request->post('new_password'))]);

    		return redirect()->back()
    						->withErrors('SUCCESS !! Your Password is successfully changed');
    	}else{
    		return redirect()->back()
    						->withErrors('ERROR !! Your Old Password is not correct');
    	}
    }
}
