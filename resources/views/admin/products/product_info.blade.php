@extends('layouts.admin')

@section('styles')
    @parent
    <link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <style>
        .bootstrap-tagsinput{
            background-color:  transparent;
            display: block;
            line-height: 28px;
        }
        .bootstrap-tagsinput .tag{
            background-color: #626ed4;
            padding: 4px 8px;
            border-radius: 4px;
        }
    

        .product_tab{
            font-size: 16px;
            border-radius: 0px;
        }
        .product_tab.inactive{
            color: #333;
        }
        .product_tab .serial{
            color: white;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid white;
            padding: 3px 6px;
            margin-right: 2px;
        }
        .product_tab.inactive .serial{
            color: #333;
            font-weight: 500;
            border: 1px solid #333;
        }
    </style>
@endsection

@section('content')


    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">New Product</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Products</a>
    	                </li>
    	                <li class="breadcrumb-item active">Create Product</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/products') }}" class="btn btn-primary">All Products</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
        

		<div class="card mb-0">
            <div class="card-body d-flex p-0">
                <a href="{{ url('admin/product/info', $product->id) }}" class="text-center border p-3 product_tab flex-fill text-white bg-primary">
                    <span class="serial">1.</span> Info
                </a>
                <a href="{{ url('admin/product/details', $product->id) }}" class="text-center border p-3 product_tab flex-fill bg-light inactive btn">
                    <span class="serial">2.</span> Details
                </a>
                <a href="{{ url('admin/product/variants', $product->id) }}" class="text-center border p-3 product_tab flex-fill bg-light inactive btn">
                    <span class="serial">3.</span> Attributes
                </a>
                <a href="{{ url('admin/product/images', $product->id) }}" class="text-center border p-3 product_tab flex-fill bg-light inactive btn">
                    <span class="serial">4.</span> Images
                </a>
            </div>      
        </div>
		<div class="card">
			<div class="card-body">
                
				<form action="{{ url('admin/product/info/update') }}" method="POST" class="p-sm-3 p-1 ">
					@csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="product_name" required class="form-control" value="{{ $product->product_name }}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ selected($product->category_id, $category->id) }}>
                                            {{ $category->category }}
                                        </option>
                                        @foreach($category->child_categories as $child)
                                            <option value="{{ $child->id }}" {{ selected($product->category_id, $child->id) }}>
                                                -- {{ $child->category }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Product Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ $product->subtitle }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Price <span class="text-danger">*</span></label>
                                <input type="text" name="base_price" required class="form-control" value="{{ $product->base_price }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Discount <span class="text-danger">*</span></label>
                                <input type="text" name="base_discount" required class="form-control" value="{{ $product->base_discount }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Featured <span class="text-danger">*</span></label>
                                <select name="featured" class="form-control" required>
                                    <option value="1" {{ selected($product->status, '1') }} >Yes</option>
                                    <option value="0" {{ selected($product->status, '0') }} >No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ selected($product->status, '1') }}>Active</option>
                                    <option value="0" {{ selected($product->status, '0') }}>In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Short Description </label>
                        <textarea name="short_description" rows="4" class="form-control">{{ $product->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Product Tags </label>
                        <input type="text" name="product_tags" class="form-control"  data-role="tagsinput" value="{{ $product->product_tags }}">
                    </div>
					
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
					<input type="submit" class="btn btn-lg rounded-sm btn-primary px-5" value="Update">
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
    @parent
    <script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
@endsection