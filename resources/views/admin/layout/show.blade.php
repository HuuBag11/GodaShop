@include('admin.layout.header')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="btn btn-primary" href="{{ URL::previous() }}">Quay lại</a>
            </li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-body text-center">
                <img width="50%" src="{{ asset('upload/'.$product->featured_image) }}">
            </div>
        </div>
    </div>
</div>
@include('admin.layout.footer')