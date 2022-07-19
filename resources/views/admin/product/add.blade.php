@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Thêm sản phẩm</li>
      </ol>

      <!-- /form -->
      <form method="post" action="{{ URL::to('/save-product') }}" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <div class="bg-danger text-warning text-center">
              @if ($errors->any())
                  @foreach ($errors->all() as $error)
                    <p style="margin: 0">{{ $error }}</p>
                  @endforeach
              @elseif (!empty($error))
                <p style="margin: 0">{{ $error }}</p>
              @endif
            </div>
          </div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="barcode">Barcode</label>  
				<div class="col-md-9 col-lg-6">
					<input name="barcode" id="barcode" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="sku">SKU</label>  
				<div class="col-md-9 col-lg-6">
					<input name="sku" id="sku" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="row form-group">
				<label class="col-md-12 control-label" for="name">Tên</label>  
				<div class="col-md-9 col-lg-6">
					<input name="name" id="name" type="text" value="" class="form-control">                       
				</div>
			</div>

			<div class="form-group row">
				<div class="col-md-9 col-lg-6">
					<input type="file" name="image" onchange="loadFile(event)">  
					<img src="" id="image" alt="">            
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="price">Giá</label>  
				<div class="col-md-9 col-lg-6">
					<input name="price" id="price" type="text" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="discount_percentage">% Giảm giá</label>  
				<div class="col-md-9 col-lg-6">
					<input name="discount_percentage" id="discount_percentage" type="number" value="0" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="discount_from_date">Giảm giá từ</label>  
				<div class="col-md-9 col-lg-6">
					<input name="discount_from_date" id="discount_from_date" type="date" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="discount_to_date">Giảm giá đến</label>  
				<div class="col-md-9 col-lg-6">
					<input name="discount_to_date" id="discount_to_date" type="date" value="" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="inventory_qty">Lượng tồn</label>  
				<div class="col-md-9 col-lg-6">
					<input name="inventory_qty" id="inventory_qty" type="number" value="0" class="form-control">			
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label">Nổi bật</label>  
				<div class="col-md-9 col-lg-6">
					<input name="featured" id="featured" type="checkbox" value="1">			
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="category">Danh mục</label>  
				<div class="col-md-9 col-lg-6">
					<select name="category" id="category" class="form-control">
                  @foreach ($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="brand">Nhãn hàng</label>  
				<div class="col-md-9 col-lg-6">
					<select name="brand" id="brand" class="form-control">
						<option value="">Vui lòng chọn nhãn hiệu</option>
						@foreach ($brands as $brand)
                     <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                  @endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label" for="description">Mô tả</label>  
				<div class="col-md-12">
					<textarea name="description" id="description" rows="10" cols="80" style="">
					</textarea>
				</div>

			</div>
			<div class="form-action">
				<input type="submit" class="btn btn-primary btn-sm btn-add-product" value="Lưu" name="save">
			</div>
		</form>
		<script type="text/javascript" src="public/vendor/ckeditor/ckeditor.js"></script>
		<script>CKEDITOR.replace('description');</script>
		<!-- /form -->
		<!-- /.container-fluid -->
		<!-- Sticky Footer -->
	</div>
	<!-- /.content-wrapper -->
</div>
@include('admin.layout.footer')