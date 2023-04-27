@extends( 'layouts.app' )

@section('title','dashboard')

@section('style')

@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title"> Dashboard
                                    <small></small>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Home</li>
                                    <li><a class="active">Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--page title and breadcrumb end -->

                        <!--states start-->
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="panel short-states bg-primary">
                                    <div class="pull-right state-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt">{{$students}}</h1>
                                        <div class=" pull-right">{{$students}} <i class="fa fa-bolt"></i></div>
                                        <strong class="text-uppercase">Total Student</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="panel short-states bg-info">
                                    <div class="pull-right state-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt">{{$staff}}</h1>
                                        <div class=" pull-right">{{$staff}} <i class="fa fa-level-up"></i></div>
                                        <strong class="text-uppercase">Total Staff</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="panel short-states bg-danger">
                                    <div class="pull-right state-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt">{{$course}}</h1>
                                        <div class=" pull-right">{{$course}} <i class="fa fa-level-up"></i></div>
                                        <strong class="text-uppercase">Total Courses</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--states end-->


                    </div>


                </div>
            </div>
            <!--main content end-->
@endsection

@section('script')

@endsection
