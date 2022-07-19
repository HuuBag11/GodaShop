@if (Session::has('cart') != null)
    <div class="clearfix text-left">
        @php
            $total_price_cart = 0;
        @endphp
        @foreach (Session::get('cart')->products as $item)
            @php 
                $price = $item['productInfo']->price;
                if ($item['productInfo']->discount_percentage != 0) {
                    $price = $item['productInfo']->price - $item['productInfo']->price * $item['productInfo']->discount_percentage / 100;
                }
                $total_price_item = $price * $item['qty'];
                $total_price_cart += $total_price_item;
            @endphp
        <div class="row">
            <div class="col-sm-6 col-md-1">
                <div>
                    <img class="img-responsive" src="{{ asset('upload/'.$item['productInfo']->featured_image) }}" alt="">
                </div>
            </div>
                
            <div class="col-sm-6 col-md-3">
                <a class="product-name" href="{{ URL::to('/product/detail/'.$item['productInfo']->id) }}">{{ $item['productInfo']->name }}</a>
            </div>

            <div class="col-sm-6 col-md-2">
                <span class="product-item-discount">{{ number_format($price) }} đ</span>
            </div>

            <div class="col-sm-6 col-md-3">
                <input type="hidden" value="1">
                <input type="number" class="qty-item-{{ $item['productInfo']->id }}"  min="1" onchange="updateProductCart({{ $item['productInfo']->id }})" value="{{ $item['qty'] }}">
            </div>

            <div class="col-sm-6 col-md-2">
                <span>{{ number_format($total_price_item) }} đ</span>
            </div>
            <div class="col-sm-6 col-md-1">
                <a class="remove-product" data-id="{{ $item['productInfo']->id }}" href="javascript:void(0)">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="clearfix">
        <div class="col-xs-12 text-right">
            <p>
                <input hidden id="total-qty-cart" type="number" value="{{ Session::get('cart')->total_product_number }}" >
                <span>Tổng tiền</span>
                <span class="price-total">{{ number_format($total_price_cart) }} ₫</span>
            </p>
        </div>
    </div>
@endif

