@extends('layout.master')
@section('title', 'Home')
@section('content')
@php 
use App\Helpers\Helper;
@endphp 

  @foreach ($profiledata as $profileinfo)

  <?php //dd($profileinfo);?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">      
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Forms</li>
        <li><i class="fa fa-angle-right"></i> Employee Profile</li>
      </ol>
    </div>
    <h4 class="text-black" style="margin-left:20px;">Employee Profile</h4>
    <div class="content">
      <div class="row">
        <div class="col-lg-4">
          <div class="user-profile-box m-b-3">
            <div class="box-profile text-white"> <img class="profile-user-img img-responsive img-circle m-b-2" src="dist/img/img1.jpg" alt="User profile picture">              
            </div>
          </div>
          <div class="info-box">
            <div class="box-body">               
              <strong><i class="fa fa-map-marker margin-r-5"></i> Present Address</strong>
              <p class="text-muted">Malibu, California</p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Permanent Address </strong>
              <p class="text-muted">alexanderpierce@gmail.com</p>
              <hr>
              <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
              <p>(123) 456-7890 </p>
              <hr>              
            </div>
            <!-- /.box-body --> 
          </div>
        </div>
        <div class="col-lg-8">
          <div class="info-box">
            <div class="card tab-style1"> 
              <!-- Nav tabs -->
              <ul class="nav nav-tabs profile-tab" role="tablist">                
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">Profile</a> </li>                
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">                
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel" aria-expanded="false">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Full Name</strong> <br>
                        <p class="text-muted">{{$profileinfo->fname.' '.$profileinfo->lname}}</p>
                      </div>
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Mobile</strong> <br>
                        <p class="text-muted">{{$profileinfo->contact}}</p>
                      </div>
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Email</strong> <br>
                        <p class="text-muted">{{$profileinfo->email}}</p>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Date of Birth</strong> <br>
                        <p class="text-muted">{{$profileinfo->dob}}</p>
                      </div>
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Date of Joining</strong> <br>
                        <p class="text-muted">{{$profileinfo->doj}}</p>
                      </div>
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Blood Group</strong> <br>
                        <p class="text-muted">{{$profileinfo->blood_group}}</p>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Department</strong> <br>
                        <p class="text-muted">
                          @php
                          $empdepartment = Helper::getDepartment($profileinfo->department);
                          @endphp
                         {{$empdepartment->department_name}}</p>
                      </div>
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Designation</strong> <br>
                        <p class="text-muted">
                          @php
                          $empdepartment = Helper::getDesignation($profileinfo->designation);
                          @endphp
                         {{$empdepartment->des_name}}</p>
                      </div>
                      <div class="col-lg-4 col-xs-6 b-r"> <strong>Gender</strong> <br>
                        @php 
                         if($profileinfo->gender=="M"){
                           $gender= 'Male';
                         }else{
                          $gender= 'Female';
                         }                         
                        @endphp
                        <p class="text-muted">{{$gender}}</p>
                      </div>
                    </div>
                    <hr>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Main row --> 
    </div>    
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
      
  @endforeach
  @endsection
  <script>
    setTimeout(function(){
      $("div.alert").remove();
  }, 2000 ); // 5 secs
  </script>