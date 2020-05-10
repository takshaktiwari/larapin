<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function home()
    {
        if (Auth::user()->id != '3') {
            return redirect('admin/home');
        }
        return view('user/home');
    }


    public function index($value='')
    {
    	$users = User::paginate(25);
    	return view('admin/users/users')->with('users', $users);
    }

    public function create()
    {
    	return view('admin/users/user_create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name'		=>	'required',
    		'email'		=>	'required|unique:users,email',
    		'mobile'	=>	'required',
    		'password'	=>	'required',
    	]);

    	$data = $request->all();
    	if (isset($data['verified'])) {
    		$verified_at = date('Y-m-d H:i:s');
    	}else{
    		$verified_at = null;
    	}

    	$user = User::create([
		    		'name'		=>	$request->post('name'),
		    		'email'		=>	$request->post('email'),
		    		'password'	=>	\Hash::make($request->post('password')),
		    		'email_verified_at' => $verified_at,
                    'api_token' =>  \Str::random(80),
                    'role_id'   =>  '3'
		    	]);

    	\App\User_detail::create([
    		'user_id'	=>	$user->id,
    		'mobile'	=>	$request->post('mobile'),
    		'gender'	=>	$request->post('gender')
    	]);

    	return redirect('admin/users')
    				->withErrors('CREATED !! New User is successfully created');
    }

    public function edit($id)
    {
    	$user = User::find($id);
        if ($user->detail == '') {
            \App\User_detail::create(['user_id' => $user->id]);
        }
        $user = User::find($id);
        $roles = Role::orderBy('role_name', 'ASC')->get()->all();
    	return view('admin/users/user_edit')->with('user', $user)->with('roles', $roles);
    }

    public function destroy($id)
    {
    	$user = User::find($id);

    	if (!empty($user->detail)) {
    		$user->detail->delete();
    	}
    	$user->delete();

    	return redirect('admin/users')
    				->withErrors('DELETED !! User is successfully deleted');
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'name'		=>	'required',
    		'email'		=>	'required',
            'role_id'   =>  'required',
    	]);

    	$user = User::find($request->post('user_id'));

    	$data = $request->all();
    	if (isset($data['verified'])) {
    		if(empty($user->email_verified_at)){
    			$verified_at = date('Y-m-d H:i:s');
    		}else{
    			$verified_at = $user->email_verified_at;
    		}
    	}else{
    		$verified_at = null;
    	}

    	$object = [ 'name'		=>	$request->post('name'),
		    		'email'		=>	$request->post('email'),
                    'role_id'   =>  $request->post('role_id'),
		    		'email_verified_at' => $verified_at ];

		if (!empty($request->post('password'))) {
			$arr = ['password'	=>	\Hash::make($request->post('password'))];
			$object = array_merge($object, $arr);
		}
    	$user->update($object);

    	$user->detail->update([
				    		'mobile'	=>	$request->post('mobile'),
				    		'gender'	=>	$request->post('gender')
				    	]);

    	return redirect('admin/users')
    				->withErrors('UPDATED !! User is successfully updated');
    }
}
