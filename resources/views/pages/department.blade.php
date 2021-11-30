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
              <h5 class="text-white m-b-0">Add Department</h5>
            </div>
            <div class="card-body">
              {{-- @csrf --}}
              <form name="dptform" id="dptform" method="post">
                @csrf

                <span id="err_msg"></span>
                <span id="success-msg"></span>
                <div class="form-group">                
                  <label for="exampleInputEmail1">Add Department</label>
                  <input type="text" class="form-control" name="department_name" id="depart_name">
                </div>
              <button type="submit" class="btn btn-info" name="submit" value="submit" id="add_depart">Add</button>
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
<script>
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
});

  $(document).ready(function(){
    $('#add_depart').click(function(){          
        var depatname = $('#depart_name').val();       
        if(depatname==''){
            $('#err_msg').text('Please Enter Department Name');
            return false;
        }

        console.log(depatname);

        $.ajax({            
            type: 'POST',
            url: "{{ route('department.store') }}",
            data: { dpt:depatname },
            success: function(response) {
              if(response==='success') {
                $('#success-msg').text('Department Added Succesfully');
                setTimeout(function () { 
                  $('#success-msg').text('');
                  location.reload();
                }, 3000);
              }else if(response==='Already'){
                  $('#success-msg').text('Department already exist ! Please Try Another');
                  setTimeout(function () { 
                    $('#success-msg').text('');
                    location.reload();
                  }, 3000);
              }
                //alert(data);
                //return false;                
            },            
        });
        return false;       
    });
  })
</script>
@endsection