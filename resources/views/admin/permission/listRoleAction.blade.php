@include('admin.layout.header')
<div id="content-wrapper">  
            <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Phân quyền</li>
        <li class="breadcrumb-item">
    		<a href="index.php?c=permission&a=listRole">Vai trò</a>
      	</li>
        <li class="breadcrumb-item">{{ $role->name }}</li>
        <li class="breadcrumb-item active">Tác vụ</li>
    </ol>
    <!-- DataTables Example -->
    
    <!-- /form -->
    <form  method="post" action="{{ URL::to('/update-role-action/'.$role->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
        	<input type="hidden" name="role_id" value="{{ $role->id }}" class="form-control input-md">
            @php
                $selected_action = [];
                foreach ($roleActions as $data) {
                    $selected_action[] = $data->action_id;
                }
            @endphp
        	@foreach ($actions as $action)
                <div class="col-md-9 col-lg-6">
                    <input type="checkbox" name="action_ids[]" value="{{ $action->id }}" {{ in_array($action->id, $selected_action) ? 'checked' : '' }} >
                    {{ $action->description }}							
                </div>
            @endforeach           
        </div>
        <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
        </div>
    </form>
    <!-- /form -->
</div>
<!-- /.content-wrapper -->
@include('admin.layout.footer')