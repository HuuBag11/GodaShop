@include('customer.layout.header')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tất cả sản phẩm</span></li>
                </ol>
            </div>
            <div class="col-xs-3 hidden-lg hidden-md">
                <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc<i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="clearfix"></div>
            @include('customer.layout.sidebar')
            <div class="col-md-9 products">
                <div class="row equal">
                    <div class="col-xs-6">
                        <h4 class="home-title">Tất cả sản phẩm</h4>
                    </div>
                    <div class="col-xs-6 sort-by">
                        <div class="pull-right">
                            <label class="left hidden-xs" for="sort-select">Sắp xếp: </label>
                            <select id="sort-select">
                                <option value="" 
                                {{ empty(Request::get('sort')) ? 'selected' : '' }}>Mặc định</option>
                                <option value="price-asc" {{ Request::get('sort') == 'price-asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price-desc" {{ Request::get('sort') == 'price-desc' ? 'selected="selected"' : '' }}>Giá giảm dần</option>
                                <option value="alpha-asc" {{ Request::get('sort') == 'alpha-asc' ? 'selected' : '' }}>Từ A-Z</option>
                                <option value="alpha-desc" {{ Request::get('sort') == 'alpha-desc' ? 'selected' : '' }}>Từ Z-A</option>
                                <option value="created-asc" {{ Request::get('sort') == 'created-asc' ? 'selected' : '' }}>Cũ đến mới</option>
                                <option value="created-desc" {{ Request::get('sort') == 'created-desc' ? 'selected' : '' }}>Mới đến cũ</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @if (count($data) == 0)
                        <h3>Không có sản phẩm phù hợp</h3>
                    @endif
                    @foreach ($data as $product)
                    <div class="col-xs-6 col-sm-4">
                        @include('customer.layout.product')
                    </div>
                    @endforeach
                </div>

                <!-- Paging -->
                <div class="pagination pull-right">{{ $data->links('') }}</div>
                <!-- End paging -->
            </div>
        </div>
    </div>
</main>
@include('customer.layout.footer')