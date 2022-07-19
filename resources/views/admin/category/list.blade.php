@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Danh mục sản phẩm</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/category/add') }}">Thêm</a>
         <label style="cursor: pointer; margin-bottom: 0" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">

            <div class="table-responsive">
               <form action="{{ URL::to('/deletes-category') }}" method="POST">
                  @csrf
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Tên</th>
                           <th>Trạng thái</th>
                           <th>
                           </th>
                           <th>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                        <tr>
                           <td>
                            <input type="checkbox" name="ids[]" value="{{ $category->id }}">
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>
                           @if ($category->active != 0)
                              <a href="{{ URL::to('/active-category/'.$category->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Bạn muốn ẩn danh mục này không')">Hoạt động</a>
                           @else
                              <a href="{{ URL::to('/active-category/'.$category->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn kích hoạt danh mục này không')">Vô hiệu</a>
                           @endif
                            </td>
                            <td><a href="{{ URL::to('admin/category/edit/'.$category->id) }}" class="btn btn-warning btn-sm">Sửa</a></td>
                             <td>
                               <a data="{{ $category->id }}" href="{{ URL::to('/delete-category/'.$category->id) }}" class="btn btn-danger btn-sm btn-delete-cat" onclick="return confirm('Bạn muốn xóa danh mục này không?')">Xóa</a>
                            </td>
                         </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <input type="submit" id="delete" value="DELETE" hidden>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@include('admin.layout.footer')