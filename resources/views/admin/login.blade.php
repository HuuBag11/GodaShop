<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Đăng nhập</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/admin.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header card-login-header" style="text-align: center">
        <img src="{{ asset('upload/goda450x170_1.jpg') }}" width="200">
      </div>
      <div class="card-body">
        <form action="login" method="POST">
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
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="Tài khoản" autofocus="autofocus">
              <label for="username">Tài khoản</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" name="password">
              <label for="password">Mật khẩu</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="1" name="remember-me">
                Duy trì đăng nhập
              </label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Đăng nhập</button>
          @csrf
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
</body>
</html>
