<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Role_permission;

class RolePermissionController extends Controller
{
    public function index($value='')
    {
        //$this->authorize('role_permission_access');
    	$roles = Role::with('permissions')->get()->all();
		$permissions = Permission::with('children')
	                                ->whereNull('parent')
	                                ->orderBy('name', 'ASC')
	                                ->get()->all();

    	return view('admin/permissions/role_permissions')->with('roles', $roles)
    									->with('permissions', $permissions);
    }

    public function update(Request $request)
    {
        //$this->authorize('role_permission_update');
    	$data = $request->all();

    	Role_permission::where('role_id', $data['role_id'])->delete();

    	if (isset($data['permission_id'])) {
	    	$permissions = Permission::whereIn('id', $data['permission_id'])->get()->all();

	    	foreach ($permissions as $permission) {
	    		Role_permission::updateOrCreate(
	    			['role_id' => $data['role_id'], 'permission_id' => $permission->id],
	    			['permission' => $permission->name]
	    		);
	    	}
    	}

    	return redirect()->back()
    					->withErrors('UPDATED !! Role premissions are successfully updated');

    }
}
