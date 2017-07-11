<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="{{ url('home') }}"><span class="highlight">{{ config('app.name') }}</span></a>
    <button type="button" class="sidebar-toggle">
    <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a href="{{ URL::route('home') }}">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>
    </ul>
  </div>
</aside>