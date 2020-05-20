@php
    if(!empty($product->categories)){
	   $product_categories = $product->categories->pluck('id')->toArray();
    }else{
        $product_categories = [];
    }
@endphp

@section('styles')
    @parent
	<style>
		.custom_check{
			line-height: 0px;
		}
		.relative{
			position: relative;
		}
	</style>
@endsection
<div id="accordion">
	@foreach($categories as $category)
        <div class="card mb-1">
            <div class="card-header p-3 d-flex" id="{{ $category->slug }}">
                <h6 class="my-0 ml-0 mr-auto font-size-14">
    	    		@if(count($category->child_categories) > 0)
    		    		<span class="my-auto pr-2">
    		    			<i class="fas fa-angle-down"></i>
    		    		</span>
    	    		@endif

                    <a href="#{{ 'category_'.$category->id }}" class="text-dark" data-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                        {{ $category->category }}
                    </a>
                </h6>
                <div class="my-auto custom_check">
                	<input type="checkbox" id="{{ 'category_switch_'.$category->id }}" switch="dark" class="parent_check" name="categories[]" value="{{ $category->id }}"  {{ checked($product_categories, $category->id, TRUE) }} />
                	<label for="{{ 'category_switch_'.$category->id }}" data-on-label="Yes"
                	        data-off-label="No" class="mb-0"></label>
                </div>
            </div>
    
            <div id="{{ 'category_'.$category->id }}" class="collapse"
                    aria-labelledby="{{ $category->slug }}" data-parent="#accordion">
                <div class="card-body bg-light border d-flex flex-wrap">
                    @foreach($category->child_categories as $child)
                    	<div class="form-check list-group-item border my-1 mx-1 flex-fill child_list">
                    	  	<label class="form-check-label ">
                    	    	<input type="checkbox" class="form-check-input child_check m-0 relative" name="categories[]" value="{{ $child->id }}" {{ checked($product_categories, $child->id, TRUE) }}>
                    	    	{{ $child->category }}
                    	  	</label>
                    	</div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$(".parent_check").change(function(event) {
				if($(this).is(':checked')){
					$(this).parent().parent().next().find('.child_check').prop( "checked", true );
				}else{
					$(this).parent().parent().next().find('.child_check').prop( "checked", false );
				}
			});
		});
	</script>
@endsection