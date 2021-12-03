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
      <h1 class="text-black">Application</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Application</li>
      </ol>
      <div class="add_leave">
        <button type="button" class="btn btn-info leavetype"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Application</a></button>
        <!--<a class="btn btn-primary leavetype" href="">Add Leave Type</a>-->        
      </div>
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
                  <div class="align-self-center">
                    <h4 class="text-black m-b-1">Employee List </h4>
                  </div>
                  <div class="ml-auto">
                    <input id="demo-input-search2" placeholder="search contacts" class="form-control" type="text">
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover no-wrap">
                  <thead>
                    <tr>
                      <th>Sr No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Designation</th>
                      <th>DOJ</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>             
                        
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
          <form method="post" action="Add_Applications" id="leaveapply" enctype="multipart/form-data">
              <div class="modal-body">
                  
                  <div class="form-group">
                      <label>Employee</label>                      
                  </div>
                  <div class="form-group">
                      <label>Leave Type</label>
                      <select class="form-control custom-select assignleave"  tabindex="1" name="typeid" id="leavetype" required>
                          
                      </select>
                  </div>
                  <div class="form-group">
                      <span style="color:red" id="total"></span>
                      <div class="span pull-right">
                          <button class="btn btn-info fetchLeaveTotal">Fetch Total Leave</button>
                      </div>
                      <br>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Leave Duration</label><br>
                      <input name="type" type="radio" id="radio_1" data-value="Half" class="duration" value="Half Day" checked="">
                      <label for="radio_1">Hourly</label>
                      <input name="type" type="radio" id="radio_2" data-value="Full" class="type" value="Full Day">
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
                      <input type="date" name="enddate" class="form-control" id="recipient-name1">
                  </div>

                  <div class="form-group" id="hourAmount">
                      <label>Length</label>
                      <select  id="hourAmountVal" class=" form-control custom-select"  tabindex="1" name="hourAmount" required>
                          <option value="">Select Hour</option>
                          <option value="1">One hour</option>
                          <option value="2">Two hour</option>
                          <option value="3">Three hour</option>
                          <option value="4">Four hour</option>
                          <option value="5">Five hour</option>
                          <option value="6">Six hour</option>
                          <option value="7">Seven hour</option>
                          <option value="8">Eight hour</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Reason</label>
                      <textarea class="form-control" name="reason" id="message-text1" required minlength="10"></textarea>                                                
                  </div>                  
              </div>              
              <div class="modal-footer">
                  <input type="hidden" name="id" class="form-control" id="recipient-name1" required>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
      </div>
  </div>
</div>