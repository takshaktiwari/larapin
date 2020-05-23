<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ url('admin/home') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                @can('category_access')
                <li class="menu-title">Catalogue</li>
                <li>
                    <a href="{{ url('admin/categories') }}" class=" waves-effect">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                @endcan

                @can('attribute_access')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bezier-curve"></i>
                        <span>Attributes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('attribute_access')
                        <li><a href="{{ url('admin/attributes') }}">All Attributes</a></li>
                        @endcan
                        @can('attribute_option_access')
                        <li><a href="{{ url('admin/attr_options') }}">Options</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('brand_access')
                <li>
                    <a href="{{ url('admin/brands') }}" class=" waves-effect">
                        <i class="fas fa-copyright"></i>
                        <span>Brands</span>
                    </a>
                </li>
                @endcan

                @can('product_access')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-box-open"></i>
                        <span>Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/product/upload') }}">Upload Products</a></li>
                        @can('product_create')
                        <li><a href="{{ url('admin/product/create') }}">Create Product</a></li>
                        @endcan
                        @can('product_access')
                        <li><a href="{{ url('admin/products') }}">List Products</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('discount_access')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-percent"></i>
                        <span>Offer (Discount)</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('discount_category_access')
                        <li>
                            <a href="{{ url('admin/discount/categories') }}">
                                Category Discount
                            </a>
                        </li>
                        @endcan
                        @can('discount_product_access')
                        <li>
                            <a href="{{ url('admin/discount/products') }}">
                                Products Discount
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('product_review_access')
                <li>
                    <a href="{{ url('admin/product_reviews') }}" class=" waves-effect">
                        <i class="fas fa-comments"></i>
                        <span>Product Reviews</span>
                    </a>
                </li>
                @endcan

                @can('coupon_access')
                <li>
                    <a href="{{ url('admin/coupons') }}" class=" waves-effect">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Coupons</span>
                    </a>
                </li>
                @endcan

                @can('order_access')
                <li>
                    <a href="{{ url('admin/orders') }}" class=" waves-effect">
                        <i class="fas fa-truck-moving"></i>
                        <span>Orders</span>
                    </a>
                </li>
                @endcan
                
                @can('country_access')
                <li class="menu-title">Location / Places</li>
                <li>
                    <a href="{{ url('admin/countries') }}" class=" waves-effect">
                        <i class="fas fa-flag-checkered"></i>
                        <span>Countries</span>
                    </a>
                </li>
                @endcan
                @can('state_access')
                <li>
                    <a href="{{ url('admin/states') }}" class=" waves-effect">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>States</span>
                    </a>
                </li>
                @endcan
                @can('district_access')
                <li>
                    <a href="{{ url('admin/districts') }}" class=" waves-effect">
                        <i class="fas fa-thumbtack"></i>
                        <span>Districts</span>
                    </a>
                </li>
                @endcan
                @can('pincode_access')
                <li>
                    <a href="{{ url('admin/pincodes') }}" class=" waves-effect">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Pincode</span>
                    </a>
                </li>
                @endcan
                @can('location_access')
                <li>
                    <a href="{{ url('admin/locations') }}" class=" waves-effect">
                        <i class="fas fa-map-marker"></i>
                        <span>Locations</span>
                    </a>
                </li>
                @endcan

                
                @can('user_access')
                <li class="menu-title">User / Permission</li>
                <li>
                    <a href="{{ url('admin/users') }}" class=" waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Users List</span>
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li>
                    <a href="{{ url('admin/roles') }}" class=" waves-effect">
                        <i class="fas fa-user-tag"></i>
                        <span>User Roles</span>
                    </a>
                </li>
                @endcan
                @can('permission_access')
                <li>
                    <a href="{{ url('admin/permissions') }}" class=" waves-effect">
                        <i class="fas fa-shield-alt"></i>
                        <span>Permissions</span>
                    </a>
                </li>
                @endcan
                @can('role_permission_access')
                <li>
                    <a href="{{ url('admin/role_permissions') }}" class=" waves-effect">
                        <i class="fas fa-user-shield"></i>
                        <span>Role Permission</span>
                    </a>
                </li>
                @endcan

                <li class="menu-title">Site & Settings</li>
                <li>
                    <a href="{{ url('admin/pages') }}" class=" waves-effect">
                        <i class="fas fa-file-alt"></i>
                        <span>Pages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/slider') }}" class=" waves-effect">
                        <i class="fas fa-images"></i>
                        <span>Slider</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/settings') }}" class=" waves-effect">
                        <i class="fas fa-tools"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-store-alt"></i>
                        <span>Shop Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('admin/shipping_charge') }}">
                                Shipping Charges
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/shipping_slots') }}">
                                Shipping Slots
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>