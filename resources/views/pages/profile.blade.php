@extends('layout.master')
@section('title', 'Home')
@section('content') 

  @foreach ($profiledata as $profileinfo)

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">      
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Forms</li>
        <li><i class="fa fa-angle-right"></i> User Profile</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="info-box">
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
        <h4 class="text-black">User Profile</h4>
        <form action="{{ route('profileUpdate') }}" method="post">
          @csrf
        <div class="row">
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>First Name</label>
              <input class="form-control" name="fname" value="{{$profileinfo->fname}}" id="fname" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Last Name</label>              
              <input class="form-control" name="lname" value="{{$profileinfo->lname}}" id="lname" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Email Address</label>
              <input class="form-control" name="email" value="{{$profileinfo->email}}" id="email" type="email">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Date of Birth</label>
              <input class="form-control" id="dob" value="{{$profileinfo->dob}}" name="dob" type="date">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Gender :</label>
              <select name="gender" id="gender" class="form-control">
                <option value="M">Male</option>
                <option value="F">Female</option>                
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Date of Joining</label>
              <input class="form-control" name="doj" value="{{ $profileinfo->doj }}" id="doj" type="date">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Contact No</label>
              <input class="form-control" name="contact" value="{{$profileinfo->contact}}" id="basicInput" type="text">
            </fieldset>
          </div>         
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Department</label>
              <select name="department" id="department" class="form-control">
                @foreach ($allDepart as $allDepart)                 
                <option value='{{$allDepart->id }}' @if ($profileinfo->department == $allDepart->id) {{ 'selected' }}@endif>{{ $allDepart->department_name }}</option>                
                @endforeach
              </select>
            </fieldset> 
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Designation</label>
              <select name="designation" id="designation" class="form-control">
                @foreach ($allDesignation as $allDesignation)                 
                <option value='{{$allDesignation->id }}' @if ($profileinfo->designation == $allDesignation->id) {{ 'selected' }}@endif>{{ $allDesignation->des_name }}</option>                
                @endforeach
              </select>              
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Blood Group</label>
              <select name="blood_group" id="blood_group" class="form-control">
                <option value="O+" @if ($profileinfo->blood_group == "O+") {{ 'selected' }} @endif>O+</option>
                <option value="O-" @if ($profileinfo->blood_group == "O-") {{ 'selected' }} @endif>O-</option>  
                <option value="A+" @if ($profileinfo->blood_group == "A+") {{ 'selected' }} @endif>A+</option>  
                <option value="A-" @if ($profileinfo->blood_group == "A-") {{ 'selected' }} @endif>A-</option>  
                <option value="B+" @if ($profileinfo->blood_group == "B+") {{ 'selected' }} @endif>B+</option>  
                <option value="B-" @if ($profileinfo->blood_group == "B-") {{ 'selected' }} @endif>B-</option>              
                <option value="AB+" @if ($profileinfo->blood_group == "AB+") {{ 'selected' }} @endif>AB+</option>                 
              </select> 
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group" style="margin-top:30px;"> 
                <input class="form-control" name="user_id" value="{{$profileinfo->user_id}}"  type="hidden">        
                <button type="submit" class="btn btn-primary">Update</button>     
            </fieldset>
          </div>
        </div>
        </form>       
        <hr class="m-t-3 m-b-3">       
      </div>
      <!-- Main row --> 
    </div>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
      
  @endforeach
  @endsection