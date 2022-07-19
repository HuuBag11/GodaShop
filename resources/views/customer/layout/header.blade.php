<!DOCTYPE html>
<html>

<head>
    <title>Trang chủ - Mỹ Phẩm Goda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendor/fontawesome-free-5.11.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendor/star-rating/css/star-rating.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/style.css') }}">
    <script src="{{ asset('customer/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('customer/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('customer/vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('customer/vendor/star-rating/js/star-rating.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('customer/vendor/format/number_format.js') }}"></script>
    <script type="text/javascript" src="{{ asset('customer/js/script.js') }}"></script>
    <style>
        
    </style>
</head>

<body>
    <header>
        <!-- use for ajax -->
        <input type="hidden" id="reference" value="">
        <!-- Top Navbar -->
        <div class="top-navbar container-fluid">
            <div class="menu-mb">
                <a href="javascript:void(0)" class="btn-close" onclick="closeMenuMobile()">×</a>
                <a class="#" href="#">Trang chủ</a>
                <a class="" href="{{ URL::to('product') }}">Sản phẩm</a>
                <li class=""><a href="{{ URL::to('/returnPolicy') }}">Chính sách đổi trả</a></li>
                <li class=""><a href="{{ URL::to('/paymentPolicy') }}">Chính sách thanh toán</a></li>
                <li class=""><a href="{{ URL::to('/deliveryPolicy') }}">Chính sách giao hàng</a></li>
                <li class=""><a href="{{ URL::to('/contact') }}">Liên hệ</a></li>
            </div>
            <div class="row">
                <div class="hidden-lg hidden-md col-sm-2 col-xs-1">
                    <span class="btn-menu-mb" onclick="openMenuMobile()"><i
                            class="glyphicon glyphicon-menu-hamburger"></i></span>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-10 col-xs-11">
                    <ul class="list-inline pull-right top-right">
                        @if (Session::has('customer_id') == null)
                            <li class="account-login">
                                <a href="javascript:void(0)" class="btn-register">Đăng Ký</a>
                            </li>
                        @endif
                        <li>
                            @if (Session::has('customer_id') == null)
                                <a href="javascript:void(0)" class="btn-login">Đăng Nhập </a>
                            @else
                                <a href="javascript:void(0)" class="btn-account dropdown-toggle" data-toggle="dropdown"
                                id="dropdownMenu">Xin chào {{ Session::get('customer_name') }}</a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                    <li><a href="{{ URL::to('/my-info') }}">Thông tin tài khoản</a></li>
                                    <li><a href="{{ URL::to('/shipping-address') }}">Địa chỉ giao hàng</a></li>
                                    <li><a href="{{ URL::to('/my-order') }}">Đơn hàng của tôi</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ URL::to('/check-logout') }}">Thoát</a></li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End top navbar -->
        <!-- Header -->
        <div class="container">
            <div class="row">
                <!-- LOGO -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 logo">
                    <a href="#"><img src="{{ asset('upload/goda450x170_1.jpg') }}" class="img-responsive"></a>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs call-action">
                    <a href="#"><img src="{{ asset('upload/cosmetic-men-product-Skinovators.jpg') }}" class="img-responsive" width="250"></a>
                </div>
                <!-- HOTLINE AND SERCH -->
                <div class="col-lg-4 col-md-4 hotline-search">
                    <div>
                        <p class="hotline-phone"><span><strong>Hotline: </strong><a
                                    href="tel:0123.456.798">0123.456.798</a></span></p>
                        <p class="hotline-email"><span><strong>Email: </strong><a
                                    href="mailto:godashop@gmail.com">godashop@gmail.com</a></span>
                        </p>
                    </div>
                    <form class="header-form" action="">
                        <div class="input-group">
                            <input type="search" class="form-control search" placeholder="Nhập từ khóa tìm kiếm"
                                name="search" autocomplete="off" value="">
                            <div class="input-group-btn">
                                <button class="btn bt-search bg-color" type="submit"><i class="fa fa-search"
                                        style="color:#fff"></i>
                                </button>
                            </div>
                            <input type="hidden" name="c" value="product">
                            <input type="hidden" name="a" value="list">
                        </div>
                        <div class="search-result">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End header -->
    </header>
    <!-- NAVBAR DESKTOP-->
    <nav class="navbar navbar-default desktop-menu">
        <div class="container">
            <ul class="nav navbar-nav navbar-left hidden-sm hidden-xs">
                <li class="">
                    <a href="/">Trang chủ</a>
                </li>
                <li class=""><a href="{{ URL::to('product') }}">Sản phẩm </a></li>
                <li class=""><a href="{{ URL::to('/returnPolicy') }}">Chính sách đổi trả</a></li>
                <li class=""><a href="{{ URL::to('/paymentPolicy') }}">Chính sách thanh toán</a></li>
                <li class=""><a href="{{ URL::to('/deliveryPolicy') }}">Chính sách giao hàng</a></li>
                <li class=""><a href="{{ URL::to('/contact') }}">Liên hệ</a></li>
            </ul>
            <span class="hidden-lg hidden-md experience">Trải nghiệm cùng sản phẩm của Goda</span>
            <ul class="nav navbar-nav navbar-right">
                <li class="cart"><a href="javascript:void(0)" class="btn-cart-detail" title="Giỏ Hàng"><i class="fa fa-shopping-cart"></i>
                    @if (Session::has('cart') != null)
                        <span class="number-total-product" id="total-qty">{{ Session::get('cart')->total_product_number }}</span>
                    @else
                        <span class="number-total-product" id="total-qty">0</span>
                    @endif
                </a></li>
            </ul>
        </div>
    </nav>
    @if (Session::has('error') != null)
        <div class="alert error bg-danger text-center">
            @php
                $error = Session::get('error');
                if ($error) {
                    echo $error;
                    Session::put('error', null);
                }
            @endphp
        </div>
    @endif

    @if (Session::has('message-info') != null)
        <div class="alert error bg-danger text-center">
            @php
                $error = Session::get('message-info');
                if ($error) {
                    echo $error;
                    Session::put('message-info', null);
                }
            @endphp
        </div>
        @endif
    {{-- @if (Session::has('error') != null)
        <div class="alert ">{{ Session::get('error') }}</div>
    @endif --}}
    