@extends('layout.master')
@section('title', 'Home')
@section('content') 
@php
  use App\Helpers\Helper;
@endphp

<style>
  a:hover, a:active, a:focus {
    outline: none;
    text-decoration: none;
    color: #fff;
}
.leavetype {
      padding: 8px;
      margin-top: 15px;
  } 
</style>

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      {{-- <h1 class="text-black">Ticket</h1> --}}
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Notice  </li>
      </ol>
      @php 
      $auth = Auth::user();      
      @endphp
      @if($auth->role==2)     
      <div class="add_leave">
        <button type="button" class="btn btn-info leavetype"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#noticemodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Ticket</a></button>
        <!--<a class="btn btn-primary leavetype" href="">Add Leave Type</a>-->        
      </div>
      @endif
    </div>
   
    <!-- Main content -->
    <div class= "content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success' )}}
        </div>
        @endif
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail' )}}
            </div>  
            @endif
        <!-- /.col -->
        <div class="col-lg-12">
          <div class="info-box">
            <div class="box-body">
              <div class="right-page-header">
                <div class="d-flex">
                  <div class="align-self-center">
                    <h4 class="text-black m-b-1">Ticket List </h4>
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
                      <th>Subject</th>
                      <th>Ticket Summary</th>                      
                      <th>Department</th>
                      <th>Status </th>
                      <th>Action </th>                     
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $sr = 1;
                    @endphp
                     @foreach ($ticketinfo as $info )
                     @php
                     //dd($status);                   
                     $department = Helper::getDepartment($info->department_id);  
                     $showstatus = Helper::getstatusbyID($info->status_id);                    
                     @endphp                    
                     <tr id="{{$info->id}}">
                      <td>{{$sr}}</td>
                      <td>{{$info->subject}} </td>                   
                      <td>{{$info->ticket_summary}} </td> 
                      <td>
                        <?php if($department){?> 
                        {{$department->department_name}}
                       <?php } ?>
                      </td>                      
                      <td> 
                        @if($auth->role==2) 
                          {{$showstatus->name}} 
                        @else
                        <a class="btn btn-primary" href="javasciprt:void(0);">{{$showstatus->name}}</a>                                                 
                        @endif
                      </td>
                      <td><a class="btn btn-primary" href="javasciprtvoid(0)">View</a></td>
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
    
    

    <div class="modal fade" id="noticemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
      <div class="modal-dialog" role="document">
          <div class="modal-content ">           
              <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel1"> Add Ticket</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
            @foreach ($userinfo as $user)
              <form role="form" method="post" action="{{ route('add_newTicket') }}" enctype="multipart/form-data" >
                @csrf
              <div class="modal-body">
                  <div class="form-group">
                      <label for="message-text" class="control-label">Employee</label>
                      <input type="text" name="employee" value="{{ $user->fname.' '. $user->lname}}" class="form-control" id="employee">
                  </div>                    
                  <div class="form-group">
                      <label for="message-text" class="control-label" required>Subject</label>
                      <input type="text" name="subject" class="form-control" id="subject">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label" required>Department</label>
                    <select class="form-control" name="department">
                      <option value="" selected> Choose one </option>
                      @foreach ($departments as $departments )
                      <option value="{{$departments->id}}"> {{$departments->department_name}} </option>
                      @endforeach
                    </select>                                    
                  </div>                   
                  <div class="form-group">
                      <label for="message-text" class="control-label" required>Ticket Summary</label>
                      <textarea name="ticket_summary"  class="form-control" id="recipient-name1"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="message-text" class="control-label" required>Attachment</label>
                      <input type="file" name="file" class="form-control" id="file"></textarea>
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
  @endforeach
  @section('extra-js')
 
  <script>
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });



  //$("#status_id").on('change', function (e) {
  $('select[name="status"]').on('change', function(e) {
      e.preventDefault(e);        
      //var status_id = this.value;
      console.log($(this).attr('data'));
      console.log($(this).val());
      // var tcktId = this.value;
      //var tcktId = $('.tktid').val();
      //alert(tcktId);
      //console.log(ticket_id);
      return false;
          $.ajax({ 
          url:"{{ route('updatetktstatus')}}" + '/' + status_id,         
          type: 'POST',
          data: {
            statusid: status_id
          },         
        }).done(function (response) { 
          if(response==='success') {               
                setTimeout(function () {                  
                  location.reload();
                }, 1000);
              }    
        });      
    });

    setTimeout(function () { 
      $('.alert-success').remove();         
        }, 3000);
  </script>
@endsection
@endsection
