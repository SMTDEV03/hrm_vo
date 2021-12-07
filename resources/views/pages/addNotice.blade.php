@extends('layout.master')
@section('title', 'Home')
@section('content') 

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
      <h1 class="text-black">Notice</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Notice  </li>
      </ol>
      <div class="add_leave">
        <button type="button" class="btn btn-info leavetype"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#noticemodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Notice</a></button>
        <!--<a class="btn btn-primary leavetype" href="">Add Leave Type</a>-->        
      </div>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
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
                    <h4 class="text-black m-b-1">Notice List </h4>
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
                      <th>Notice Title </Title></th>
                      <th>Date </th>
                      <th>Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $sr = 1;
                    @endphp
                   @foreach($notice as $n)  
                    <tr>
                      <td>{{$sr}}</td>
                      <td>{{$n->title}}</td>
                      <td>{{$n->date}}</td>                   
                      <td>               
                        <a href="{{ route('deleteNotice', $n->id)}}" title="Delete" class="btn btn-info alert"><i class="fa fa-trash-o"></i> Delete</a> </td>               
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
                  <h4 class="modal-title" id="exampleModalLabel1">Notice Board</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form role="form" method="post" action="{{ route('noticeStore') }}" >
                @csrf
              <div class="modal-body">
                      <div class="form-group">
                          <label for="message-text" class="control-label">Notice Title</label>
                          <textarea class="form-control" name="title" id="message-text1" maxlength="150" required></textarea>
                      </div>                    
                      <div class="form-group">
                          <label for="message-text" class="control-label" required>Published Date</label>
                          <input type="date" name="notice_date" class="form-control" id="recipient-name1">
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
<script>
setTimeout(function(){
      $("div.alert").remove();
  }, 2000 ); // 5 secs  
</script>