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
		@endphp
      
      <!-- DataTables Example -->
      
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>                        
                        <th >Tỉnh/thành phố</th>
                        <th >Phí giao hàng</th>
                        <th>
                        </th>                       
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($transports as $transport)
                     @php
                        $province = DB::table('province')->where('id', $transport->province_id)->first();
                     @endphp
                        <tr>                       
                           <td>{{ $province->name }}</td>
                           <td>{{ number_format($transport->price) }} đ</td>
                           <td><a href="{{ URL::to('admin/shippingFee/edit/'.$transport->id) }}" class="btn btn-warning btn-sm">Sửa</a></td>
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