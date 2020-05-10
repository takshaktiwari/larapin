<div class="shop-sidebar">
	<div class="shop-widget b1">
		<div class="shop-widget-title">
			<h5><i class="flaticon-list"></i>Categories</h5>
		</div>
		<ul>
			@foreach(get_categories() as $category)
				<li>
					<a href="shop.html">
						<i class="fas fa-angle-double-right"></i>
						{{ $category->category }}
					</a>
				</li>
				@foreach($category->child_categories as $child)
					<li class="ml-3 small">
						<a href="shop.html">
							<i class="fas fa-caret-right"></i>
							{{ $child->category }}
						</a>
					</li>
				@endforeach
			@endforeach
		</ul>
	</div>
	<div class="shop-widget b1">
		<div class="shop-widget-title">
			<h5>Freatured Items</h5>
		</div>
		@foreach(feat_products(6) as $product)
			<div class="product list-product d-flex align-items-center bg-white br-5 mb-30">
				<div class="product-img-wrap">
					<a href="{{ url('product/'.$product->slug) }}">
						<img src="{{ url('storage'.$product->primary_img->image_sm) }}" alt="{{ $product->product_name }}">
					</a>
				</div>
				<div class="product-content-wrap">
					<div class="product-content">
						<p>
							<a href="{{ url('product/'.$product->slug) }}">
								{{ $product->product_name }}
							</a>
						</p>
					</div>
					<div class="product-action">
						<a href="#" class="add-to-btn small-btn">
							<i class="flaticon-shopping-cart"></i>
							<span>Add to Cart</span>
							<h5 class="product-price">
								<i class="fas fa-rupee-sign"></i>
								{{ number_format($product->base_price, 2) }}
							</h5>
						</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>