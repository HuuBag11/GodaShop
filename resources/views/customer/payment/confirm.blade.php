@include('customer.layout.header')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Giỏ hàng</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Thông tin giao hàng</span></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <aside class="col-md-6 cart-checkout">
                @php
                    $shipping_fee = DB::table('transport')->where('province_id', Request::get('shipping-fee'))->first();
                @endphp
                @foreach (Session::get('cart')->products as $item)
                
                <div class="row">
                    <div class="col-xs-2">
                        <img class="img-responsive" src="{{ asset('upload/'.$item['productInfo']->featured_image) }}" alt="{{ $item['productInfo']->name }}">
                    </div>
                    <div class="col-xs-7">
                        <a class="product-name" href="#">{{ $item['productInfo']->name }}</a>
                        <br>
                        <span>{{ $item['qty'] }}</span> x <span>{{ number_format($item['price']) }} ₫</span>
                    </div>
                    <div class="col-xs-3 text-right">
                        <span>{{ number_format($item['qty'] * $item['price']) }} ₫</span>
                    </div>
                </div>
                <hr>    
                @endforeach
                <div class="row">
                    <div class="col-xs-6">
                        Phí vận chuyển
                    </div>
                    <div class="col-xs-6 text-right">
                        <span class="shipping-fee" data="">{{ number_format($shipping_fee->price)}} ₫</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        Tổng cộng
                    </div>
                    <div class="col-xs-6 text-right">
                        <span style="color: #ED2D04" class="payment-total" data="#">{{ number_format(Session::get('cart')->total_price + $shipping_fee->price) }} ₫</span>
                    </div>
                </div>
            </aside>
            <div class="ship-checkout col-md-6">
                <h4>Thông tin giao hàng</h4>
                <p style="color:violet; font-size: 18px;">{{ Request::get('fullname') }} - {{ Request::get('mobile') }}</p>
                <p style="color:violet; font-size: 18px;">{{ Request::get('shipping-address') }}</p>
                <hr>
                <form action="{{ URL::to('/finish-order') }}" method="POST">
                    @csrf
                    <input hidden type="text" name="shipping_name" value="{{ Request::get('fullname') }}">
                    <input hidden type="text" name="shipping_mobile" value="{{ Request::get('mobile') }}">
                    <input hidden type="text" name="shipping_fee" value="{{ $shipping_fee->price }}">
                    <input hidden type="text" name="shipping_housenumber" value="{{ Request::get('address') }}">
                    <input hidden type="number" name="payment-method" value="{{ Request::get('payment_method') }}">
                    <div class="form-group">
                        <h4>Phương thức thanh toán: 
                        @if (Request::get('payment_method' == 0))
                            <span style="color:violet; font-size: 18px;">Thanh toán khi giao hàng (COD)</span>
                        @else
                            <span style="color:violet; font-size: 18px;">Chuyển khoản qua ngân hàng</span>
                        @endif
                        </h4>
                        <div></div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Hoàn tất đơn hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('customer.layout.footer')