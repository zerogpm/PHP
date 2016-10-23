  <aside class="main-sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ Gravatar::get(\Auth::user()->email, ['size' => 160]) }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ \Auth::user()->name }}</p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ url()->current() == url('dashboard') ? 'active' : '' }}">
          <a href="{{ url('/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @if(\Auth::user()->hasRole('admin'))
        <li class="treeview{{ isset($menu) == 2 ? ' active' : '' }}">
          <a href="#">
            <i class="fa fa-list-ol"></i> <span>Booking Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/dashboard/booking/create')}}"><i class="fa fa-circle-o"></i> Make New Booking</a></li>
            <li><a href="{{ url('/dashboard/booking')}}"><i class="fa fa-circle-o"></i> View All Record</a></li>
          </ul>
        </li>
        <li class="{{ \Request::segment(2) == 'rooms' ? 'active' : '' }}">
          <a href="{{ url('/dashboard/rooms')}}">
            <i class="fa fa-bed"></i> <span>Room Management</span>
          </a>
        </li>
        <li class="{{ \Request::segment(2) == 'users' ? 'active' : '' }}">
          <a href="{{ url('/dashboard/users')}}">
            <i class="fa fa-users"></i> <span>User Management</span>
          </a>
        </li>
        @else
        <li class="{{ url()->current() == url('/dashboard/booking') ? 'active' : '' }}">
          <a href="{{ url('/dashboard/booking')}}">
            <i class="fa fa-list-ol"></i> <span>My Booking</span>
          </a>
        </li>
        <li class="{{ url()->current() == url('/dashboard/rooms') ? 'active' : '' }}">
          <a href="{{ url('/dashboard/rooms')}}">
            <i class="fa fa-bed"></i> <span>Room Management</span>
          </a>
        </li>
        @endif
        <li class="header">User Settings</li>
        @if(\Auth::user()->hasRole('admin'))
        <li><a href="#"><i class="fa fa-gears text-yellow"></i> <span>Site Settings</span></a></li>
        @endif
        <li class="{{ url()->current() == url('/dashboard/change-password') ? 'active' : '' }}">
          <a href="{{ url('/dashboard/change-password')}}"><i class="fa fa-lock text-red"></i> <span>Change My Password</span></a></li>        
        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out text-aqua"></i> <span>Log Out</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>