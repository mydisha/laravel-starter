  <nav class="navbar navbar-default" id="navbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <ul class="nav navbar-nav navbar-mobile">
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        <li class="logo">
          <a class="navbar-brand" href="{{ url('home') }}"><span class="highlight">{{ config('app.name') }}</span> </a>
        </li>
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="{{ asset('assets/admin/images/avatar') . '/' . 'noimg.png' }}">
          </button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="navbar-title">@yield('title')</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown profile">
          <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="{{ asset('assets/admin/images/avatar') . '/' . 'noimg.png' }}">
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username">{{ Auth::user()->name }}</h4>
            </div>
            <ul class="action">
              <li>
                <a href="{{ url('logout') }}">
                  Logout
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>