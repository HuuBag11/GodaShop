<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?=!empty($page_title) ? $page_title : "Tổng quan" ?></title>
      <!-- Create favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/logo.jpg') }}" />
      <!-- Custom fonts for this template-->
      <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{ asset('admin/css/sb-admin.css') }}" rel="stylesheet">
      <link href="{{ asset('admin/css/admin.css') }}" rel="stylesheet">
   </head>
   <body id="page-top">
      <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
         <a class="navbar-brand mr-1" href="{{ URL::to('admin/index') }}">GODASHOP</a>
         <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
         <i class="fas fa-bars"></i>
         </button>
         <!-- Navbar Search -->
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item no-arrow text-white">
               <span >Chào {{ Session::get('name') }}</span> |
               <a class="text-white nounderline" href="#" data-toggle="modal" data-target="#logoutModal">Thoát</a>
               {{-- <a class="text-white" href="{{ URL::to('/logout') }}">Thoát</a> --}}
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="sidebar navbar-nav">
            <li class="nav-item {{ Request::is('admin/index*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL::to('admin/index') }}"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Tổng quan</span></a>
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/order*') ? 'active' : '' }}">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a>
               <div class="dropdown-menu {{ Request::is('admin/order*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item {{ Request::is('admin/order/list') ? 'active' : '' }}" href="{{ URL::to('admin/order/list') }}">Danh sách</a>
                  <a class="dropdown-item {{ Request::is('admin/order/add') ? 'active' : '' }}" href="{{ URL::to('admin/order/add') }}">Thêm</a>
               </div>
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/product*') ? 'active' : '' }}">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fab fa-product-hunt"></i> <span>Sản phẩm</span></a>
               <div class="dropdown-menu {{ Request::is('admin/product*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item {{ Request::is('admin/product/list') ? 'active' : '' }}" href="{{ URL::to('admin/product/list') }}">Danh sách</a>
                  <a class="dropdown-item {{ Request::is('admin/product/add') ? 'active' : '' }}" href="{{ URL::to('admin/product/add') }}">Thêm</a>
               </div>
            </li>
            <li class="nav-item {{ Request::is('admin/comment*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL::to('admin/comment/list') }}" id=""><i class="fas fa-comments"></i> <span>Comment</span></a>
               {{-- <div class="dropdown-menu " aria-labelledby="">
                  <a class="dropdown-item " href="">Danh sách</a>
               </div> --}}
            </li>

            <li class="nav-item {{ Request::is('admin/imageItem*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL::to('admin/imageItem/list') }}" id=""><i class="far fa-image"></i> <span>Hình ảnh</span></a>
               {{-- <div class="dropdown-menu {{ Request::is('admin/imageItem*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item " href="">Danh sách</a>
               </div> --}}
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/customer*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL::to('admin/customer/list') }}" id=""><i class="fas fa-folder"></i> <span>Khách hàng</span></a>
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/category*') ? 'active' : '' }}">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Danh mục sản phẩm</span></a>
               <div class="dropdown-menu {{ Request::is('admin/category*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item {{ Request::is('admin/category/list') ? 'active' : '' }}" href="{{ URL::to('admin/category/list') }}">Danh sách</a>
                  <a class="dropdown-item {{ Request::is('admin/category/add') ? 'active' : '' }}" href="{{ URL::to('admin/category/add') }}">Thêm</a>
               </div>
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/brand*') ? 'active' : '' }}">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Nhãn hiệu</span></a>
               <div class="dropdown-menu {{ Request::is('admin/brand*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item {{ Request::is('admin/brand/list*') ? 'active' : '' }}" href="{{ URL::to('admin/brand/list') }}">Danh sách</a>
                  <a class="dropdown-item {{ Request::is('admin/brand/add') ? 'active' : '' }}" href="{{ URL::to('admin/brand/add') }}">Thêm</a>
               </div>
            </li>
            <li class="nav-item {{ Request::is('admin/shippingFee*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL::to('admin/shippingFee/list') }}"><i class="fas fa-shipping-fast"></i> <span>Phí vận chuyển</span></a>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/staff*') ? 'active' : '' }}">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-users"></i> <span>Nhân viên</span></a>
               <div class="dropdown-menu {{ Request::is('admin/staff*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item {{ Request::is('admin/staff/list*') ? 'active' : '' }}" href="{{ URL::to('admin/staff/list') }}">Danh sách</a>
                  <a class="dropdown-item {{ Request::is('admin/staff/add*') ? 'active' : '' }}" href="{{ URL::to('admin/staff/add') }}">Thêm</a>
               </div>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/permission*') ? 'active' : '' }}">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-shield"></i> <span>Phân quyền</span></a>
               <div class="dropdown-menu {{ Request::is('admin/permission*') ? 'show' : '' }}" aria-labelledby="">
                  <a class="dropdown-item {{ Request::is('admin/permission/listRole*') ? 'active' : '' }}" href="{{ URL::to('admin/permission/listRole') }}">Danh sách vai trò</a>
                  <a class="dropdown-item {{ Request::is('admin/permission/addRole*') ? 'active' : '' }}" href="{{ URL::to('admin/permission/addRole') }}">Thêm vai trò</a>
                  <a class="dropdown-item {{ Request::is('admin/permission/listAction*') ? 'active' : '' }}" href="{{ URL::to('admin/permission/listAction') }}">Danh sách tác vụ</a>
               </div>
            </li>

            
            <li class="nav-item {{ Request::is('admin/status*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL::to('admin/status/list') }}"><i class="fas fa-star-half-alt"></i> <span>Trạng thái đơn hàng</span></a>
            </li>

            {{-- <li class="nav-item dropdown ">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-file-alt"></i> <span>News letter</span></a>
               <div class="dropdown-menu " aria-labelledby="">
                  <a class="dropdown-item " href="">Danh sách</a>
                  <a class="dropdown-item " href="">Gởi mail</a>
               </div>
            </li> --}}
         </ul>
        
         <div class="message bg-info text-center" style="position: absolute; left:50%; transform: translateX(-50%); width:100%">
            @php
               $message = Session::get('message');
               if ($message) {
                  echo $message;
                  Session::put('message', null);
               }
            @endphp
         </div>

         <div class="error bg-danger text-center" style="position: absolute; left:50%; transform: translateX(-50%);width:100%; color:white">
            @php
               $error = Session::get('error');
               if ($error) {
                  echo $error;
                  Session::put('error', null);
               }
            @endphp
         </div>
         