@include('customer.layout.header')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Liên hệ</span></li>
                </ol>
            </div>
        </div>
        <div class="row contact">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.0235246987463!2d106.69758091462207!3d10.732668892351224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b2747a81a3%3A0x33c1813055acb613!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUw7RuIMSQ4bupYyBUaOG6r25n!5e0!3m2!1svi!2s!4v1651584582304!5m2!1svi!2s" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="col-md-6">
                <h4>Thông tin liên hệ</h4>
                <form class="form-contact" action="{{ URL::to('/send-contact') }}" method="POST" id="contact">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên">
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại">
                        </div>

                        <div class="form-group col-sm-12">
                            <textarea class="form-control" placeholder="Nội dung" name="content" rows="10"
                                ></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="message alert alert-success" style="display:none"></div>
                            
                        </div>
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary pull-right">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@include('customer.layout.footer')