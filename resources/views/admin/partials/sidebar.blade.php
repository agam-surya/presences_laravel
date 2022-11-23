 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-category">Dashboard</li>
      <li class="nav-item {{ Request::is('dashboard') ? 'active': ''}}">
        <a class="nav-link" href="/dashboard">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Master Data</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="./#master-data" aria-expanded="false" >
          <i class="menu-icon mdi mdi-database "></i>
          <span class="menu-title">Master Data</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="master-data">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('dosen*') ? 'active': ''}}" href="/dosen">Data Dosen</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('pegawai*') ? 'active': ''}}" href="/pegawai">Data Pegawai</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('attendance*') ? 'active': ''}}" href="/attendance">Data Jadwal Absensi</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('holidays') ? 'active': ''}}" href="/holidays">Data libur</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('jabatan') ? 'active': ''}}" href="/jabatan">Data Jabatan</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Permission</li>
      <li class="nav-item {{ Request::is('permission') ? 'active': ''}}">
        <a class="nav-link" href="/permission">
          <i class="mdi mdi-bookmark  menu-icon"></i>
          <span class="menu-title">Data Izin</span>
        </a>
      </li>
      <li class="nav-item nav-category">Presence</li>
      <li class="nav-item {{ Request::is('Presence') ? 'active': ''}}">
        <a class="nav-link" href="/Presence">
          <i class=" mdi mdi-clock   menu-icon"></i>
          <span class="menu-title">Data Kehadiran</span>
        </a>
      </li>    
      <li class="nav-item nav-category">Profile</li>
      <li class="nav-item">
        <button class="nav-link dropdown-item" data-bs-toggle="modal" data-bs-target="#myprofile">
          <i class="menu-icon mdi mdi-account"></i> <span class="menu-title"> My Profile</span></button>
      </li>
      <li class="nav-item nav-category">logout</li>
      <li class="nav-item">
        <form action="/logout" method="post">
          @csrf            
          <button type='submit' class="nav-link dropdown-item">
            <i class="menu-icon mdi mdi-power "></i> 
            <span class="menu-title">Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </nav>