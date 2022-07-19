@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
         <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Trạng thái đơn hàng</li>
      </ol>
      <!-- DataTables Example -->
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                        $stt = 0;
                     @endphp
                     @foreach ($status as $status)
                     @php
                        $stt++;
                     @endphp
                        <tr>
                           <td>{{ $stt }}</td>
                           <td>{{ $status->name }}</td>
                           <td>{{ $status->description }}</td>
                           <td>
                              <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                           </td>
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