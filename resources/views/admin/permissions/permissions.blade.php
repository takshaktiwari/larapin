@extends('layouts.admin')

@section('content')
	<style>
	    .permissions ul:first-child{
	        padding: 0px;
	    }

	    .permissions .children_parent{
	        display: none;
	    }

	    .permissions .parent:first-child{
	        margin: 0px;
	    }
	    .permissions .parent{
	        margin-top: 15px;
	    }
	</style>

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

		<div class="permissions">
		    @php
		        permission_items($permissions);
		    @endphp
		</div>

    </div> <!-- container-fluid -->

    <?php
        function permission_items($permissions, $children='')
        {
            if($children == ''){
                $ul_class = 'parent_parent';
                $li_class = 'parent';
            }else{
                $ul_class = 'children_parent';
                $li_class = 'children ';
            }
            echo '<ul class="'.$ul_class.'">';
            foreach($permissions as $permission){
                ?>
                <li class="d-flex list-group-item text-left rounded-0 <?= $li_class ?>">
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
                            <div>{{ $permission->title }}</div>
                            <div>
                                <span class="badge badge-success">{{ $permission->name }}</span>
                                <span class="small">{{ $permission->hint }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('admin/permission/edit', $permission->id) }}"  class="btn btn-sm btn-success my-auto" title="Edit This" >
                        <i class="fas fa-edit"></i>
                    </a>

                </li>
                <?php

                if(count($permission->children) > 0){
                    permission_items($permission->children, '1');
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
	        $(".permissions li").click(function(event) {
	            $(this).next('ul').slideToggle('fast');
	        });
	    });
	</script>
@endsection
