<style>
    .product_tab{
        font-size: 16px;
        border-radius: 0px;
    }
    .product_tab.active{
        color: #fff;
        background-color: #626ed4;
    }
    .product_tab.inactive{
        color: #333;
        background-color: #f8f9fa;
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
<div class="card mb-0">
    <div class="card-body d-flex p-0">
        <a href="{{ url('admin/product/info', $product->id) }}" class="text-center border p-3 product_tab flex-fill btn {{ active_tab('info', $product) }} ">
            <span class="serial">1.</span> Info
        </a>
        <a href="{{ url('admin/product/details', $product->id) }}" class="text-center border p-3 product_tab flex-fill btn {{ active_tab('details', $product) }}  ">
            <span class="serial">2.</span> Details
        </a>
        <a href="{{ url('admin/product/variants', $product->id) }}" class="text-center border p-3 product_tab flex-fill btn {{ active_tab('variants', $product) }}  ">
            <span class="serial">3.</span> Variants
        </a>
        <a href="{{ url('admin/product/images', $product->id) }}" class="text-center border p-3 product_tab flex-fill btn {{ active_tab('images', $product) }}">
            <span class="serial">4.</span> Images
        </a>
    </div>      
</div>

@php
    function active_tab($param, $product){
        if(Request::segment(3) == $param){
            return 'active';
        }else{
            return 'inactive';
        }
    }
@endphp