<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('role_access');
        $roles = Role::get()->all();
        return view('admin/roles/roles')->with('roles', $roles);
    }

    public function create($value='')
    {
        $this->authorize('role_create');
    	return view('admin/roles/role_create');
    }

    public function store(Request $request)
    {
        $this->authorize('role_create');
        $request->validate([
            'role_name'  =>  'required|unique:roles',
        ]);
        Role::create(['role_name' => $request->post('role_name')]);
        return redirect('admin/roles')->withErrors('CREATED !! New role is successfully created');
    }

    public function edit($id)
    {
        $this->authorize('role_update');
    	$role = Role::find($id);
    	return view('admin/roles/role_edit')->with('role', $role);
    }

    public function update(Request $request)
    {
        $this->authorize('role_update');
    	$request->validate([
    	    'role_name'  =>  'required',
    	]);
    	Role::find($request->post('role_id'))
    				->update(['role_name' => $request->post('role_name')]);
    	return redirect('admin/roles')->withErrors('UPDATED !! Role is successfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('role_delete');
        Role::where('id', $id)->delete();
        return redirect()->back()
                        ->withErrors(['DELETED !! Role is successfully delete']);
    }
}
