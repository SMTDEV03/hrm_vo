<header class="main-header">

   @php 
    $info = auth()->user();
        $logingUserID = $info->id;
        $userinfo = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.*', 'profiles.*')
     
        ->where('users.id', '=', $logingUserID)
        ->where('users.is_deleted', '=', 0)
        ->get();
   @endphp
   @foreach ($userinfo as $loginuser)
 
    <!-- Logo --> 
    <a href="index.html" class="logo blue-bg">
       <!-- mini logo for sidebar mini 50x50 pixels --> 
       <span class="logo-mini"><img src="{{ asset('public/assets/img/logo-n.png')}}" alt=""></span> 
       <!-- logo for regular state and mobile devices --> 
       <span class="logo-lg"><img src="{{ asset('public/assets/img/logo.png')}}" alt=""></span> 
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar blue-bg navbar-static-top">
       <!-- Sidebar toggle button-->
       <ul class="nav navbar-nav pull-left">
          <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
       </ul>
       <div class="pull-left search-box">
          <form action="#" method="get" class="search-form">
             <div class="input-group">
                <input name="search" class="form-control" placeholder="Search..." type="text">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
                </span>
             </div>
          </form>
          <!-- search form --> 
       </div>
       <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
             <!-- Messages: style can be found in dropdown.less-->
             <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   <i class="fa fa-envelope-o"></i>
                   <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu">
                   <li class="header">You have 4 new messages</li>
                   <li>
                      <ul class="menu">
                         <li>
                            <a href="#">
                               <div class="pull-left"><img src="{{ asset('public/assets/img/img1.jpg')}}" class="img-circle" alt="User Image"> <span class="profile-status online pull-right"></span></div>
                               <h4>Alex C. Patton</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">9:30 AM</span></p>
                            </a>
                         </li>
                         <li>
                            <a href="#">
                               <div class="pull-left"><img src="{{ asset('public/assets/img/img3.jpg')}}" class="img-circle" alt="User Image"> <span class="profile-status offline pull-right"></span></div>
                               <h4>Nikolaj S. Henriksen</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">10:15 AM</span></p>
                            </a>
                         </li>
                         <li>
                            <a href="#">
                               <div class="pull-left"><img src="{{ asset('public/assets/img/img2.jpg')}}" class="img-circle" alt="User Image"> <span class="profile-status away pull-right"></span></div>
                               <h4>Kasper S. Jessen</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">8:45 AM</span></p>
                            </a>
                         </li>
                         <li>
                            <a href="#">
                               <div class="pull-left"><img src="{{ asset('public/assets/img/img4.jpg')}}" class="img-circle" alt="User Image"> <span class="profile-status busy pull-right"></span></div>
                               <h4>Florence S. Kasper</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">12:15 AM</span></p>
                            </a>
                         </li>
                      </ul>
                   </li>
                   <li class="footer"><a href="#">View All Messages</a></li>
                </ul>
             </li>
             <!-- Notifications: style can be found in dropdown.less -->
             <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   <i class="fa fa-bell-o"></i>
                   <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu">
                   <li class="header">Notifications</li>
                   <li>
                      <ul class="menu">
                         <li>
                            <a href="#">
                               <div class="pull-left icon-circle red"><i class="icon-lightbulb"></i></div>
                               <h4>Alex C. Patton</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">9:30 AM</span></p>
                            </a>
                         </li>
                         <li>
                            <a href="#">
                               <div class="pull-left icon-circle blue"><i class="fa fa-coffee"></i></div>
                               <h4>Nikolaj S. Henriksen</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">1:30 AM</span></p>
                            </a>
                         </li>
                         <li>
                            <a href="#">
                               <div class="pull-left icon-circle green"><i class="fa fa-paperclip"></i></div>
                               <h4>Kasper S. Jessen</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">9:30 AM</span></p>
                            </a>
                         </li>
                         <li>
                            <a href="#">
                               <div class="pull-left icon-circle yellow"><i class="fa  fa-plane"></i></div>
                               <h4>Florence S. Kasper</h4>
                               <p>I've finished it! See you so...</p>
                               <p><span class="time">11:10 AM</span></p>
                            </a>
                         </li>
                      </ul>
                   </li>
                   <li class="footer"><a href="#">Check all Notifications</a></li>
                </ul>
             </li>
             <!-- User Account: style can be found in dropdown.less -->
             <li class="dropdown user user-menu p-ph-res">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('public/assets/img/img1.jpg')}}" class="user-image" alt="User Image"> <span class="hidden-xs">{{ ucwords($loginuser->fname.' '.$loginuser->lname) }}</span> </a>
                <ul class="dropdown-menu">
                   <li class="user-header">
                      <div class="pull-left user-img"><img src="{{ asset('public/assets/img/img1.jpg')}}" class="img-responsive" alt="User"></div>
                      <p class="text-left">{{ ucwords($loginuser->fname .' '.$loginuser->lname) }} <small>{{ $loginuser->email }}</small> </p>                     
                   </li>
                   <li><a href="{{ route('pages.profile')}}"><i class="icon-profile-male"></i> My Profile</a></li>                   
                   <li role="separator" class="divider"></li>
                   <li><a href="{{ route('auth.logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
             </li>
          </ul>
       </div>
    </nav>
    @endforeach
 </header>