@extends('layout.master')
@section('title', 'Home')
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Department</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Department</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <!-- /.col -->
        <div class="col-lg-6">
          <div class="card card-outline">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Edit Department</h5>
            </div>
            <div class="card-body">              
              <form name="dptform" id="dptform" method="post" action="{{ route('department.update',$deptname->id)}}">
                @csrf
                @method('PUT')
                <span id="err_msg"></span>
                <span id="success-msg"></span>
                <div class="form-group">                
                  <label for="exampleInputEmail1">Edit Department</label>
                  <input type="text" class="form-control" name="department_name" id="depart_name" value="{{trim($deptname->department_name)}}">
                  <input type="hidden" name="dept_id" value="{{trim($deptname->id)}}">
                </div>
                <button type="submit" class="btn btn-info" name="submit" value="submit" id="add_depart">Update</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="table-responsive">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Department Name</th>
                  <th scope="col">Action</th>                  
                </tr>
              </thead>
              <tbody>
                @php 
                  $sr = 1;                      
                  @endphp
                  @foreach ( $allDepart as $Departinfo ) 
                  <tr>
                    <td>{{$sr}}</td>
                    <td>{{ $Departinfo->department_name }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{route('department.edit',$Departinfo->id) }}">Edit</a>
                      <!--<a href="#" class="text-center" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      <a href="#" class="text-center" title="Delete" style="margin-left:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>--> 
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
<style>
.table td, .table th {
    padding: 5px !important;
  }
</style>
@section('extra-js')
@endsection