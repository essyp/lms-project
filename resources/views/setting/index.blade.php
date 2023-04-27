@extends( 'layouts.app' )

@section('title','')

@section('style')
<!--Data Table-->
        <link href="{{asset('admins/bower_components/datatables/media/css/jquery.dataTables.css')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-tabletools/css/dataTables.tableTools.css')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-colvis/css/dataTables.colVis.css')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-responsive/css/responsive.dataTables.scss')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-scroller/css/scroller.dataTables.scss')}}" rel="stylesheet">
@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content ui-content-aside-overlay">
                <!--page header start-->
                <div class="page-head-wrap">
                    <h4 class="margin0">
                      School Settings
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">School Settings</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

            <div class="ui-content-body">

                <div class="ui-container">
                    <div class="row">                       
                        <div class="col-sm-12">
                            <button type="button" data-toggle="modal" data-target="#setting" class="btn btn-default">Add New Setting</button><br><br>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Settings 
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <form class="cmxform form-horizontal " id="update-form">
                                            {{ csrf_field() }}
                                            @foreach($data as $bl)
                                                    <div class="form">
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">{{$bl->title}}</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="description[]" value="{{$bl->description}}" type="text"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input class=" form-control" name="id[]" value="{{$bl->id}}" type="hidden"/>
                                                @endforeach
                                                <div class="modal-footer">  
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!--main content end-->



            <!-- Button import and edit modal -->
<div  id="setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> New Setting</h4>
            </div>
            <form class="cmxform form-horizontal" id="create-form">
                @csrf
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Title</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="title" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Description</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="description" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Settings Module</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="module" required="required">
                                    <option disabled selected>select module</option>
                                    <option value="school_settings">School Setting</option>
                                    <option value="school_sessions">School Session</option>
                                    <option value="school_periods">School Period</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $('#create-form').submit(function(e){
		e.preventDefault();
        $('#setting').modal('hide');
            open_loader('#page');

		var form = $("#create-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("setting/create")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message, data.status);
                    setTimeout("window.location.href='{{url('setting/school-setting')}}';");
                    close_loader('#page');
                    } else{
                        toastr.error(data.message, data.status);
                        close_loader('#page');
                    }
			},
			error: function(result){
				toastr.error('Check Your Network Connection !!!','Network Error');
                close_loader('#page');
			}
		});
		return false;
    });



    $('#update-form').submit(function(e){
		e.preventDefault();
            open_loader('#page');

		var form = $("#update-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("setting/update")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message, data.status);
                    setTimeout("window.location.href='{{url('setting/school-setting')}}';");
                    close_loader('#page');
                    } else{
                        toastr.error(data.message, data.status);
                        close_loader('#page');
                    }
			},
			error: function(result){
				toastr.error('Check Your Network Connection !!!','Network Error');
                close_loader('#page');
			}
		});
		return false;
    });

</script>
<!--Data Table-->
        <script src="{{asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-tabletools/js/dataTables.tableTools.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-colvis/js/dataTables.colVis.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-responsive/js/dataTables.responsive.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-scroller/js/dataTables.scroller.js')}}"></script>

        <!--init data tables-->
        <script src="{{asset('admins/assets/js/init-datatables.js')}}"></script>

@endsection
