@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item ">Đánh giá</li>
         <li class="breadcrumb-item active">{{ 1 }}</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <label style="cursor: pointer;" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
              <form action="#" method="POST">
                  @csrf
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Email</th>
                           <th>Tên </th>
                           <th>Số sao</th>
                           <th>Ngày đánh giá</th>
                           <th>Nội dung</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($comments as $comment)
                           <tr>
                              <td><input type="checkbox" name="ids[]" value="{{ $comment->id }}"></td>
                              <td>{{ $comment->email }}</td>
                              <td>{{ $comment->fullname }}</td>
                              <td>{{ $comment->star }}</td>
                              <td>{{ $comment->created_date }}</td>
                              <td>{{ $comment->description }}</td>
                              <td>
                                 <a href="{{ URL::to('/delete-comment/'.$comment->product_id).'/'.$comment->id }}" class="btn btn-danger" onclick="return confirm('Bạn muốn xóa comment này không?')">Xóa</a>
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