@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Nhãn hiệu</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/brand/add') }}">Thêm</a>
         <label style="cursor: pointer; margin-bottom: 0" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">

            <div class="table-responsive">
               <form action="{{ URL::to('/deletes-brand') }}" method="POST">
                  @csrf
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th >Tên</th>
                           <th>
                           </th>
                           <th>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                           <td>
                           <input type="checkbox" name="ids[]" value="{{ $brand->id }}">
                           </td>
                           <td >{{ $brand->name }}</td>
                           <td><a href="{{ URL::to('admin/brand/edit/'.$brand->id) }}" class="btn btn-warning btn-sm">Sửa</a></td>
                           <td>
                              <a data="{{ $brand->id }}" href="{{ URL::to('/delete-brand/'.$brand->id) }}" class="btn btn-danger btn-sm btn-delete-brand" onclick="return confirm('Bạn muốn xóa nhãn hiệu này không?')">Xóa</a>
                           </td>
                        </tr>  
                        @endforeach
                     </tbody>
                  </table>
                  <input type="submit" id="delete" hidden>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@include('admin.layout.footer')