
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="" class="logo" style="font-size:30px; text-transform: capitalize;">
                    Coffee Mng
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <!--<li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="45">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Product Delivery</h5>
                                            <p>45% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="78">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Payment collection</h5>
                                            <p>87% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="60">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>33% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="90">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <!--<li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    {{-- <span class="photo"><img alt="avatar" src="images/3.png"></span> --}}
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    {{-- <span class="photo"><img alt="avatar" src="images/1.png"></span> --}}
                                    <span class="subject">
                                        <span class="from">Jane Doe</span>
                                        <span class="time">2 min ago</span>
                                    </span>
                                    <span class="message">
                                        Nice admin template
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    {{-- <span class="photo"><img alt="avatar" src="images/3.png"></span> --}}
                                    <span class="subject">
                                        <span class="from">Tasi sam</span>
                                        <span class="time">2 days ago</span>
                                    </span>
                                    <span class="message">
                                        This is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    {{-- <span class="photo"><img alt="avatar" src="images/2.png"></span> --}}
                                    <span class="subject">
                                        <span class="from">Mr. Perfect</span>
                                        <span class="time">2 hour ago</span>
                                    </span>
                                    <span class="message">
                                        Hi there, its a test
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a id="toogle-header-notify" data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-bell-o"></i>
                            <span id="notify-count" class="badge bg-warning">0</span>
                        </a>
                        <ul class="dropdown-menu header-notify-list extended notification">
                            {{--  <li>
                                <a onclick="dismissAllNotify()" style="float: right; text-align: right">
                                    Dismiss All
                                </a>
                            </li>  --}}
                            <li id="notify-list">
                                <li class="alert-no-container">
                                    <p>Không có thông báo mới</p>
                                </li>
                            </li>
                        </ul>
                    </li>
                    <script type="text/javascript">
                        var notifyCountTag = $('#notify-count');
                        var notifyTag = $('#notify-list');
                        var notifyCount = parseInt(notifyCountTag.text());
                        if (sessionStorage.getItem("headerNotifyCount")){
                            notifyCount = sessionStorage.getItem("headerNotifyCount");
                            notifyCountTag.text(notifyCount);
                            notifyTag.html(sessionStorage.getItem("headerNotify"));
                        }

                        if (notifyCount < 1) {
                            $('.alert-container').hide();
                            notifyCountTag.hide();
                        } else { 
                            $('.alert-no-container').remove();
                        }
                        

                        var pusher = new Pusher('e4ec9d179835b07f69e2', {
                            encrypted: true,
                            cluster: "ap1",
                            // forceTLS: true
                        });
                    
                        // Subscribe to the channel we specified in our Laravel Event
                        var channel = pusher.subscribe('header-notify');
                    
                        // Bind a function to a Event (the full Laravel class)
                        channel.bind('App\\Events\\PhachePusherEvent', function(data) {
                            //alert(data.message);
                            $('.alert-no-container').remove();
                            var oldNotify = notifyTag.html();
                            var idGen = Math.floor((Math.random() * 100000) + 1) 
                                        + Math.floor((Math.random() * 100000) + 1) 
                                        + Math.floor((Math.random() * 100000) + 1);
                            var idGen = "alert-"+idGen;
                            var newNotify = `<li id="` +idGen+`"class="alert-container">
                                                <div class="alert alert-success clearfix">
                                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                                    <div class="noti-info">` + data.message +
                                                    `</div>
                                                    <a href="#" onClick="dismissNotify('`+idGen+`')" style="float: right">
                                                        <i class="glyphicon glyphicon-remove"></i>
                                                    </a>
                                                </div>
                                            </li>`;
                            
                            notifyCount++;
                            notifyCountTag.text(notifyCount);
                            notifyCountTag.show();
                            sessionStorage.setItem("headerNotify",newNotify + oldNotify);
                            sessionStorage.setItem("headerNotifyCount",notifyCount);
                            notifyTag.html(newNotify + oldNotify);
                        });

                        $('.dropdown-menu.header-notify-list').on('click', function (e) {
                            e.stopPropagation();
                        });

                        function dismissNotify($alertId){
                            var notifyTag = $('#notify-list');
                            var notifyCountTag = $('#notify-count');
                            var notifyCount = parseInt(notifyCountTag.text());
                            notifyCount--;
                            $("#"+$alertId).remove();
                            notifyCountTag.text(notifyCount);
                            if (notifyCount > 0) {
                                sessionStorage.setItem("headerNotify",notifyTag.html());
                                sessionStorage.setItem("headerNotifyCount",notifyCount);
                            } else {
                                sessionStorage.removeItem("headerNotify");
                                sessionStorage.removeItem("headerNotifyCount");
                                notifyCountTag.hide();
                                notifyTag.html(`<li class="alert-no-container">
                                                    <p>Không có thông báo mới</p>
                                                </li>`);
                            }
                        }

                        function dismissAllNotify(){
                            var notifyTag = $('#notify-list');
                            var notifyCountTag = $('#notify-count');
                            notifyCountTag.text(0);
                            notifyCountTag.hide();
                            notifyTag.html(`<li class="alert-no-container">
                                                <p>Không có thông báo mới</p>
                                            </li>`);
                            sessionStorage.removeItem("headerNotify");
                            sessionStorage.removeItem("headerNotifyCount");
                        }
                    </script>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    {{-- <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li> --}}
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('admin/images/2.png')}}">
                            <span class="username">
                            {{ Auth::user()->ten_dang_nhap }}
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            {{-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->