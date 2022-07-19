<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
          <th>Mã</th>
          <th>Tên khách hàng</th>
          <th>Điện thoai</th>
          <th>Email</th>
          <th>Trạng Thái</th>
          <th>Ngày đặt hàng</th>
          <th>Phương thức thanh toán</th>
          <th>Người nhận</th>
          <th>Số điện thoại nhận</th>
          <th>Ngày giao hàng</th>
          <th>Phí giao hàng</th>
          <th>Tạm tính</th>
          <th>Tổng cộng</th>
          <th>Địa chỉ giao hàng</th>
          <th>Nhân viên phụ trách</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($orders))
        @foreach ($orders as $order)
            @php
                $tmp_fee = 0;
                $order_name = DB::table('customer')->where('id', $order->customer_id)->first();
                $order_status = DB::table('status')->where('id', $order->order_status_id)->first();
                $order_fee = DB::table('order_item')->where('order_id', $order->id)->get();
                foreach ($order_fee as $fee) {
                    $tmp_fee += $fee->total_price;
                }
                $address = $order->shipping_housenumber_street;
                if ($order->shipping_ward_id != null) {
                    $ward = DB::table('ward')->where('id', $order->shipping_ward_id)->first();
                    $district = DB::table('district')->where('id', $ward->district_id)->first();
                    $province = DB::table('province')->where('id', $district->province_id)->first();
                    $address .= ', '.$ward->name.', '.$district->name.', '.$province->name;
                    $staff = DB::table('staff')->where('id', $order->staff_id)->first();
                }
                
            @endphp
            <tr>
                <td><a href="{{ URL::to('admin/order/detail/'.$order->id) }}">{{ $order->id }}</a></td>
                <td>{{ $order_name->name }}</td>
                <td>{{ $order_name->mobile }}</td>
                <td>{{ $order_name->email }}</td>
                <td>{{ $order_status->description }}</td>
                <td>{{ $order->created_date }}</td>
                <td>{{ $order->payment_method == 0 ? 'Trả tiền khi nhận hàng' : 'Bank' }}</td>
                <td>{{ $order->shipping_fullname }}</td>
                <td>{{ $order->shipping_mobile }}</td>
                <td>{{ $order->delivered_date }}</td>
                <td>{{ number_format($order->shipping_fee) }} đ</td>
                <td>{{ number_format($tmp_fee) }} đ</td>
                <td>{{ number_format($tmp_fee + $order->shipping_fee) }} đ</td>
                <td>{{ $address }}</td>
                <td>{{ !empty($staff) ? $staff->name : '' }}</td>
                <td> 
                    @if(($order->order_status_id) == 1)
                    <a class="btn btn-primary btn-sm" href="{{ URL::to('/confirm-order/'.$order->id) }}" onclick="return confirm('Bạn muốn xác nhận đơn hàng này phải không?')">Xác nhận</a>
                    @endif
                </td>
                <td > <input type="button" onclick="alert('hỗ trợ sau')" value="Sửa" class="btn btn-warning btn-sm"></td>
                <td > 
                    <a class="btn btn-danger btn-sm" href="{{ URL::to('/delete-order/'.$order->id) }}" onclick="return confirm('Bạn muốn xóa đơn hàng này phải không?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>