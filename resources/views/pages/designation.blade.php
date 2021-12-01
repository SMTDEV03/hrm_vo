@extends('layout.master')
@section('title', 'Home')
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Designation</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Apps</li>
        <li><i class="fa fa-angle-right"></i> Designation</li>
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
              <h5 class="text-white m-b-0">Add Designation</h5>
            </div>
            <div class="card-body">
              {{-- @csrf --}}
              <form name="dptform" id="dptform" method="post">
                @csrf

                <span id="err_msg"></span>
                <span id="success-msg"></span>
                <div class="form-group">                
                  <label for="exampleInputEmail1">Add Designation</label>
                  <input type="text" class="form-control" name="designation_name" id="designation_name">
                </div>
              <button type="submit" class="btn btn-info" name="submit" value="submit" id="add_depart">Add</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          @if(Session::get('success'))   
          <div class="alert alert-info" role="alert">   
          {{ Session::get('success' )}}  
          </div>
          @endif 
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
                  @foreach ( $allDesignation as $Desginfo ) 
                  <tr>
                    <td>{{$sr}}</td>
                    <td>{{ $Desginfo->des_name }}</td>
                    <td>              
                      <a class="btn btn-primary" href="{{route('designation.edit',$Desginfo->id) }}">Edit</a>
                      <form method="post" action="{{route('designation.destroy',$Desginfo->id) }}" style="
                        display: inline;">@csrf @method('delete')<button class="btn btn-primary" type="submit">Delete</button>
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
        var dsgName = $('#designation_name').val();       
        if(dsgName==''){
            $('#err_msg').text('Please Enter Designation');
            return false;
        }
        $.ajax({            
            type: 'POST',
            url: "{{ route('designation.store') }}",
            data: { desgnation_name:dsgName },
            success: function(response) {
              if(response==='success') {
                $('#success-msg').text('Designation Added Succesfully');
                setTimeout(function () { 
                  $('#success-msg').text('');
                  location.reload();
                }, 1000);
              }else if(response==='Already'){
                  $('#success-msg').text('Designation already exist ! Please Try Another');
                  setTimeout(function () { 
                    $('#success-msg').text('');
                    location.reload();
                  }, 2000);
              }
                //alert(data);
                //return false;                
            },            
        });
        return false;       
    });
  })
  setTimeout(function(){
      $("div.alert").remove();
  }, 2000 ); // 5 secs
</script>
@endsection