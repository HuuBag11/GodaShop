@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Nhân viên</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <a class="btn btn-primary btn-sm" href="index.php?c=staff&a=add">Thêm</a>
         <label style="cursor: pointer; margin-bottom: 0" for="activeMulti" class="btn btn-primary btn-sm">Kích hoạt</label>
         <label style="cursor: pointer; margin-bottom: 0" for="disableMulti" class="btn btn-danger btn-sm">Vô hiệu</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <form action="index.php?c=staff&a=activeOrDisableMulti" method="POST">

                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                        <th>Tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th></th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($staffs as $staff)
                        @php
                           $role = DB::table('role')->where('id', $staff->role_id)->first();
                        @endphp
                        <tr>
                           <td><input type="checkbox" name="ids[]" value="{{ $staff->id }}"></td>
                           <td>{{ $staff->name }}</td>
                           <td>{{ $staff->username }}</td>
                           <td>{{ $staff->email }}</td>
                           <td>{{ $staff->mobile }}</td>
                           <td>{{ $role->name }}</td>
                           <td><a href="{{ URL::to('admin/staff/edit/'.$staff->id) }}" class="btn btn-warning btn-sm">Sửa</a></td>
                           <td>
                           @if ($staff->is_active != 0)
                              <a href="{{ URL::to('/active/'.$staff->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn vô hiệu hóa nhân viên này không')">Vô hiệu</a>
                           @else
                              <a href="{{ URL::to('/active/'.$staff->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Bạn muốn kích hoạt nhân viên này không')">Kích hoạt</a>
                           @endif
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
                  </table>

                  <input type="submit" id="activeMulti" name="activeMulti" hidden>
                  <input type="submit" id="disableMulti" name="disableMulti" hidden>
               </form>
            </div>
         </div>
      </div>
   </div>
<!-- /.container-fluid -->
<!-- Sticky Footer -->
</div>
@include('admin.layout.footer')