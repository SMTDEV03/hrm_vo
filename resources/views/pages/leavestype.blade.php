@extends('layout.master')
@section('title', 'Home')
@section('content')
<style>
.leavetype {
    padding: 8px;
    margin-top: 15px;
} 
a:hover, a:active, a:focus {    
    text-decoration: none;
    color: #fff;
    border: none;
} 
</style>
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Leave List</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Department</li>
      </ol>
      <div class="add_leave">
        <button type="button" class="btn btn-info leavetype"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#leavemodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Leave Types</a></button>
        <!--<a class="btn btn-primary leavetype" href="">Add Leave Type</a>-->        
      </div>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">              
        <div class="col-lg-9">         
          @if(Session::get('success'))   
          <div class="alert alert-info" role="alert">   
          {{ Session::get('success' )}}  
          </div>    
          @endif
          
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Leave Type</th>
                  <th scope="col">Number Of Days</th>
                  <th scope="col">Action</th>                  
                </tr>
              </thead>
              <tbody>
                @php 
                  $sr = 1;                      
                  @endphp
                  @foreach ( $allLeavetypes as $Leaveinfo ) 
                  <tr>
                    <td>{{$sr}}</td>
                    <td>{{ $Leaveinfo->name }}</td>
                    <td>{{ $Leaveinfo->leave_days }}</td>
                    <td>
                      <a href="" title="Edit" class="btn btn-primary leave_type" data-id="<?php echo $Leaveinfo->id; ?>"><i class="fa fa-pencil-square-o"></i>Edit</a>                      
                    </td>                      
                  </tr>
                @php 
                $sr++;                      
                @endphp
                @endforeach                 
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.col --> 
      </div>
      <!-- Main row --> 
    </div>
    <!-- /.content --> 
  </div>
    <!-- Main row --> 
@endsection
<div class="modal fade" id="leavemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
      <div class="modal-content ">
          <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel1">Leave</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>         
          <form method="post" action="{{route('admin.addleave') }}" id="leaveform" enctype="multipart/form-data">
            @csrf
              <div class="modal-body">
                 <span id="err_msg"></span>                  
                  <div class="form-group">
                      <label class="control-label">Leave name</label>
                      <input type="text" name="leavename" class="form-control" id="leave-name" minlength="1" maxlength="35" value="{{ old('leavename')}}">
                  </div>
                  <div class="form-group">
                      <label class="control-label">Day</label>
                      <input type="text" name="leaveday" class="form-control" id="leave_value" value="{{ old('leaveday')}}">
                  </div>                
              </div>
              <div class="modal-footer">
                  <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="leave-sbt">Submit</button>
              </div>
          </form>
      </div>
  </div>
</div>
<style>
.table td, .table th {
    padding: 5px !important;
  }
</style>
@section('leave-js')
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $(document).ready(function(){    
    $('#leave-sbt').click(function(){          
        var lvname = $('#leave-name').val();  
        var lvtype = $('#leave_value').val();     
        if(lvname==''){
            $('#err_msg').text('Please Enter Leave Name');
            $('#leave-name').focus();
            return false;
        }
        if(lvtype==''){
            $('#err_msg').text('Please Enter Leave Days');
            $('#leave_value').focus();
            return false;
        }           
    });
  }) 

  $(".leave_type").click(function (e) {
    e.preventDefault(e);    
    var iid = $(this).attr('data-id');
    //$('#leaveform').trigger("reset");
      $('#leavemodel').modal('show');
      $.ajax({ 
        url:"{{ route('admin.editleave') }}" + '/' + iid,            
        method: 'POST',
        data: '',
        dataType: 'json',
      }).done(function (response) {
        console.log(response);        
      });
  });
</script>
@endsection