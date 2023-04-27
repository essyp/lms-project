@extends( 'layouts.app' )

@section('title','Grade Setup')

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
                        Grade Setup
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Grade Setup</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

            <div class="ui-content-body">

                <div class="ui-container">
                    <div class="row">
                    <form id="status_form" action='{{url("setting/grade-bulk-action")}}' method="POST">
                        {{ csrf_field() }}
                        <div class="col-sm-12">
                            <div class="mbot-20">
                                    <div class="btn-group">
                                       <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><button class="btn btn-danger" name="submit" type="button" onclick="status_form('delete')">Delete</button></li>
                                        </ul>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#new_student" class="btn btn-default">New Grade</button>
                                    <a style="float:right" href="{{url('grade/export')}}" class="btn btn-info">Export</a>
                                </div>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Grade Setup
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body" style="overflow-x:auto;">
                                        <table id="datatable" class="table table-striped">
                                            <thead>
                                            <tr style="white-space: normal">
                                                <th><input type="checkbox" onClick="checkAllContestant()" id="chAllCon" /></th>                                                
                                                <th>Grade Code</th>
                                                <th>Min Score</th>
                                                <th>Max Score</th>
                                                <th>Letter Grade</th>
                                                <th>Comment Grade</th>
                                                <th>GPA Grade </th>
                                                <th>Registration Code</th>
                                                <th>Grade Scale Type</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $bl)
                                            <tr style="white-space: normal">
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                <td>{{$bl->grade_code}}</td>
                                                <td>{{$bl->min_score}}</td>
                                                <td>{{$bl->max_score}}</td>
                                                <td>{{$bl->letter_grade}}</td>
                                                <td>{{$bl->comment_grade}}</td>
                                                <td>{{$bl->gpa_grade}}</td>
                                                <td>{{$bl->registration_code}}</td>
                                                <td>{{$bl->grade_scale_type}}</td>
                                                <td>{{$bl->created_at}}</td>  
                                                <td>
                                                <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" style="color: blue" onclick="update({{$bl}})">Update</a></li>
                                                    </ul>
                                                </div>
                                                </td>
                                            </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </form>

                    </div>


                </div>
            </div>
            <!--main content end-->
@endsection



<!-- create modal -->
<div  id="new_student" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Grade</h4>
            </div>
            <form class="cmxform form-horizontal " id="create-form">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Grade Code</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="grade_code" required="required">
                                    <option disabled selected>select</option>
                                    <option value="G1">G1</option>
                                    <option value="G2">G2</option>
                                    <option value="G3">G3</option>
                                    <option value="G4">G4</option>
                                    <option value="G5">G5</option>
                                    <option value="G6">G6</option>
                                    <option value="G7">G7</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Min Score</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="min_score" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Max Score</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="max_score" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Letter Grade</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="letter_grade" required="required">
                                    <option disabled selected>select</option>
                                    <option value="A">A</option>
                                    <option value="A1">A1</option>
                                    <option value="B">B</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C">C</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D">D</option>
                                    <option value="D7">D7</option>
                                    <option value="E">E</option>
                                    <option value="E8">E8</option>
                                    <option value="F">F</option>
                                    <option value="F9">F9</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Comment Grade</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="comment_grade" required="required">
                                    <option disabled selected>select</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Very Good">Very Good</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Pass">Pass</option>
                                    <option value="Fail">Fail</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">GPA Grade </label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="gpa_grade" required="required">
                                    <option disabled selected>select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Registration Code</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="registration_code" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Grade Scale Type</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="grade_scale_type" type="text" required="required"/>
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





<!-- Button edit modal -->
<div  id="editmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Grade</h4>
            </div>
            <form class="cmxform form-horizontal " id="edit-form">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Grade Code</label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="edit_grade_code" name="grade_code" required="required">
                                    <option disabled selected>select</option>
                                    <option value="G1">G1</option>
                                    <option value="G2">G2</option>
                                    <option value="G3">G3</option>
                                    <option value="G4">G4</option>
                                    <option value="G5">G5</option>
                                    <option value="G6">G6</option>
                                    <option value="G7">G7</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Min Score</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_min_score" name="min_score" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Max Score</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_max_score" name="max_score" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Letter Grade</label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="edit_letter_grade" name="letter_grade" required="required">
                                    <option disabled selected>select</option>
                                    <option value="A">A</option>
                                    <option value="A1">A1</option>
                                    <option value="B">B</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C">C</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D">D</option>
                                    <option value="D7">D7</option>
                                    <option value="E">E</option>
                                    <option value="E8">E8</option>
                                    <option value="F">F</option>
                                    <option value="F9">F9</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Comment Grade</label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="edit_comment_grade" name="comment_grade" required="required">
                                    <option disabled selected>select</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Very Good">Very Good</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Pass">Pass</option>
                                    <option value="Fail">Fail</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">GPA Grade </label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="edit_gpa_grade" name="gpa_grade" required="required">
                                    <option disabled selected>select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Registration Code</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_registration_code" name="registration_code" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Grade Scale Type</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_grade_scale_type" name="grade_scale_type" type="text" required="required"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class=" form-control" id="edit_id" name="id" type="hidden" required="required"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>




@section('script')
<script>
   
    function status_form(value) {
        open_loader('#page');

		var form = document.getElementById('status_form');
        var _data = new FormData(form);
        _data.append('submit',value);

		$.ajax({
			url: form.action,
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: form.method,
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
                    toastr.success(data.message, data.status);
                    $( "#datatable" ).load( "{{url('setting/grade-setting')}} #datatable" );
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
    }

    function update(event){
        //$('#modaltitle').text("Update " +event.title)
        $('#edit_grade_code').val(event.grade_code)
        $('#edit_min_score').val(event.min_score)
        $('#edit_max_score').val(event.max_score)
        $('#edit_letter_grade').val(event.letter_grade)
        $('#edit_comment_grade').val(event.comment_grade)
        $('#edit_gpa_grade').val(event.gpa_grade)
        $('#edit_registration_code').val(event.registration_code)
        $('#edit_grade_scale_type').val(event.grade_scale_type)
        $('#edit_id').val(event.id)
        $('#editmodal').modal('show')
    }

    $('#create-form').submit(function(e){
        e.preventDefault();
        $('#new_student').modal('hide');
            open_loader('#page');

        var form = $("#create-form")[0];
        var _data = new FormData(form);
        $.ajax({
            url: '{{url("setting/create-grade")}}',
            data: _data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType:false,
            type: 'POST',
            success: function(data){
                //$("#service").modal("toggle");
                if(data.status == "success"){
                    toastr.success(data.message);
                    $( "#datatable" ).load( "{{url('/setting/grade-setting')}} #datatable" );
                    close_loader('#page');
                    } else{
                        toastr.error(data.message);
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

    $('#edit-form').submit(function(e){
        e.preventDefault();
        $('#editmodal').modal('hide');
            open_loader('#page');

        var form = $("#edit-form")[0];
        var _data = new FormData(form);
        $.ajax({
            url: '{{url("setting/update-grade")}}',
            data: _data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType:false,
            type: 'POST',
            success: function(data){
                //$("#service").modal("toggle");
                if(data.status == "success"){
                    toastr.success(data.message);
                    $( "#datatable" ).load( "{{url('/setting/grade-setting')}} #datatable" );
                    close_loader('#page');
                    } else{
                        toastr.error(data.message);
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

    function checkAllContestant(){
    var ch =document.getElementById('chAllCon').checked,
    checked = false;
    if(ch){
        checked=true;
    }
        var els = document.getElementsByClassName('contestantBox');

        for(var g=0;g<els.length;g++){
            els[g].checked=checked;
        }


    }

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
