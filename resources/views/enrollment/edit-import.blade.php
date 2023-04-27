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
                      Edit Enrollment Import
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Edit Enrollment Import</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

            <div class="ui-content-body">

                <div class="ui-container">
                    <div class="row">
                        <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                       Import 
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <form class="cmxform form-horizontal " id="import-form">
                                            {{ csrf_field() }}
                                            @foreach($data[0] as $bl)
                                                <div class="modal-body">
                                                    <div class="form">
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Student No</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="student_id[]" value="{{$bl->student_id}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Previous Class ID</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="previous_id[]" value="{{$bl->previous_id}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Previous Class Code</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="previous_code[]" value="{{$bl->previous_code}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Previous Class Name</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="previous_name[]" value="{{$bl->previous_name}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Next Class ID</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="next_id[]" value="{{$bl->next_id}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Next Class Code</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="next_code[]" value="{{$bl->next_code}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title" class="control-label col-lg-3">Next Class Name</label>
                                                            <div class="col-lg-9">
                                                                <input class=" form-control" name="next_name[]" value="{{$bl->next_name}}" type="text" required="required"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                @endforeach
                                                <div class="modal-footer">                                                    
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
@endsection


@section('script')
<script>
    $('#import-form').submit(function(e){
		e.preventDefault();
        $('#import').modal('hide');
            open_loader('#page');

		var form = $("#import-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("enrollment/import-edited-data")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message, data.status);
                    setTimeout("window.location.href='{{url('enrollment/history')}}';");
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
