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
        if (!empty(Auth::user()->role->id) && Auth::user()->role->id != '3') {
            return redirect('admin/home');
        }
        return view('user/dashboard');
    }

    public function profile()
    {
        return view('user/user_profile');
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name'      =>  'required|max:150',
            'email'     =>  'required|max:150',
            'mobile'    =>  'required|digits:10',
            'user_img'  =>  'nullable|image'
        ]);

        $object = ['name'  =>  $request->input('name'),
                    'email'  =>  $request->input('email'),
                    'mobile' =>  $request->input('mobile')];

        $slug = str_replace(' ', '-', strtolower(trim(Auth::user()->id.'-'.Auth::user()->name)));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        if ($_FILES['user_img']['tmp_name'] != '') {
            $user_img = '/app/user/'.$slug.'.jpg';
            $img = \Image::make($_FILES['user_img']['tmp_name']);
            $img->resize(1000, null, function ($constraint) { 
                $constraint->aspectRatio();
            });
            $img->save(storage_path().$user_img, 80, 'jpg');

            $object = array_merge($object, ['user_img' => $user_img]);
        }

        Auth::user()->update($object);
        return redirect()->back()->withErrors('UPDATED !! Your profile is successfully updated');
    }

    public function change_password()
    {
        return view('user/change_password');
    }

    public function change_password_do(Request $request)
    {
        $request->validate([
            'old_password'  =>  'required',
            'new_password'  =>  'required|confirmed'
        ]);

        if (\Hash::check($request->input('old_password'), Auth::user()->password)) {
            Auth::user()->update(['password' => \Hash::make($request->input('new_password'))]);
            return redirect()->back()
                            ->withErrors('UPDATED !! Your password is successfully updated');

        }else{
            return redirect()->back()->withErrors('ERROR !! Old password is not correct');
        }
    }
    


    public function index($value='')
    {
        $this->authorize('user_access');
    	$users = User::paginate(25);
    	return view('admin/users/users')->with('users', $users);
    }

    public function create()
    {
        $this->authorize('user_create');
    	return view('admin/users/user_create');
    }

    public function store(Request $request)
    {
        $this->authorize('user_create');
    	$request->validate([
    		'name'		=>	'required',
    		'email'		=>	'required|unique:users,email',
    		'mobile'	=>	'required|unique:users,mobile',
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
                    'mobile'    =>  $request->post('mobile'),
		    		'password'	=>	\Hash::make($request->post('password')),
		    		'email_verified_at' => $verified_at,
                    'api_token' =>  \Str::random(80),
                    'role_id'   =>  '3'
		    	]);

    	return redirect('admin/users')
    				->withErrors('CREATED !! New User is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('user_update');
    	$user = User::find($id);
        $roles = Role::orderBy('role_name', 'ASC')->get()->all();
    	return view('admin/users/user_edit')->with('user', $user)->with('roles', $roles);
    }


    public function update(Request $request)
    {
        $this->authorize('user_update');
    	$request->validate([
    		'name'		=>	'required',
    		'email'		=>	'required',
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
                    'mobile'    =>  $request->post('mobile'),
		    		'email_verified_at' => $verified_at ];

        if ($request->post('role_id') > '0') {
            $object = array_merge($object, ['role_id' => $request->input('role_id')]);
        }

		if (!empty($request->post('password'))) {
			$arr = ['password'	=>	\Hash::make($request->post('password'))];
			$object = array_merge($object, $arr);
		}
    	$user->update($object);

    	return redirect('admin/users')
    				->withErrors('UPDATED !! User is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('user_delete');
    	$user = User::find($id);

    	if (!empty($user->detail)) {
    		$user->detail->delete();
    	}
    	$user->delete();

    	return redirect('admin/users')
    				->withErrors('DELETED !! User is successfully deleted');
    }

    public function generate_api_token($user_id='')
    {
        $this->authorize('user_token_update');
        User::find($user_id)->update(['api_token' => \Str::random(80)]);
        return redirect()->back()->withErrors('SUCCESS !! API Token is successfully generated');
    }
}
