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
      <h1 class="text-black">Holiday List</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Holiday</li>
      </ol>
      <div class="add_leave">
        <button type="button" class="btn btn-info leavetype"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#holysmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Holiday</a></button>
        <!--<a class="btn btn-primary leavetype" href="">Add Leave Type</a>-->        
      </div>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">              
        <div class="col-lg-12">         
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
                  <th scope="col">Name</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  <th scope="col">Number of Days</th>
                  <th scope="col">Years</th>
                  <th scope="col">Action</th>                  
                </tr>
              </thead>
              <tbody>
                @php 
                  $sr = 1;                      
                  @endphp
                  @foreach ( $allholidays as $holidayinfo ) 
                  <tr>
                    <td>{{$sr}}</td>                    
                    <td>{{ $holidayinfo->holiday_name }}</td>
                    <td>{{date('jS \of F Y',strtotime($holidayinfo->from_date))}}</td>
                    <td>{{date('jS \of F Y',strtotime($holidayinfo->to_date))}}</td>
                    <td>{{ $holidayinfo->number_of_days }}</td>
                    <td>{{ $holidayinfo->year }}</td>
                    <td class="jsgrid-align-center ">
                      <a href="" title="Edit" class="btn btn-info holiday" data-id="<?php echo $holidayinfo->id; ?>"><i class="fa fa-pencil-square-o"></i> Edit</a> 
                      <a onclick="confirm('Are you sure want to delet this Value?')" href="{{route('admin.deleteholiday',$holidayinfo->id) }}" title="Delete" class="btn btn-info"><i class="fa fa-trash-o"></i> Delete</a>
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

<div class="modal fade" id="holysmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
      <div class="modal-content ">
          <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form method="post" action="{{route('pages.addholiday')}}" id="holidayform" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">              
              <div class="form-group">
                  <label class="control-label">Holidays name</label>
                  <input type="text" name="holiname" class="form-control" id="recipient-name1" minlength="4" maxlength="25" value="" required>
              </div>
              <div class="form-group">
                  <label class="control-label">Holidays Start Date</label>
                  <input type="date" name="startdate" class="form-control" id="date1"  value="">
              </div>
              <div class="form-group">
                  <label class="control-label">Holidays End Date</label>
                  <input type="date" name="enddate" class="form-control mydatetimepickerFull" id="date2" value="">
              </div>             
          </div>

          <div class="modal-footer">
          <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">                                       
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
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

  $(".holiday").click(function (e) {
    e.preventDefault(e);    
    var iid = $(this).attr('data-id');
    //$('#leaveform').trigger("reset");
      $('#holysmodel').modal('show');
      $.ajax({ 
        url:"{{ route('admin.editholiday')}}" + '/' + iid,            
        type: 'POST',
        data: '',
        dataType: 'json',
      }).done(function (response) { 
        $('#holidayform').find('[name="id"]').val(response.holidayvalue.id).end();
        $('#holidayform').find('[name="holiname"]').val(response.holidayvalue.holiday_name).end();
        $('#holidayform').find('[name="startdate"]').val(response.holidayvalue.from_date).end();
        $('#holidayform').find('[name="enddate"]').val(response.holidayvalue.to_date).end();
        $('#holidayform').find('[name="nofdate"]').val(response.holidayvalue.number_of_days).end();
        $('#holidayform').find('[name="year"]').val(response.holidayvalue.year).end();      
      });
  });
  setTimeout(function(){
      $("div.alert").remove();
  }, 2000 ); // 5 secs
</script>
@endsection