@extends('layout.master')
@section('title', 'Home')
@section('content') 



     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Contact</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Contact</li>
      </ol>
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
                    @php 
                    $sr = 1;                      
                    @endphp
                    @foreach ( $users as $userinfo )
                  
                    <tr>
                      <td>{{$sr}}</td>
                      <td><a href="#">{{ $userinfo->fname .' '. $userinfo->lname}}</a></td>
                      <td>{{ $userinfo->email }}</td>
                      <td>+91-123456789</td>
                      <td>Designer</td>
                      <td>10-June-2021</td>                     
                      <td><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Delete"> <i class="ti-close" aria-hidden="true"></i> </button></td>
                      <td><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Delete"> <i class="ti-close" aria-hidden="true"></i> </button></td>
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