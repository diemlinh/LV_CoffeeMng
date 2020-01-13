<aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        @if (Auth::user()->hasDefinePrivilege('admin'))
                        <li class="sub-menu">
                            <a class="active" href="{{ route('quantri') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier') || Auth::user()->hasDefinePrivilege('staff'))
                        <li class="sub-menu">
                            <a href="{{ route('ban') }}">
                                <i class="fa fa-book"></i>
                                <span>QL Bàn</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="{{ route('nguyenlieu') }}">
                                <i class="fa fa-book"></i>
                                <span>QL Nguyên liệu</span>
                            </a>
                            
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="{{ route('congthuc') }}">
                                <i class="fa fa-book"></i>
                                <span>QL Công thức</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>QL Thực đơn</span>
                            </a>
                            <ul class="sub">
                            <li><a href="{{route('thucdon')}}">Thực đơn</a></li>
                            <li><a href="{{route('loai')}}">Loại</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>QL Nhập hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{route('daily')}}">Đại lý</a></li>
                                <li><a href="{{route('nhap')}}">Nhập hàng</a></li>
                                
                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="{{ route('khuyenmai') }}">
                                <i class="fa fa-book"></i>
                                <span>QL Khuyến mãi</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="{{ route('donhang') }}">
                                <i class="fa fa-book"></i>
                                <span>QL hóa đơn</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('cashier'))
                        <li class="sub-menu">
                            <a href="{{ route('thanhvien') }}">
                                <i class="fa fa-book"></i>
                                <span>QL Thành viên</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->hasDefinePrivilege('admin') || Auth::user()->hasDefinePrivilege('bartender'))
                        <li class="sub-menu">
                            <a href="{{ route('phache') }}">
                                <i class="fa fa-book"></i>
                                <span>QL Pha chế</span>
                            </a>
                        </li>
                        @endif
                        
                        {{-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-envelope"></i>
                                <span>Mail </span>
                            </a>
                            <ul class="sub">
                                <li><a href="mail.html">Inbox</a></li>
                                <li><a href="mail_compose.html">Compose Mail</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="sub">
                                <li><a href="chartjs.html">Chart js</a></li>
                                <li><a href="flot_chart.html">Flot Charts</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="sub">
                                <li><a href="google_map.html">Google Map</a></li>
                                <li><a href="vector_map.html">Vector Map</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-glass"></i>
                                <span>Extra</span>
                            </a>
                            <ul class="sub">
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="registration.html">Registration</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="login.html">
                                <i class="fa fa-user"></i>
                                <span>Login Page</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>