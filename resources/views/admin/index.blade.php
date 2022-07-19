@include('admin.layout.header')

<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">Tổng quan</li>
      </ol>
      <div class="mb-3 my-3">
         <a href="{{ URL::to('admin/index/today') }}" class="{{ Request::is('*/today') ? 'active' : '' }} btn btn-primary">Hôm nay</a>
         <a href="{{ URL::to('admin/index/yesterday') }}" class="{{ Request::is('*/yesterday') ? 'active' : '' }} btn btn-primary">Hôm qua</a>
         <a href="{{ URL::to('admin/index/week') }}" class="{{ Request::is('*/week') ? 'active' : '' }} btn btn-primary">Tuần này</a>
         <a href="{{ URL::to('admin/index/month') }}" class="{{ Request::is('*/month') ? 'active' : '' }} btn btn-primary">Tháng này</a>
         <a href="{{ URL::to('admin/index/3months') }}" class="{{ Request::is('*/3months') ? 'active' : '' }} btn btn-primary">3 tháng</a>
         <a href="{{ URL::to('admin/index/year') }}" class="{{ Request::is('*/year') ? 'active' : '' }} btn btn-primary">Năm này</a>
         <div class="dropdown" style="display:inline-block">
            <a class="{{ Request::is('*/custom') ? 'active' : '' }} btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
               <div style="margin:20px">
                  <form action="{{ URL::to('admin/index/custom') }}">
                     Từ ngày <input type="date" class="form-control" name="from_date" required value="{{ Request::is('*/custom') ? $from_date : '' }}">
                     Đến ngày <input type="date" class="form-control" name="to_date" required value="{{ Request::is('*/custom') ? $to_date : '' }}">
                     <br>
                     <input type="submit" value="Tìm" class="btn btn-primary form-control">
                  </form>
                  
               </div>
            </div>
         </div>
      </div>
      @php
         $count = 0;
         $total = 0;
         $cancel = 0;
         if (!empty($orders)) {
            $count = count($orders);
            foreach ($orders as $order) {
               if ($order->order_status_id != 6) {
                  $shipping_fee = $order->shipping_fee;
                  $amounts = DB::table('order_item')->where('order_id', $order->id)->get();
                  foreach ($amounts as $amount) {
                     $total += $amount->total_price;
                  }
                  $total += $shipping_fee;
               }
               else {
                  $cancel++;
               }
            }      
         }                  
      @endphp
      <!-- Icon Cards-->
      <div class="row">
         <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
               <div class="card-body">
                  <div class="card-body-icon">
                     <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">{{ $count }} Đơn hàng</div>
               </div>
               <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Chi tiết</span>
                  <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                  </span>
               </a>
            </div>
         </div>
         <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
               <div class="card-body">
                  <div class="card-body-icon">
                     <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">Doanh thu {{ number_format($total) }} đ</div>
               </div>
               <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Chi tiết</span>
                  <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                  </span>
               </a>
            </div>
         </div>
         <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
               <div class="card-body">
                  <div class="card-body-icon">
                     <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">{{ $cancel }} đơn hàng bị hủy</div>
               </div>
               <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">Chi tiết</span>
                  <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                  </span>
               </a>
            </div>
         </div>
      </div>
      <!-- DataTables Example -->
      <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-table"></i>
            Đơn hàng
         </div>
         <div class="card-body">
            <div class="table-responsive">
               @include('admin.layout.orders')
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
<!-- Sticky Footer -->
@include('admin.layout.footer')