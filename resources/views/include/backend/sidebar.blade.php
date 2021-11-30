<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <div class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
        <div class="image text-center"><img src="{{ asset('public/assets/img/img1.jpg')}}" class="img-circle" alt="User Image"> </div>
        <div class="info">
           <p>Alexander Pierce</p>
           <a href="#"><i class="fa fa-cog"></i></a> <a href="#"><i class="fa fa-envelope-o"></i></a> <a href="#"><i class="fa fa-power-off"></i></a> 
        </div>
     </div>
     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">        
        <li class="active treeview">
           <a href="{{ route('admin.dashboard') }}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </span> </a>
        </li>
         @php $user = auth()->user(); @endphp
          @if($user->role == 1)
          <li class="treeview">
            <a href="#"> <i class="fa fa-bullseye"></i> <span>Organization</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
            <ul class="treeview-menu">
               <li><a href="{{ route('department.index') }}">DepartMent</a></li>
               <li><a href="{{ route('designation.index') }}">Designation</a></li>
            </ul>
         </li>
         <li class="treeview">
            <a href="#"> <i class="fa fa-bullseye"></i> <span>Employee</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
            <ul class="treeview-menu">
               <li><a href="{{ route('pages.employeeList') }}">All Employee</a></li>
            </ul>
         </li>         
        @endif
     </ul>
  </div>
  <!-- /.sidebar --> 
</aside>