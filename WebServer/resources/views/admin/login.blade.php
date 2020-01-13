<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Coffee Management - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS Bootstrap-->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <!--CSS Fontawesome-->
        <link href="{{asset('admin/css/font-awesome.css')}}" rel="stylesheet">
        <!-- JQuery-->
        <script src="{{asset('admin/js/jquery2.0.3.min.js')}}"></script>
        {{--  <script src="lib/jquery/jquery-ui.min.js"></script>  --}}
        <!-- JS Bootstrap-->
        <script src="{{asset('admin/js/bootstrap.js')}}"></script>
        <style>
            html,body {
                height: 100%;
            }
            body {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }
            .div-center {
                width: 100%;
                max-width: 400px;
                padding: 15px;
                margin: auto;
            }
        </style>
  </head>
  <body class="text-center">
      <div class="div-center">
            <h1 style="font-size: 70px"><span class="text-danger">Coffee</span>Mng</h1>
            <h4 class="h4 mb-3 font-weight-normal"><i>Login Management Systems</i></h4>
            <?php //Hiển thị thông báo lỗi?>
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ Session::get('error') }}</strong>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" action="{{ url('/login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group" style="text-align: left">
                    <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group" style="text-align: left">
                    <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Mật khẩu">
                </div>
                {{--  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>  --}}
                <input type="submit" class="btn btn-primary" value="Đăng nhập"/>
            </form>
            <p class="mt-5 mb-3 text-muted"><b>v1.0</b>  Since 2019-04</p>
      </div>
  </body>
</html>