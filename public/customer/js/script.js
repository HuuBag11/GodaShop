function openMenuMobile() {
    $(".menu-mb").width("250px");
    $(".btn-menu-mb").hide("slow");
}

function closeMenuMobile() {
    $(".menu-mb").width(0);
    $(".btn-menu-mb").show("slow");
}

//html được load hết rồi mới chạy code bên trong
//nó chính là document.ready
$(function(){

    // Tìm kiếm và sắp xếp sản phẩm
    $('#sort-select').change(function(event) {
        // var str_param = getUpdatedParam("sort", $(this).val());
        // window.location.href = "?" + str_param;
        var sort = $(this).val();
        window.location.href=`?sort=${sort}`;
    });

    // Tìm kiếm theo range
    $('main .price-range input').click(function(event) {
        /* Act on the event */
        var price_range = $(this).val();
        //  window.location.href giống như header('location:...') của php
        window.location.href=`?price-range=${price_range}`;
        // var str_param = getUpdatedParam("price-range", $(this).val());
        // window.location.href = "?" + str_param;
    });

    $(".product-container").hover(function(){
        $(this).children(".button-product-action").toggle(400);
    });

    // Display or hidden button back to top
    $(window).scroll(function() { 
		 if ($(this).scrollTop()) { 
			 $(".back-to-top").fadeIn();
		 } 
		 else { 
			 $(".back-to-top").fadeOut(); 
		 } 
	 }); 

    // Khi click vào button back to top, sẽ cuộn lên đầu trang web trong vòng 0.8s
	 $(".back-to-top").click(function() { 
		$("html").animate({scrollTop: 0}, 800); 
	 });

	 // Hiển thị form đăng ký
	 $('.btn-register').click(function () {
	 	$('#modal-login').modal('hide');
        $('#modal-register').modal('show');
    });

	 // Hiển thị form forgot password
	$('.btn-forgot-password').click(function () {
		$('#modal-login').modal('hide');
    	$('#modal-forgot-password').modal('show');
    });

	 // Hiển thị form đăng nhập
	$('.btn-login').click(function () {
    	$('#modal-login').modal('show');
    });

	// Fix add padding-right 17px to body after close modal
	// Don't rememeber also attach with fix css
	$('.modal').on('hide.bs.modal', function (e) {
        e.stopPropagation();
        $("body").css("padding-right", 0);
        
    });

    // Hiển thị cart dialog
    $('.btn-cart-detail').click(function () {
    	$('#modal-cart-detail').modal('show');
    });

    // Hiển thị aside menu mobile
    $('.btn-aside-mobile').click(function () {
        $("main aside .inner-aside").toggle();
    });

    // Hiển thị carousel for product thumnail
    $('main .product-detail .product-detail-carousel-slider .owl-carousel').owlCarousel({
        margin: 10,
        nav: true
        
    });
    // Bị lỗi hover ở bộ lọc (mobile) & tạo thanh cuộn ngang
    // Khởi tạo zoom khi di chuyển chuột lên hình ở trang chi tiết
    // $('main .product-detail .main-image-thumbnail').ezPlus({
    //     zoomType: 'inner',
    //     cursor: 'crosshair',
    //     responsive: true
    // });
    
    // Cập nhật hình chính khi click vào thumbnail hình ở slider
    $('main .product-detail .product-detail-carousel-slider img').click(function(event) {
        /* Act on the event */
        $('main .product-detail .main-image-thumbnail').attr("src", $(this).attr("src"));
        var image_path = $('main .product-detail .main-image-thumbnail').attr("src");
        $(".zoomWindow").css("background-image", "url('" + image_path + "')");
        
    });

    $('main .product-detail .product-description .rating-input').rating({
        min: 0,
        max: 5,
        step: 1,
        size: 'md',
        stars: "5",
        showClear: false,
        showCaption: false
    });

    $('main .product-detail .product-description .answered-rating-input').rating({
        min: 0,
        max: 5,
        step: 1,
        size: 'md',
        stars: "5",
        showClear: false,
        showCaption: false,
        displayOnly: false,
        hoverEnabled: true
    });

    $('main .ship-checkout[name=payment_method]').click(function(event) {
        /* Act on the event */
    });

    $('input[name=checkout]').click(function(event) {
        /* Act on the event */
        window.location.href="dat-hang.html";
    });

    $('input[name=back-shopping]').click(function(event) {
        /* Act on the event */
        window.location.href="san-pham.html";
    });
    
    // Hiển thị carousel for relative products
    $('main .product-detail .product-related .owl-carousel').owlCarousel({
        loop:false,
        margin: 10,
        nav: true,
        dots:false,
        responsive:{
        0:{
            items:2
        },
        600:{
            items:4
        },
        1000:{
            items:5
        }
    }
        
    });
});

// Login in google
function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://study.com/register/google/backend/process.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      console.log('Signed in as: ' + xhr.responseText);
    };
    xhr.send('idtoken=' + id_token);
}

// Cập nhật giá trị của 1 param cụ thể
function getUpdatedParam(k, v) {//sort, price-asc
    var params={};
    //params = {"c":"proudct", "category_id":"5", "sort": "price-desc"}
    // window.location.search = "?c=product&price-range=200000-300000&sort=price-desc"
    window.location.search
      .replace(/[?&]+([^=&]+)=([^&]*)/gi, function(str,key,value) {
        params[key] = value;
        // alert(str);

      }
    );
      
    //{"c":"proudct", "category_id":"5", "sort": "price-desc"}
    params[k] = v;
    if (v == "") {
        delete params[k];
    }

    var x = [];//là array
    for (p in params) {
        //x[0] = 'c=product'
        //x[1] = 'category_id=5'
        //x[2] = 'sort=price-asc'
        x.push(p + "=" + params[p]);
    }
    return str_param = x.join("&");//c=product&category_id=5&sort=price-asc
}

// Paging
// function goToPage(page) {
//     var str_param = getUpdatedParam("page", page);
//     window.location.href = "?" + str_param;
// }

// Hiển thị những rating của những đánh giá
function updateAnsweredRating() {
    $('main .product-detail .product-description .answered-rating-input').rating({
        min: 0,
        max: 5,
        step: 1,
        size: 'md',
        stars: "5",
        showClear: false,
        showCaption: false,
        displayOnly: false,
        hoverEnabled: true
    });
}

// Hiển thị cart
function displayCart(data) {
    //chuỗi chuỗi dạng object thành object
    var cart = JSON.parse(data);
    
    var total_product_number = cart.total_product_number;
    $(".btn-cart-detail .number-total-product").html(total_product_number);

    var total_price = cart.total_price;
    $("#modal-cart-detail .price-total").html(number_format(total_price)+"₫");
    var items = cart.items;
    var rows = "";
    for (let i in items) {
        let item = items[i];
        var row = 
                '<hr>'+
                '<div class="clearfix text-left">'+   
                    '<div class="row">'+             
                        '<div class="col-sm-6 col-md-1">'+
                            '<div>'+
                                '<img class="img-responsive" src="../upload/' + item.img + '" alt="' + item.name + ' ">'+             
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-6 col-md-3">'+
                            '<a class="product-name" href="index.php?c=product&a=detail&id='+ item.product_id +'">' + item.name + '</a>'+
                        '</div>'+
                        '<div class="col-sm-6 col-md-2">'+
                            '<span class="product-item-discount">' + number_format(Math.round(item.unit_price)) + '₫</span>'+
                        '</div>'+
                        '<div class="col-sm-6 col-md-3">'+
                            '<input type="hidden" value="1">'+
                            '<input type="number" onchange="updateProductInCart(this,'+ item.product_id +')" min="1" value="' + item.qty + '">'+
                        '</div>'+
                        '<div class="col-sm-6 col-md-2">'+
                            '<span>' + number_format(Math.round(item.total_price)) + '₫</span>'+
                        '</div>'+
                        '<div class="col-sm-6 col-md-1">'+
                            '<a class="remove-product" href="javascript:void(0)" onclick="deleteProductInCart('+ item.product_id +')">'+
                                '<span class="glyphicon glyphicon-trash"></span>'+
                            '</a>'+
                        '</div>'+ 
                    '</div>'+                                                   
                '</div>';
        rows += row; 
    }
    $("#modal-cart-detail .cart-product").html(rows);
}

// Thay đổi số lượng sản phẩm trong giỏ hàng
function updateProductInCart(self, product_id) {
    var qty = $(self).val();
    $.ajax({
        url: 'index.php?c=cart&a=update',
        type: 'GET',
        data: {product_id: product_id, qty: qty}
    })
    .done(function(data) {
        displayCart(data);
        
    });
}

function deleteProductInCart(product_id) {
    $.ajax({
        url: 'index.php?c=cart&a=delete',
        type: 'GET',
        data: {product_id: product_id}
    })
    .done(function(data) {
        displayCart(data);
        
    });
}

// Cập nhật các option cho thẻ select
function updateSelectBox(data, selector) {
    var items = JSON.parse(data);
    $(selector).find('option').not(':first').remove();
    if (!data) return;
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        let option = '<option value="' + item.id + '"> ' + item.name + '</option>';
        $(selector).append(option);
    } 
    
}