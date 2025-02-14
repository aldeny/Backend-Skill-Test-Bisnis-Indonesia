<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-ticket-alt"></i>
    </div>
    <div class="sidebar-brand-text mx-3">ticket-app</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item {{ request()->routeIs('event*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('event') }}">
      <i class="fas fa-fw fa-calendar-day"></i>
      <span>Event</span></a>
  </li>

  <li class="nav-item {{ request()->routeIs('ticket*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('ticket') }}">
      <i class="fas fa-fw fa-ticket-alt"></i>
      <span>Tiket</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
