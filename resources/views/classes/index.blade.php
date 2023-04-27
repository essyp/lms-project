@extends( 'layouts.app' )

@section('title','Class Groups')

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
                        Class Groups
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Class Groups</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

            <div class="ui-content-body">

                <div class="ui-container">
                    <div class="row">
                    <form id="status_form" action='{{url("class/bulk-action")}}' method="POST">
                        {{ csrf_field() }}
                        <div class="col-sm-12">
                            <div class="mbot-20">
                                    <div class="btn-group">
                                       <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><button class="btn btn-danger" name="submit" type="button" onclick="status_form('delete')">Delete</button></li>
                                        </ul>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#new_student" class="btn btn-default">New Class Group</button>
                                </div>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Class Groups
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
                                                <th>Class Group Code</th>
                                                <th>Class Group Name</th>
                                                <th>Next Class</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $bl)
                                            <tr style="white-space: normal">
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                <td>{{$bl->code}}</td>
                                                <td>{{$bl->name}}</td>
                                                <td>{{$bl->next_class}}</td>
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
                <h4 class="modal-title" id="myModalLabel">Add New Class</h4>
            </div>
            <form class="cmxform form-horizontal " id="create-form">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Class Code</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="code" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Class Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="name" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Next class</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="next_class" type="text" required="required"/>
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
                <h4 class="modal-title" id="myModalLabel">Update Enrollment</h4>
            </div>
            <form class="cmxform form-horizontal " id="edit-form">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Class Code</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_code" name="code" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Class Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_name" name="name" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Next class</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edit_next_class" name="next_class" type="text" required="required"/>
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
                    $( "#datatable" ).load( "{{url('class/groups')}} #datatable" );
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
        $('#edit_code').val(event.code)
        $('#edit_name').val(event.name)
        $('#edit_next_class').val(event.next_class)
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
            url: '{{url("class/create")}}',
            data: _data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType:false,
            type: 'POST',
            success: function(data){
                //$("#service").modal("toggle");
                if(data.status == "success"){
                    toastr.success(data.message);
                    $( "#datatable" ).load( "{{url('/class/groups')}} #datatable" );
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
            url: '{{url("class/update")}}',
            data: _data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType:false,
            type: 'POST',
            success: function(data){
                //$("#service").modal("toggle");
                if(data.status == "success"){
                    toastr.success(data.message);
                    $( "#datatable" ).load( "{{url('/class/groups')}} #datatable" );
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
