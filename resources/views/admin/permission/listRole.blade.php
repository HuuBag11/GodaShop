@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Vai trò</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <a href="{{ URL::to('admin/permission/addRole') }}" class="btn btn-primary btn-sm">Thêm</a>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                 <th>Tên</th>
                 <th></th>
                 <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($roles as $role)
                  <tr>
                     <td>
                        <a title="Danh sách tác vụ" href="{{ URL::to('admin/permission/listRoleAction/'.$role->id) }}">{{ $role->name }}</a>
                     </td>
                     <td>
                        @if ($role->id != 1)
                        <a href="{{ URL::to('admin/permission/editRole/'.$role->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        @endif
                     </td>
                     <td>
                        <a data="{{ $role->id }}" onclick="return confirm('Bạn muốn xóa vai trò này không?')" href="{{ URL::to('/delete-role/'.$role->id) }}" class="btn btn-danger btn-sm btn-delete-role">Xóa</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@include('admin.layout.footer')