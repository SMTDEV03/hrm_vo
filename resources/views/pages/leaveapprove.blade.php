@extends('layout.master')
@section('title', 'Home')
@section('content')
@php use App\Helpers\Helper; @endphp
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
  .table td, .table th {
    padding: 5px;
    vertical-align: top;
    border-top: 1px solid #eceeef;
    text-align: center;
}
  </style>
   @php 
    $user = auth()->user();        
    @endphp
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Leave Application</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Application</li>
      </ol>
      @if($user->role == 2)
      <div class="add_leave">
        <button type="button" class="btn btn-info leavetype"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Application</a></button>
        <!--<a class="btn btn-primary leavetype" href="">Add Leave Type</a>-->        
      </div>
      @endif
    </div>    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">       
        <!-- /.col -->
        <div class="col-lg-12">
          <div class="info-box">
            <div class="box-body">
              <div class="right-page-header">
                <div class="d-flex">                 
                  <div class="ml-auto">
                    <input id="demo-input-search2" placeholder="search contacts" class="form-control" type="text">
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="example2" class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Sr No</th>
                      <th scope="col">Leave Type</th>                      
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Apply Date</th>
                      <th scope="col">Duration</th> 
                      @if($user->role == 2)
                      <th scope="col">Leave Status</th>
                      @endif                     
                      @if($user->role == 1)
                      <th scope="col">Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                      $sr = 1;                      
                      @endphp
                      <?php //dd($allLeaveinfo);?>
                      @foreach ( $allLeaveinfo as $allLeaveinfo ) 
                      
                      <tr>
                        <td>{{$sr}}</td>
                        <td>                        
                          @php
                          $test = Helper::getLeavename($allLeaveinfo->leave_type_id);
                         @endphp
                         {{$test->name}}
                        </td>                        
                        <td>{{date('jS \of F Y',strtotime($allLeaveinfo->start_date));}}</td>
                        <?php if($allLeaveinfo->end_date){?>                       
                        <td><?php echo date('jS \of F Y',strtotime($allLeaveinfo->end_date))?></td>
                        <?php } else{ ?> 
                        <td>-----</td> 
                        <?php }?>                                             
                        <td>{{date('jS \of F Y',strtotime($allLeaveinfo->apply_date));}}</td>
                        <td>{{ $allLeaveinfo->leave_type.' ('.$allLeaveinfo->leave_duration. ')'}}</td>
                        @php
                          if ($allLeaveinfo->leave_status=='Not Approve') {
                            $status ='Not Approve';
                          } else{
                            $status ='Approve';
                          }                                                
                         @endphp
                         @if($user->role == 2) 
                          <td>{{$status;}}</td>
                         @endif
                        @if($user->role == 1)                        
                          <td class="jsgrid-align-center ">                          
                            <a onclick="confirm('Are you sure want to Approve?')" href="{{route('admin.approveleave',$allLeaveinfo->id) }}" title="Delete" class="btn btn-info"><?php echo $status?></a>                                                                          
                          </td>
                        @endif                                             
                      </tr>
                    @php 
                    $sr++;                      
                    @endphp
                    @endforeach                 
                  </tbody>
                </table>
              </div>
            </div>
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

<div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
  <div class="modal-dialog" role="document">
      <div class="modal-content ">
          <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel1">Leave Application</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form method="post" action="{{route('admin.addapplication')}}" id="leaveapply" enctype="multipart/form-data">
            @csrf
              <div class="modal-body">                  
                  <div class="form-group">
                      <label>Employee Name</label> 
                      <input type="text" name="empname" id="empid" value="{{$userinfo[0]->fname.' '. $userinfo[0]->lname}}" class="form-control" readonly>                     
                  </div>
                  <div class="form-group">
                    <span style="color:red" id="total"></span>
                    <div class="span pull-right">
                        <button class="btn btn-info fetchLeaveTotal">Fetch Total Leave</button>
                    </div>
                    <br>
                </div>
                  <div class="form-group">
                      <label>Leave Type</label>
                      <select class="form-control custom-select assignleave"  tabindex="1" name="typeid" id="leavetype" required>
                        <?php foreach($allLeavetypes as $value): ?>
                          <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>                  
                  <div class="form-group">
                    <label class="control-label">Leave Duration</label><br>                    
                    <input name="type" type="radio" id="radio_2" data-value="Full" class="type" value="Full Day" checked="">
                    <label for="radio_2">Full Day</label>
                    <input name="type" type="radio" class="with-gap duration" id="radio_3" data-value="More" value="More than One day">
                    <label for="radio_3">Above a Day</label>
                </div>

                  <div class="form-group">
                      <label class="control-label" id="hourlyFix">Date</label>
                      <input type="date" name="startdate" class="form-control" id="recipient-name1" required>
                  </div>
                  <div class="form-group" id="enddate" style="display:none">
                      <label class="control-label">End Date</label>
                      <input type="date" name="end_date" class="form-control" id="recipient-name1">
                  </div>                  
                  <div class="form-group">
                      <label class="control-label">Reason</label>
                      <textarea class="form-control" cols="5" rows="5" name="reason" id="message-text1" required ></textarea>                                                
                  </div>                  
              </div>              
              <div class="modal-footer">
                  <input type="hidden" name="userid" class="form-control" id="userid" value="{{$userinfo[0]->user_id}}">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
      </div>
  </div>
</div>
@section('application-js')
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        }
  });

  $(document).ready(function () {
      $('#leaveapply input').on('change', function(e) {
          e.preventDefault(e);
          // Get the record's ID via attribute  
          var duration = $('input[name=type]:checked', '#leaveapply').attr('data-value');

          if(duration =='Half'){
              $('#enddate').hide();
              $('#hourlyFix').text('Date');
              $('#hourAmount').show();
          }
          else if(duration =='Full'){
              $('#enddate').hide();  
              $('#hourAmount').hide();  
              $('#hourlyFix').text('Start date');  
          }
          else if(duration =='More'){
              $('#enddate').show();
              $('#hourAmount').hide();
          }
      });
  });
  $(document).ready(function () {
        $('.fetchLeaveTotal').on('click', function (e) {
            e.preventDefault();
            var EmployeeID = $('#userid').val();            
            var leaveTypeID = $('.assignleave').val();
            //console.log(selectedEmployeeID, leaveTypeID);
            $.ajax({
                url:"{{route('admin.fetchleave') }}" + '/' + EmployeeID, 
                //url: 'LeaveAssign?leaveID=' + leaveTypeID + '&employeeID=' +selectedEmployeeID,
                method: 'post',
                data: '',
            }).done(function (response) {
                console.log(response);
                $("#total").html(response);
                setTimeout(function(){
                $("#leave-table").css("display", "none");                   
                    //$("#fetchLeaveTotal").hide();
                },15000 ); 
            });
        });
    });
    
</script>
@endsection