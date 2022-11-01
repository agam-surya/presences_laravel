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
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Master Data</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="master-data">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('dosen*') ? 'active': ''}}" href="/dosen">Data Dosen</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('pegawai*') ? 'active': ''}}" href="/pegawai">Data Pegawai</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('attendance*') ? 'active': ''}}" href="/attendance">Data Jadwal Absensi</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('jabatan') ? 'active': ''}}" href="/jabatan">Data Jabatan</a></li>
          </ul>
        </div>
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