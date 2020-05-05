<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    public function index()
    {
    	$permissions = Permission::with('children')
                                    ->whereNull('parent')
                                    ->orderBy('name', 'ASC')
                                    ->get()->all();
        $all_permissions = Permission::orderBy('title', 'ASC')
                                    ->get()->all();
    	return view('admin/permissions/permissions')->with('permissions', $permissions)
                                            ->with('all_permissions', $all_permissions);
    }

    public function create()
    {
		$permissions = Permission::with('children')
	                                ->whereNull('parent')
	                                ->orderBy('name', 'ASC')
	                                ->get()->all();
    	return view('admin/permissions/permission_create')->with('permissions', $permissions);
    }

    public function store(Request $request)
    {
    	$data = $request->all();

    	if (isset($data['resource']) && $data['resource'] == '1') {
            $permission = Permission::updateOrCreate(
                            ['name' =>  trim($data['name']).'_access'],
                            
                            ['parent'   =>  $data['parent'],
                             'title'    =>  $data['title'],
                             'hint'     =>  $data['hint']]
                        );

    		$suffix = ['_create', '_update', '_show', '_delete'];

    		foreach ($suffix as $suff) {
    			Permission::updateOrCreate(
    				['name'	=>	trim($data['name']).$suff],

    				['parent'   =>  $permission->id,
                    'title'=>	$data['title'],
                    'hint' => $data['hint']]
    			);
    		}
    	}else{
    		Permission::updateOrCreate(
				['name'	=>	trim($data['name'])],

				['parent'   =>  $data['parent'],
                 'title'=>	$data['title'],
                 'hint' => $data['hint']]
			);
    	}

    	return redirect('admin/permissions')->withErrors('SUCCESS !! Permission is successsfully created');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $all_permissions = Permission::whereNotIn('id', [$id])
                                    ->orderBy('title', 'ASC')
                                    ->get()->all();
        return view('admin/permissions/permission_edit')
                    ->with('permission', $permission)
                    ->with('all_permissions', $all_permissions);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        Permission::where('name', $data['name'])
                ->update(['parent' => $data['parent'],
                        'title'=>  $data['title'],
                        'hint' => $data['hint']]);
        return redirect('admin/permissions')->withErrors('UPDATED !! Permission is successsfully updated');
    }

}
