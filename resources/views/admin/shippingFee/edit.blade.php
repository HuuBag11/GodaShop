@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{{ URL::to('admin/index') }}">Quản lý</a>
      </li>
      <li class="breadcrumb-item active">Giao hàng</li>
   </ol>
   @php
		$message = Session::get('message');
		if ($message) {
		echo '<h4 class="bg-success text-center">'.$message.'</h4>';
		Session::put('message', null);
		}

      $province = DB::table('province')->where('id', $transport->province_id)->first();
	@endphp
   <!-- /.row -->
   <!-- form -->
   
   <form method="POST" action="{{ URL::to('/update-fee/'.$transport->id) }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $transport->id }}">
      <div class="form-group">
         <div class="col-md-9 col-lg-6">
            <label class="control-label" for="">{{ $province->name }}</label>                   
         </div>
      </div>
      <div class="form-group">
         <label class="col-md-9 col-lg-6 control-label" for="price">Phí vận chuyển</label>  
         <div class="col-md-9 col-lg-6"> 
            <input name="price" id="price" type="text" value="{{ $transport->price }}" class="form-control">                        
         </div>
      </div>
      <div class="form-action">
         <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
      </div>
      </form>
   <!-- /form -->
   </div>
<!-- /.container-fluid -->
</div>
@include('admin.layout.footer')