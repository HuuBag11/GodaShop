@include('admin.layout.header')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{{ URL::to('admin/index') }}">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Sản phẩm</li>
       </ol>
       <!-- DataTables Example -->
       <div class="action-bar">
          <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/product/add') }}">Thêm</a>
          <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
       </div>
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th style="width:50px">Tên</th>
                         <th>Barcode</th>
                         <th>SKU</th>
				             <th>Hình ảnh</th>
                         <th>Giá bán lẻ</th>
                         <th>% giảm giá</th>
                         <th>Giá bán thực tế</th>
                         <th>Lượng tồn</th>
                         <th>Đánh giá</th>
                         <th>Nội bật</th>
                         <th>Danh mục</th>
                         <th>Nhãn hiệu</th>
                         <th>Ngày tạo</th>
                      </tr>
                   </thead>
                   <tbody>
                   	@foreach ($products as $product)
                        @php          
                           $category = DB::table('category')->where('id', $product->category_id)->first();
                           $brand = DB::table('brand')->where('id', $product->brand_id)->first();
                           $comments = DB::table('comment')->where('product_id', $product->id)->get();
                           // $product_star = 0;
                           // $count = 0;
                           // foreach ($comments as $comment) {
                           //    $product_star += $comment->star;
                           //    $count++;
                           // }
                           // if ($count != 0) {
                           //    $product_star /= $count;
                           // }
                           // else {
                           //    $product_star = 0;
                           // }
                           // if ($product_star > 4.7) {
                           //    $star = 5;
                           // }
                           // else if ($product_star > 4.2) {
                           //    $star = 4.5;
                           // }
                           // else if ($product_star > 3.7) {
                           //    $star = 4;
                           // }
                           // else if ($product_star > 3.2) {
                           //    $star = 3.5;
                           // }
                           // else if ($product_star > 2.7) {
                           //    $star = 3;
                           // }
                           // else if ($product_star > 2.2) {
                           //    $star = 2.5;
                           // }
                           // else if ($product_star > 1.7) {
                           //    $star = 2;
                           // }
                           // else if ($product_star > 1.2) {
                           //    $star = 1.5;
                           // }
                           // else if ($product_star > 0.7) {
                           //    $star = 1;
                           // }
                           // else if ($product_star > 0.2) {
                           //    $star = 0.5;
                           // }
                           // else {
                           //    $star = 0;
                           // }
                           // DB::table('product')->where('id', $product->id)->update(['star' => $star]);
                        @endphp
                        <tr>
                           <td><input type="checkbox"></td>
                           <td><a href="{{ URL::to('admin/comment/detail/'.$product->id) }}">Đánh giá</a></td>
                           <td><a href="{{ URL::to('admin/imageItem/detail/'.$product->id) }}">Hình ảnh</a></td>
                           <td><a href="{{ URL::to('admin/product/edit/'.$product->id) }}" class="btn btn-warning btn-sm">Sửa</a></td>
                           <td><a href="{{ URL::to('/delete-product/'.$product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn thật sự muốn xóa sản phẩm này?')">Xóa</a></td>
                           <td>{{ $product->name }}</td>
                           <td><a href="{{ URL::to('admin/product/edit/'.$product->id) }}">{{ $product->barcode }}</a></td>
                           <td>{{ $product->sku }}</td>
                           <td>
                              <a href="{{ URL::to('admin/layout/show/'.$product->id) }}">
                                 <img src="{{ asset('upload/'.$product->featured_image) }}">
                              </a>
                           </td>
                           <td>{{ number_format($product->price) }} ₫</td>
                           <td>{{ $product->discount_percentage }}%</td>
                           <td>{{ number_format($product->price - ($product->price * $product->discount_percentage / 100)) }} ₫</td>
                           <td>{{ $product->inventory_qty }}</td>
                           <td>{{ $product->star }}</td>
                           <td>{{ $product->featured }}</td>
                           <td>{{ $category->name }}</td>
                           <td>{{ $brand->name }}</td>
                           <td>{{ $product->created_date }}</td>
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