@extends('layouts.admin')

@section('styles')
	@parent
	<style>
	    ul.parent_parent{
	        padding: 0px;
	    }

	    .role_permissions .children_parent{
	        display: none;
	    }

	    .role_permissions .parent:first-child{
	        margin: 0px;
	    }
	    .role_permissions .parent{
	        margin-top: 10px;
	    }


	    /* The switch - the box around the slider */
	    .switch {
	      position: relative;
	      display: inline-block;
	      width: 60px;
	      height: 28px;
	    }

	    /* Hide default HTML checkbox */
	    .switch input {
	      opacity: 0;
	      width: 0;
	      height: 0;
	    }

	    /* The slider */
	    .slider {
	      position: absolute;
	      cursor: pointer;
	      top: 0;
	      left: 0;
	      right: 0;
	      bottom: 0;
	      background-color: #ccc;
	      -webkit-transition: .4s;
	      transition: .4s;
	    }

	    .slider:before {
	      position: absolute;
	      content: "";
	      height: 20px;
	      width: 20px;
	      left: 4px;
	      bottom: 4px;
	      background-color: white;
	      -webkit-transition: .4s;
	      transition: .4s;
	    }

	    input:checked + .slider {
	      background-color: #2196F3;
	    }

	    input:focus + .slider {
	      box-shadow: 0 0 1px #2196F3;
	    }

	    input:checked + .slider:before {
	      -webkit-transform: translateX(30px);
	      -ms-transform: translateX(30px);
	      transform: translateX(30px);
	    }

	    /* Rounded sliders */
	    .slider.round {
	      border-radius: 34px;
	    }

	    .slider.round:before {
	      border-radius: 50%;
	    }
	</style>
@endsection

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Permissions</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Permissions</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/permission/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
		    @foreach($roles as $role)
		        <div class="col-md-6">
		        	<div class="card shadow-sm">
		        		<div class="card-header">
		        			<h4 class="text-center mb-0">
		        				<b>{{ ucfirst($role->role_name) }}</b>
		        			</h4>
		        		</div>
		        		<div class="card-body role_permissions ">
		        			<form action="{{ url('admin/role_permissions/update') }}" method="POST" class="p-2">
		        			    @csrf
		        			    @php
		        			        $ex_permissions = ex_role_permissions($role->permissions);
		        			        permission_items($permissions, $ex_permissions);
		        			    @endphp
		        			    
		        			    
		        			    <div class="clearfix"></div>
		        			    <div class="text-center mt-4">
		        			        <input type="hidden" name="role_id" value="{{ $role->id }}">
		        			        <input type="submit" class="btn btn-success px-5" value="Update">
		        			    </div>
		        			</form>
		        		</div>
		        	</div>
		        </div>
		    @endforeach
		</div>

    </div> <!-- container-fluid -->

    <?php
        function ex_role_permissions($permissions){
            $permission_ids = [];
            if(count($permissions) > '0'){
                foreach($permissions as $permission){
                    array_push($permission_ids, $permission->permission_id);
                }
            }

            return $permission_ids;
        }

        function permission_items($permissions, $ex_permissions, $children='')
        {
            if($children == ''){
                $ch_class = 'check_parent';
                $ul_class = 'parent_parent';
                $li_class = 'parent';
            }else{
                $ch_class = 'check_children';
                $ul_class = 'children_parent';
                $li_class = 'children';
            }

            echo '<ul class="'.$ul_class.'">';
            foreach($permissions as $permission){
                $checked = '';
                if(in_array($permission->id, $ex_permissions)){
                    $checked = 'checked';
                }

                ?>
                <li class="d-flex list-group-item py-1 mb-1 text-left rounded-0 <?= $li_class ?>" data-toggle="0">
                    <div class="d-flex" style="flex:1">
                        <?php
                            if(count($permission->children) > 0){
                                ?>
                                <div class="my-auto pr-3" style="font-size: 20px;">
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <?php
                            }
                        ?>
                        <div>
                            {{ $permission->title }}
                            
                            <div>
                                <span class="badge badge-light">{{ $permission->name }}</span>
                                <span class="small">{{ $permission->hint }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="my-auto">
                        <label class="switch my-auto mr-2">
                            <input type="checkbox" class="switch_check {{ $ch_class }}" name="permission_id[]" value="{{ $permission->id }}" {{ $checked }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    

                    <a href="{{ url('admin/permission/edit', $permission->id) }}"  class="btn btn-sm btn-success my-auto" title="Edit This" >
                        <i class="fas fa-edit"></i>
                    </a>

                </li>
                <?php

                if(count($permission->children) > 0){
                    permission_items($permission->children, $ex_permissions, '1');
                }
            }
            echo '</ul>';
        }
    ?>

    
@endsection

@section('scripts')
	@parent
	<script>
	    $(document).ready(function($) {
	        $(".role_permissions li").click(function(event) {
	            if(event.target.nodeName == 'SPAN' || event.target.nodeName == 'INPUT'){
	                $(this).next('ul').slideDown('fast');
	                $(this).attr('data-toggle', '1');
	            }else{
	                var toggle = $(this).attr('data-toggle');
	                if(toggle == '0'){
	                    $(this).next('ul').slideDown('fast');
	                    $(this).attr('data-toggle', '1');
	                }else if(toggle == '1'){
	                    $(this).next('ul').slideUp('fast');
	                    $(this).attr('data-toggle', '0');
	                }
	            }
	        });

	        $(".check_parent").click(function(event) {
	            if($(this).prop('checked')){
	                $(this).closest('li')
	                        .next('ul')
	                        .find('.switch_check')
	                        .attr('checked', '');
	            }else{
	                $(this).closest('li')
	                        .next('ul')
	                        .find('.switch_check')
	                        .removeAttr('checked');
	            }
	            
	        });
	    });
	</script>
@endsection
