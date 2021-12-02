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