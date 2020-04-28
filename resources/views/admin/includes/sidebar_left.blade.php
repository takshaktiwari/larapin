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
                
                <li class="menu-title">Catalogue</li>
                <li>
                    <a href="{{ url('admin/categories') }}" class=" waves-effect">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bezier-curve"></i>
                        <span>Attributes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/attributes') }}">All Attributes</a></li>
                        <li><a href="{{ url('admin/attr_options') }}">Options</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-box-open"></i>
                        <span>Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/product/create') }}">Create Product</a></li>
                        <li><a href="{{ url('admin/products') }}">List Products</a></li>
                    </ul>
                </li>

                <li class="menu-title">Location / Places</li>
                <li>
                    <a href="{{ url('admin/countries') }}" class=" waves-effect">
                        <i class="fas fa-flag-checkered"></i>
                        <span>Countries</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/states') }}" class=" waves-effect">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>States</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/locations') }}" class=" waves-effect">
                        <i class="fas fa-map-marker"></i>
                        <span>Locations</span>
                    </a>
                </li>


                <li class="menu-title">Others</li>
                <li>
                    <a href="{{ url('admin/users') }}" class=" waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Users List</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>