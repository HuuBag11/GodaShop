@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <div class="action-bar">
         <a class="btn btn-primary btn-sm float-left" href="{{ URL::previous() }}">Quay lại</a>

         @php
            $order_status = DB::table('order')->where('id', $order_id)->first();
         @endphp
         @if(($order_status->order_status_id) == 1)
            <a class="btn btn-primary btn-sm" href="{{ URL::to('/confirm-order/'.$order_id) }}" onclick="return confirm('Bạn muốn xác nhận đơn hàng này phải không?')">Xác nhận</a>
         @endif
         <a class="btn btn-danger btn-sm" href="{{ URL::to('/delete-order/'.$order_id) }}" onclick="return confirm('Bạn muốn xóa đơn hàng này phải không?')">Xóa</a>
      </div>
      <!-- DataTables Example -->
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
              <form action="#" method="POST">
                  @csrf
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>Barcode</th>
                           <th>Tên sản phẩm</th>
                           <th>Giá thành</th>
                           <th>Số lượng</th>
                           <th>Tổng tiền</th>
                           <th>Hình ảnh</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                            $total_price = 0;
                        @endphp
                        @foreach ($orders as $order)
                        @php
                           $total_price += $order->total_price;
                           $product = DB::table('product')->where('id', $order->product_id)->first();
                        @endphp
                        <tr>
                           <td>{{ $product->barcode }}</td>
                           <td>{{ $product->name }}</td>
                           <td>{{ number_format($order->unit_price) }} đ</td>
                           <td>{{ $order->qty }}</td>
                           <td>{{ number_format($order->total_price) }} đ</td>
                           <td><img src="{{ asset('upload/'.$product->featured_image) }}"></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  {{-- <input type="hidden" name="product_id" value="{{ $product_id }}">
                  <input type="submit" id="delete" hidden> --}}
               </form>
               
            </div>
         </div>
      </div>
   </div>
</div>
@include('admin.layout.footer')