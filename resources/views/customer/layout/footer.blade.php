<!-- FOOTER -->
<footer class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-4 list">
                        <div class="footerLink">
                            <h4>Danh mục</h4>
                            <ul class="list-unstyled">
                                <li><a href="#">Kem Chống Nắng </a></li>
                                <li><a href="#">Kem Dưỡng Da </a></li>
                                <li><a href="#">Kem Trị Mụn </a></li>
                                <li><a href="#">Kem Trị Thâm Nám </a></li>
                                <li><a href="#">Sữa Rửa Mặt </a></li>
                                <li><a href="#">Sữa Tắm </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4 list">
                        <div class="footerLink">
                            <h4>Liên kết </h4>
                            <ul class="list-unstyled">
                                <li><a href="{{ URL::to('product') }}">Sản phẩm </a></li>
                                <li class=""><a href="{{ URL::to('/returnPolicy') }}">Chính sách đổi trả</a></li>
                                <li class=""><a href="{{ URL::to('/paymentPolicy') }}">Chính sách thanh toán</a></li>
                                <li class=""><a href="{{ URL::to('/deliveryPolicy') }}">Chính sách giao hàng</a></li>
                                <li class=""><a href="{{ URL::to('/contact') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4 list">
                        <div class="footerLink">
                            <h4>Liên hệ với chúng tôi </h4>
                            <ul class="list-unstyled">
                                <li>Phone: 0123.456.789</li>
                                <li><a href="mailto:godashop@gmail.com">Mail: godashop@gmail.com</a></li>
                            </ul>
                            <ul class="list-inline">
                                <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                                <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 list">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->
<!-- BACK TO TOP -->
<div class="back-to-top" class="bg-color">▲</div>
<!-- END BACK TO TOP -->
<!-- REGISTER DIALOG -->
<div class="modal fade" id="modal-register" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title text-center">Đăng ký</h3>
            </div>
            <form class="form-register" action="{{ URL::to('/register-customer') }}" method="POST" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname"  placeholder="Họ và tên" required oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại" required pattern="[0][0-9]{9,}"
                            oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required oninvalid="this.setCustomValidity('Vui lòng nhập email')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="off" autosave="off" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                    </div>
                    {{-- <div class="form-group g-recaptcha" data-sitekey="#"></div>
                    <input type="text" name="hiddenRecaptcha" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;">
                    <input type="hidden" name="reference" value=""> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END REGISTER DIALOG -->
<!-- LOGIN DIALOG -->
<div class="modal fade" id="modal-login" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title text-center">Đăng nhập</h3>
            </div>
            <form action="{{ URL::to('/check-login') }}" method="POST" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                    </div>
                    <input type="hidden" name="reference" value="">                          
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Đăng Nhập</button><br>
                    <div class="text-left">
                        <a href="javascript:void(0)" class="btn-register" >Bạn chưa là thành viên? Đăng kí ngay!</a>
                        <a href="javascript:void(0)" class="btn-forgot-password">Quên Mật Khẩu?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END LOGIN DIALOG -->
<!-- FORTGOT PASSWORD DIALOG -->
<div class="modal fade" id="modal-forgot-password" role="dialog">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title text-center">Quên mật khẩu</h3>
            </div>
            <form action="#" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="reference" value="">
                    <button type="submit" class="btn btn-primary">GỬI</button><br>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END FORTGOT PASSWORD DIALOG -->
<!-- CART DIALOG -->
<div class="modal fade" id="modal-cart-detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title text-center">Giỏ hàng</h3>
            </div>
            <div class="modal-body">
                <div class="page-content">
                    <div class="clearfix hidden-sm hidden-xs">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-3">
                            <div class="header">
                                Sản phẩm
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="header">
                                Đơn giá
                            </div>
                        </div>
                        <div class="label_item col-xs-3">
                            <div class="header">
                                Số lượng
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="header">
                                Thành tiền
                            </div>
                        </div>
                        <div class="lcol-xs-1">
                        </div>
                    </div>
                    <div class="cart-product" id="change-item"> 
                        @include('customer.layout.cart')
                        {{-- cart here --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="clearfix">
                    <div class="col-xs-12 text-right">
                        <a class="btn btn-primary" href="{{ URL::to('/check-out') }}">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CART DIALOG -->
<!-- Facebook Messenger Chat -->
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v4.0'
    });
    };
    
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Your customer chat code -->
<div class="fb-customerchat"
    attribution=setup_tool
    page_id="112296576811987"
    logged_in_greeting="Chào bạn, bạn muốn mua sản phẩm nào bên GodaShop.com"
    logged_out_greeting="Chào bạn, bạn muốn mua sản phẩm nào bên GodaShop.com">
</div>
<!-- End Facebook Messenger Chat -->


<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="{{ asset('customer/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

    function addCart(id) {
        $.ajax({
            type: "GET",
            url: "/add-cart/"+id,
        }).done(function(response){
            // console.log(response);
            RenderCart(response);
            alertify.success('Đã thêm vào giỏ');
        });
    }

    $('#change-item').on('click', '.remove-product', function () {
        // console.log($(this).data('id'));
        $.ajax({
            type: "GET",
            url: "/delete-item-cart/"+$(this).data('id'),
        }).done(function(response){
            console.log(response);
            RenderCart(response);
            alertify.success('Đã xóa sản phẩm');
        });
    });

    function updateProductCart(id) {
        // console.log($('.qty-item-'+id).val());
        $.ajax({
            url: '/update-cart/'+id+'/'+$('.qty-item-'+id).val(),
            type: 'GET',
        })
        .done(function(response) {
            RenderCart(response);
        });
    }

    function RenderCart(response) {
        $("#change-item").empty();
        $("#change-item").html(response);
        $("#total-qty").text($("#total-qty-cart").val());
        // $(".number-total-product").text($qty);
        if ($("#total-qty-cart").val() == null) {
            $("#total-qty").text(0);
        }
        else {
            $("#total-qty").text($("#total-qty-cart").val());
        }
    }
</script>
</body>
</html>