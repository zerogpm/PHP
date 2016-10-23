  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>BS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Laravel</b> RBS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              @if ($notification_new_users->count() > 0)
              <span class="label label-warning">{{ $notification_new_users->count() }}</span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ $notification_new_users->count() }} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a>
                      <i class="fa fa-users text-aqua"></i> {{ $notification_new_users->count() }} new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="{{ url('/dashboard/users') }}">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ Gravatar::get(\Auth::user()->email, ['size' => 160]) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucwords(\Auth::user()->name) }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ Gravatar::get(\Auth::user()->email, ['size' => 160]) }}" class="img-circle" alt="User Image">

                <p>
                  {{ ucwords(\Auth::user()->name) }}
                  <small>{{ \Auth::user()->email }}</small>
                  <small>Member since {{ \Auth::user()->created_at->format('d M Y') }}</small>
                </p>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>