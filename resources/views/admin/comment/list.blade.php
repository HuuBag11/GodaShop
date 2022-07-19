@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Đánh giá</li>
      </ol>
      <!-- DataTables Example -->
      
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>Barcode</th>
                        <th>Tên </th>
                        <th>Hình ảnh</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($products as $product)
                        <tr>                       
                           <td><a href="{{ URL::to('admin/comment/detail/'.$product->id) }}">{{ $product->barcode }}</a></td>
                           <td>{{ $product->name }}</td>
                           <td><img src="{{ asset('upload/'.$product->featured_image) }}"></td>
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