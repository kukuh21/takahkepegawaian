<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('dashboard') }}">{{ config('app.app_name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('dashboard') }}">{{ config('app.app_name') }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Menu</li>
        <li class="{{ setActive('home') }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="{{ setActive('folder')}} ? @yield('active-berkas')"><a class="nav-link" href="{{ route('folder.index') }}"><i class="fa fa-folder"></i> <span>Folder</span></a></li>
    </ul>
  </aside>
</div>