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
                    $total_price = 0;
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
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        Tổng cộng
                    </div>
                    <div class="col-xs-6 text-right">
                        <span class="payment-total" data="#">{{ number_format(Session::get('cart')->total_price) }} ₫</span>
                    </div>
                </div>
            </aside>
            <div class="ship-checkout col-md-6">
                <h4>Thông tin giao hàng</h4>
                <form action="{{ URL::to('/confirm-order') }}" method="POST">
                    @csrf
                    @include('customer.layout.address')
                    <h4>Phương thức thanh toán</h4>
                    <div class="form-group">
                        <label> <input type="radio" name="payment_method" checked="" value="0"> Thanh toán khi giao hàng (COD) </label>
                        <div></div>
                    </div>
                    <div class="form-group">
                        <label> <input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng </label>
                        <div class="bank-info">STK: 0421003707901<br>Chủ TK: GODA. Ngân hàng: Vietcombank TP.HCM <br>
                            Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Tiếp tục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('customer.layout.footer')