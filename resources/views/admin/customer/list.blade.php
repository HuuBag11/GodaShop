@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Trạng thái đơn hàng</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
         <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                     <th><input type="checkbox" onclick="checkAll(this)"></th>
                     <th>Tên</th>
                     <th>Email</th>
                     <th>Số điện thoại</th>
                     <th>Đăng nhập từ</th>
                     <th>Địa chỉ</th>
                     <th>Tên người nhận</th>
                     <th>Điện thoại người nhận</th>
                     <th></th>
                     <th></th>
                     <th></th>
                  </tr>
                  </thead>
                  <tbody>
                     @foreach ($customers as $customer)
                        @php
                           $address = $customer->housenumber_street;
                           $ward = DB::table('ward')->where('id', $customer->ward_id )->first();
                           if ($ward) {
                              $district = DB::table('district')->where('id', $ward->district_id)->first();
                              $province = DB::table('province')->where('id', $district->province_id)->first();
                              $address .= ', '.$ward->name.', '.$district->name.', '.$province->name;
                           }                           
                        @endphp                     
                        <tr>
                           <td><input type="checkbox"></td>
                           <td>{{ $customer->name }}</td>
                           <td>{{ $customer->email }}</td>
                           <td>{{ $customer->mobile }}</td>
                           <td>{{ $customer->login_by }}</td>
                           <td>{{ $address }}</td>
                           <td>{{ $customer->shipping_name }}</td>
                           <td>{{ $customer->shipping_mobile }}</td>
                           <td>{{ $customer->is_active == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}</td>
                           <td><a href="{{ URL::to('admin/customer/edit/'.$customer->id) }}" class="btn btn-warning btn-sm">Sửa</a></td>
                           <td><a href="{{ URL::to('/delete-customer/'.$customer->id) }}" onclick="return confirm('Bạn muốn xóa khách hàng này không?')" class="btn btn-danger btn-sm">Xóa</a></td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
<!-- /.container-fluid -->
<!-- Sticky Footer -->
</div>
@include('admin.layout.footer')