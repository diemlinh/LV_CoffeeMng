
<!DOCTYPE html>

<head>
    <title>Linh's Coffee Management</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/mystyle.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/font.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/css/custom-confirm.css')}}">
   
    <!-- calendar -->
    {{-- <link href="{{asset('admin/css/monthly.css')}}" rel="stylesheet"> --}}
    <!-- //calendar -->

    <script src="{{asset('admin/js/jquery2.0.3.min.js')}}"></script>
    
    <script src="{{asset('admin/js/jquery-ui.min.js')}}"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="{{asset('admin/build/css/custom.min.css" rel="stylesheet')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
    {{--  <script src="{{asset('lib/ddmodal/js/ddmodal.js')}}"></script>  --}}
</head>

<body>
    <section id="container">
		<!--header start-->
		@include('templates.admin-visitors.header')
		<!--header end-->
        <!--sidebar start-->
        @include('templates.admin-visitors.sidebar')
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
               <!--Hiển thị thông báo -->
                    <div class="col-lg-12">
                            @if (Session::has('flash_message'))
                            <div class="alert contain-alert-message alert-{{ Session::get('flash_level')}}">
                                {{ Session::get('flash_message')}}
                                
                            </div>
                            @endif
                                
                        </div>       
                @yield('content')
            </section>
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('admin/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('admin/js/scripts.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('admin/js/jquery.scrollTo.js')}}"></script>
     <!-- custom time Hiển thị thông báo  -->
     <script src="{{asset('admin/js/myscript.js')}}"></script>
     <!-- DataTables JavaScript -->
    {{-- <script src="{{asset('admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script> --}}

    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('admin/js/custom-confirm.js')}}"></script>
    

</body>

</html> 