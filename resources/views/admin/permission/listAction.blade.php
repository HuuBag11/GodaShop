@include('admin.layout.header')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ URL::to('admin/index') }}">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Vai trò</li>
      </ol>
      <!-- DataTables Example -->
		<div class="action-bar">
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Mã</th>
								<th>Tên</th>
							</tr>
						</thead>
						<tbody>
							@php
								$stt = 0;
							@endphp
							@foreach ($actions as $action)
							@php
								$stt++;
							@endphp
								<tr>
									<td>{{ $stt }}</td>
									<td>{{ $action->name }}</td>
									<td>{{ $action->description }}</td>
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