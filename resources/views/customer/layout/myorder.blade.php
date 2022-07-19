@include('customer.layout.header')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>
            @include('customer.layout.sidebar')
            <div class="col-md-9 order">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Đơn hàng của tôi</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <!-- Mỗi đơn hàng -->
                        @if (count($orders) > 0)
                            @foreach ($orders as $order)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Đơn hàng <a href="#">#{{ $order->id }}</a></h5>
                                        <span class="date">
                                            Đặt hàng ngày {{ $order->created_date }} </span>
                                        <hr>
                                        @php
                                            $order_stt = DB::table('status')->where('id', $order->order_status_id)->first();
                                            $items = DB::table('order_item')->where('order_id', $order->id)->get();
                                        @endphp
                                        @foreach ($items as $item)
                                        @php
                                            $product = DB::table('product')->where('id', $item->product_id)->first();
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ asset('upload/'.$product->featured_image) }}" alt="" class="img-responsive">
                                            </div>
                                            <div class="col-md-3">
                                                <a class="product-name" href="{{ URL::to('/product/detail/'.$product->id) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="col-md-2">
                                                Số lượng: {{ $item->qty }}
                                            </div>
                                            <div class="col-md-2">
                                                {{ $order_stt->description }}
                                            </div>
                                            {{-- <div class="col-md-3">
                                                Giao hàng ngày {{ $order->delivered_date }}
                                            </div> --}}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Bạn chưa mua gì cả!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('customer.layout.footer')