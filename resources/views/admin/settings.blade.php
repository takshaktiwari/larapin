@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Settings</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Dashboard</a>
    	                </li>
    	                <li class="breadcrumb-item active">Settings</li>
    	            </ol>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body p-0">
				<form action="{{ url('admin/settings/update') }}" method="POST">
					@csrf
					<table class="table table-bordered mb-0">
					    <thead>
						    <tr>
						        <th>Title</th>
						        <th>Current Value</th>
						        <th>Change Value</th>
						    </tr>
					    </thead>
					    <tbody>
					    	@foreach($settings as $setting)
					    		<tr>
					    		    <td>
					    		    	{{ $setting->title }}
					    		    	@if(!empty($setting->description))
					    		    		<div class="small">
					    		    			{{ $setting->description }}
					    		    		</div>
					    		    	@endif
					    		    </td>
					    		    <td>{{ ucfirst($setting->setting_value) }}</td>
					    		    <td>{!! get_option($setting) !!}</td>
					    		</tr>
					    	@endforeach
							
							@can('settings_update')
					    	<tr>
					    		<td colspan="3">
					    			<input type="submit" class="btn btn-primary px-4" value="Update">
					    		</td>
					    	</tr>
					    	@endcan
					    </tbody>
					</table>
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@php
	function get_option($setting){

		$input = '';
		if($setting->option_type == 'select'){
			$input .= "<select name='settings[$setting->id][setting_value]' class='form-control'>";
			$input .= '<option value="">-- Select Option --</option>';

			$options = json_decode($setting->option_values);
			foreach($options as $option){
				$selected = '';
				if($option == $setting->setting_value){
					$selected = 'selected';
				}

				$input .= "<option value='$option' $selected >$option</option>";
			}
			$input .= '</select>';
		}

		$input .= "<input type='hidden' name='settings[$setting->id][id]' value='$setting->id'>";

		return $input;
	}
@endphp




