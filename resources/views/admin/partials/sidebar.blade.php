<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
      <li class="nav-item nav-category">Dashboard</li>
      <li class="nav-item {{ Request::is('dashboard') ? 'active': ''}}">
          <a class="nav-link" href="/dashboard">
              <i class="bi bi-house menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
      <li class="nav-item nav-category">Master Data</li>
      <li class="nav-item">
          <a
              class="nav-link"
              data-bs-toggle="collapse"
              href="./#master-data"
              aria-expanded="false"
          >
              <i class="menu-icon bi bi-database"></i>
              <span class="menu-title">Master Data</span>
          </a>
          <div class="collapse" id="master-data">
              <ul class="nav flex-column sub-menu">
                  {{-- menampilkan data yang sudah di tambahkan di position
                  --}} 
                  @foreach ($position as $pos)
                  <li class="nav-item">
                      <a
                          class="nav-link {{ Request::is('staff/'.$pos->posisi ) ? 'active': ''}}"
                          href="/jabatan/{{ $pos->posisi}}"
                          >Data {{$pos->posisi}}</a
                      >
                  </li>
                  @endforeach
                  <li class="nav-item">
                      <a
                          class="nav-link {{ Request::is('attendance*') ? 'active': ''}}"
                          href="/attendance"
                          >Data Jadwal Absensi</a
                      >
                  </li>
                  <li class="nav-item">
                      <a
                          class="nav-link {{ Request::is('holidays') ? 'active': ''}}"
                          href="/holidays"
                          >Data libur</a
                      >
                  </li>
                  <li class="nav-item">
                      <a
                          class="nav-link {{ Request::is('jabatan') ? 'active': ''}}"
                          href="/jabatan"
                          >Data Jabatan</a
                      >
                  </li>
              </ul>
          </div>
      </li>

      <li class="nav-item nav-category">Halaman</li>
      <li class="nav-item {{ Request::is('Presence') ? 'active': ''}}">
          <a class="nav-link" href="/Presence">
              <i class="bi bi-clock menu-icon"></i>
              <span class="menu-title">Laporan Kehadiran</span>
          </a>
      </li>
      <li class="nav-item {{ Request::is('permission') ? 'active': ''}}">
          <a class="nav-link" href="/permission"
              ><i class="bi bi-file-earmark-text menu-icon"></i
              ><span class="menu-title">Data Izin User</span></a
          >
      </li>

      <li class="nav-item {{ Request::is('lokasi') ? 'active': ''}}">
          <a class="nav-link" href="/lokasi">
              <i class="bi bi-geo menu-icon"></i>
              <span class="menu-title">Lokasi Absensi</span>
          </a>
      </li>
      <li class="nav-item nav-category">Profile</li>
      <li class="nav-item">
          <button
              class="nav-link dropdown-item"
              data-bs-toggle="modal"
              data-bs-target="#myprofile"
          >
              <i class="menu-icon bi bi-person"></i>
              <span class="menu-title"> My Profile</span>
          </button>
      </li>
      <li class="nav-item">
          <form action="/logout" method="post">
              @csrf
              <button type="submit" class="nav-link dropdown-item">
                  <i class="menu-icon bi bi-power"></i>
                  <span class="menu-title">Logout</span>
              </button>
          </form>
      </li>
  </ul>
</nav>
