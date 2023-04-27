<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
    <title>LMS - @yield('title')</title>

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('admins/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/bower_components/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admins/bower_components/weather-icons/css/weather-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/bower_components/themify-icons/css/themify-icons.css')}}">
    <link href="" style="max-width: 16px; max-height: 16px" rel="shortcut icon">
    <!-- endinject -->
    @yield('style')
    <!-- Main Style  -->
    <link rel="stylesheet" href="{{asset('admins/dist/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('admins/assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/assets/css/waitMe.min.css')}}">

    <!--horizontal-timeline-->
    <link rel="stylesheet" href="{{asset('admins/assets/js/horizontal-timeline/css/style.css')}}">


    <script src="{{asset('admins/assets/js/modernizr-custom.js')}}"></script>
</head>

<body id="page">

    <div id="ui" class="ui">

        <!--header start-->
        <header id="header" class="ui-header">

            <div class="navbar-header">
            </div>

            <div class="search-dropdown dropdown pull-right visible-xs">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
                        class="fa fa-search"></i></button>
                <div class="dropdown-menu">
                    <form>
                        <input class="form-control" placeholder="Search here..." type="text">
                    </form>
                </div>
            </div>

            <div class="navbar-collapse nav-responsive-disabled">

                <!--toggle buttons start-->
                <ul class="nav navbar-nav">
                    <li>
                        <a class="toggle-btn" data-toggle="ui-nav" href="">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <!-- toggle buttons end -->

            </div>

        </header>
        <!--header end-->

        <!--sidebar start-->
        <aside id="aside" class="ui-aside">
            <ul class="nav" ui-nav>
                <li class="nav-head">
                    <h5 class="nav-title text-uppercase light-txt">Navigation</h5>
                </li>
                <li class="active"><a href="{{url('/')}}"><i class="fa fa-home"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href=""><i class="fa fa-info"></i><span>App Setup</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href=""><span>Setup</span></a></li>
                        <li><a href="{{url('/setting/school-setting')}}"><span>School Settings</span></a></li>
                        <li><a href="{{url('/setting/grade-setting')}}"><span>Grade Settings</span></a></li>
                    </ul>
                </li>

                <li class="nav-head">
                    <h5 class="nav-title text-uppercase light-txt">Layouts</h5>
                </li>
                <li>
                    <a href=""><i class="fa fa-users"></i><span>Students</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href=""><span>Students</span></a></li>
                        <li><a href="{{url('/student/history')}}"><span>Students History</span></a></li>
                        <li><a href="{{url('/enrollment/student')}}"><span>Enrollment History</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-users"></i><span>Staff</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href=""><span>Staff</span></a></li>
                        <li><a href="{{url('/staff/history')}}"><span>Staff History</span></a></li>
                        <li><a href="{{url('/enrollment/staff')}}"><span>Enrollment History</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-th-large"></i><span>Courses</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href=""><span>Courses</span></a></li>
                        <li><a href="{{url('/course/history')}}"><span>Course History</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href=""><i class="fa fa-th-large"></i><span>Class Groups</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href=""><span>Class</span></a></li>
                        <li><a href="{{url('/class/groups')}}"><span>Class History</span></a></li>
                    </ul>
                </li>
                
            </ul>
        </aside>
        <!--sidebar end-->
        @yield('content')


        <!--footer start-->
        <div id="footer" class="ui-footer">
            <?php echo date("Y"); ?> &copy; Francis mogbana </a>.
        </div>
        <!--footer end-->

    </div>

    <!-- inject:js -->
    <script src="{{asset('admins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admins/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('admins/bower_components/autosize/dist/autosize.min.js')}}"></script>
    <!-- endinject -->


    <!--sparkline-->
    <script src="{{asset('admins/bower_components/bower-jquery-sparkline/dist/jquery.sparkline.retina.js')}}"></script>
    <script src="{{asset('admins/assets/js/init-sparkline.js')}}"></script>


    <!--horizontal-timeline-->
    <script src="{{asset('admins/assets/js/horizontal-timeline/js/jquery.mobile.custom.min.js')}}"></script>
    <script src="{{asset('admins/assets/js/horizontal-timeline/js/main.js')}}"></script>

    <!-- Common Script   -->
    <script src="{{asset('admins/dist/js/main.js')}}"></script>
    <script src="{{asset('admins/assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('admins/assets/js/waitMe.min.js')}}"></script>
    <script>
    function open_loader(container) {
        $(container).waitMe({
            effect: 'bounce',
            text: '',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: '',
            waitTime: '-1',
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function() {}
        });
    }

    function close_loader(container) {
        $(container).waitMe("hide");
    }
    </script>
    @yield('script')

</body>

</html>