<div class="product-container">
    <div class="image">
        <img style="height: 200px;" class="img-responsive" src="{{ asset('upload/'.$product->featured_image) }}" alt="">
    </div>
    <div class="product-meta">
        <h5 class="name">
            <a class="product-name" href="{{ URL::to('/product/detail/'.$product->id) }}"
                title="{{ $product->name }}">{{ $product->name }}</a>
        </h5>
        <div class="product-item-price">
            @if ($product->price != $product->price + ($product->price * $product->discount_percentage / 100))
                <span class="product-item-regular">{{ number_format($product->price) }} ₫</span>
            @endif
            <span class="product-item-discount">{{ number_format($product->price - ($product->price * $product->discount_percentage / 100)) }} ₫</span>
        </div>
    </div>
    <div class="button-product-action clearfix">
        <div class="cart icon">
            <a class="btn btn-outline-inverse buy" product-id="{{ $product->id }}" onclick="addCart({{ $product->id }})" href="javascript:void(0)"
                title="Thêm vào giỏ">
                Thêm vào giỏ <i class="fa fa-shopping-cart"></i>
            </a>
        </div>
        <div class="quickview icon">
            <a class="btn btn-outline-inverse" href="{{ URL::to('/product/detail/'.$product->id) }}" title="Xem nhanh">
                Xem chi tiết <i class="fa fa-eye"></i>
            </a>
        </div>
    </div>
</div>