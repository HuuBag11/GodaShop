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
       <!-- /form -->
       <form  method="post" action="{{ URL::to('/update-role/'.$role->id) }}">
			@csrf
          	<div class="form-group row">
				<label class="col-md-12 control-label" for="fullname">Tên</label>  
				<div class="col-md-9 col-lg-6">
					<input type="hidden" name="role_id" value="{{ $role->id }}" class="form-control input-md">
					<input name="fullname" id="fullname" type="text" value="{{ $role->name }}" class="form-control">								
				</div>
			</div>
			<div class="form-action">
				<input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
			</div>
       </form>
       <!-- /form -->
    </div>
 </div>
@include('admin.layout.footer')