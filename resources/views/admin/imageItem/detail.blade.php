@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item">Hình ảnh</li>
         @php
            $product = DB::table('product')->where('id', $product_id)->first();
         @endphp
         <li class="breadcrumb-item active">{{ $product->name }}</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         <label style="cursor: pointer;" for="delete" class="btn btn-danger btn-sm">Xóa</label>
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <form action="index.php?c=imageItem&a=deletes" method="POST">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Hình ảnh</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($images as $image)
                           @php
                              
                           @endphp
                           <tr>
                              <td><input type="checkbox" name="ids[]" value="{{ $image->id }}"></td>
                              <td>
                                 <a href="{{ URL::to('admin/imageItem/show/'.$image->id) }}">
                                    <img src="{{ asset('upload/'.$image->name) }}">
                                 </a>
                              </td>
                              <td><a href="{{ URL::to('/delete-image/'.$product_id.'/'.$image->id) }}" class="btn btn-danger" onclick="return confirm('Bạn muốn xóa hình này không?')">Xóa</a></td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <input type="hidden" name="product_id" value="{{ $product_id }}">
                  <input type="submit" id="delete" hidden>
               </form>
            </div>
         </div>

      </div>
      <form action="{{ URL::to('/upload-image-item/'.$product_id) }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-12">
               <label>Upload hình</label>
            </div>
         </div>
         
         <div class="row form-group">
            <div class="col-md-12">
               <input type="file" class="form-control" name="image" onchange="loadFile(event)">  
               <img src="" id="image" alt=""> 
            </div>
         </div>
         <div class="row form-group"> 
            <div class="col-md-12">
               <input type="submit" value="Upload" class="btn btn-primary btn-sm">
            </div>
         </div>
      </form>
   </div>
</div>
@include('admin.layout.footer')