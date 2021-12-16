@extends('layout.master')
@section('title', 'Home')
@section('content')


<div class="content-wrapper"> 
     @foreach($users as $userinfo)
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black"> {{ $userinfo->fname.' '.$userinfo->lname}}</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Pages</li>
        <li><i class="fa fa-angle-right"></i> Profile Page</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="row">
        <div class="col-lg-4">
          <div class="user-profile-box m-b-3">
            <div class="box-profile text-white"> <img class="profile-user-img img-responsive img-circle m-b-2" src="dist/img/img1.jpg" alt="User profile picture">
              <h3 class="profile-username text-center">Alexander Pierce</h3>
              <p class="text-center">&copy; alexanderpierce</p>
              <p class="text-center">Praesent libero. Sed cursus ante dapi bus diam. Sed nisi nulla quis sem at nibh elementum imperdiet. Duis sagi diam ipsum resent.</p>
            </div>
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
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>Full Name:</strong> <br>
                          <p class="text-muted"> {{ $userinfo->fname.' '.$userinfo->lname}}</p>
                        </div>
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>Email:</strong><br>
                          <p class="text-muted">{{$userinfo->email}}</p>
                        </div>
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>Contact:</strong><br>
                          <p class="text-muted">{{$userinfo->contact}}</p>
                        </div>
                      </div>  
                      <div class="row">
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>DOB</strong> <br>
                          <p class="text-muted">{{$userinfo->dob}}</p>
                        </div>
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>DOJ</strong> <br>
                          <p class="text-muted">{{$userinfo->doj}}</p>
                        </div>
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>Blood Group</strong> <br>
                          <p class="text-muted">{{$userinfo->blood_group}}</p>
                        </div>
                      </div>   
                      <div class="row">                                                                                         
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>Department</strong> <br>
                          <p class="text-muted">{{$allDepart->department_name}}</p>
                        </div>
                        <div class="col-lg-4 col-xs-6 b-r"> <strong>Designation</strong> <br>
                          <p  class="text-muted">{{$allDesignation->des_name}}                                                                                          </p>
                        </div>                    
                      </div>                       
                  </div>
                  @endforeach
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
@endsection