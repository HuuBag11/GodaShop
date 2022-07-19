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

            @if (Session::has('message') != null)
                <div class="alert error bg-danger text-center">
                    @php
                        $message = Session::get('message');
                        if ($message) {
                            echo $message;
                            Session::put('message', null);
                        }
                    @endphp
                </div>
            @endif

            <div class="clearfix"></div>
            @include('customer.layout.sidebar')
            <div class="col-md-9 account">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Địa chỉ giao hàng mặc định</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <form action="{{ URL::to('/update-default-shipping') }}" method="POST" role="form">
                            @csrf
                            @include('customer.layout.address')
                            <div class="text-right">
                                <button class="btn btn-danger">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('customer.layout.footer')