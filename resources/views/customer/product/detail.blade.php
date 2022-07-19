@include('customer.layout.header')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Kem Dưỡng Da</span></li>
                </ol>
            </div>
            <div class="col-xs-3 hidden-lg hidden-md">
                <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc <i
                        class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="clearfix"></div>
            @include('customer.layout.sidebar')
            <div class="col-md-9 product-detail">
                <div class="row product-info">
                    <div class="col-md-6">
                        <img data-zoom-image="{{ asset('upload/'.$product->featured_image) }}"
                            class="img-responsive thumbnail main-image-thumbnail"
                            src="{{ asset('upload/'.$product->featured_image) }}" alt="">
                        <div class="product-detail-carousel-slider">
                            <div class="owl-carousel owl-theme">
                                <div class="item thumbnail"><img src="{{ asset('upload/'.$product->featured_image) }}"
                                        alt="">
                                </div>

                                @php
                                    $imageItems = DB::table('image_item')->where('product_id', $product->id)->get();
                                @endphp
                                {{-- @if (count($imageItem) > 0)
                                    
                                @endif --}}
                                @foreach ($imageItems as $imageItem)
                                    <div class="item thumbnail"><img src="{{ asset('upload/'.$imageItem->name) }}"
                                        alt="{{ $imageItem->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @php
                        $brand = DB::table('brand')->where('id', $product->brand_id)->first();
                    @endphp
                    <div class="col-md-6">
                        <h5 class="product-name">{{ $product->name }}</h5>
                        <div class="brand">
                            <span>Nhãn hàng: </span> <span>{{ $brand->name }}</span>
                        </div>
                        <div class="product-status">
                            <span>Trạng thái: </span>
                            @if ($product->inventory_qty)
                                <span class="label-success">Còn hàng</span>
                            @else
                                <span class="label-warning">Hết hàng</span>
                            @endif
                        </div>
                        <div class="product-item-price">
                            <span>Giá: </span>
                            @if ($product->discount_percentage != 0)
                                <span class="product-item-regular">{{ number_format($product->price) }} ₫</span>
                            @endif
                            <span class="product-item-discount">{{ number_format($product->price - $product->price * $product->discount_percentage / 100) }} ₫</span>
                        </div>

                        <div class="input-group">
                            <a href="javascript:void(0)" onclick="addCart({{ $product->id }})" product-id="{{ $product->id }}"
                                class="buy-in-detail btn btn-success cart-add-button"><i
                                    class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="row product-description">
                    <div class="col-xs-12">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#product-description" aria-controls="home" role="tab" data-toggle="tab">Mô
                                        tả</a>
                                </li>
                                <li role="presentation">
                                    <a href="#product-comment" aria-controls="tab" role="tab" data-toggle="tab">Đánh
                                        giá</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="product-description">
                                    {!! $product->description !!}
                                </div>
                                <div role="tabpanel" class="tab-pane" id="product-comment">
                                    <form class="form-comment" action="{{ URL::to('/add-comment/'.$product->id) }}" method="POST"
                                        role="form">
                                        @csrf
                                        <label>Đánh giá của bạn</label>
                                        <div class="form-group">
                                            <input type="hidden" name="product_id" value=" {{ $product->id }}">
                                            <input class="rating-input" name="rating" type="text" title="" value="4" />
                                            <input type="text" class="form-control" id="" name="fullname"
                                                placeholder="Tên *" required>
                                            <input type="email" name="email" class="form-control" id=""
                                                placeholder="Email *" required>
                                            <textarea name="description" id="input" class="form-control" rows="3"
                                                required placeholder="Nội dung *"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </form>
                                    <div class="comment-list">
                                        @include('customer.product.commentList')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-related equal">
                    <div class="col-md-12">
                        <h4 class="text-center">Sản phẩm liên quan</h4>
                        <div class="owl-carousel owl-theme">
                            @foreach ($relatedProducts as $product)
                            <div class="item thumbnail">
                                @include('customer.layout.product');
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('customer.layout.footer')