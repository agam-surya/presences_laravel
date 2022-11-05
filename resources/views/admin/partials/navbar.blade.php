<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="dashboard">
          <div class="fs-100">Hi Admin</div>
          {{-- <img src="doc/template/images/logo.svg" alt="logo" /> --}}
        </a>
        <a class="navbar-brand brand-logo-mini" href="dashboard">
          <img class="img-xs rounded-circle" width="40px" src="{{ asset('storage/'.$user->image) }}" alt="logo" />
          {{-- <div class="fs-100">P</div> --}}
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top"> 
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
          <h3 class="welcome-sub-text">Tetaplah bernafas untuk hari ini ya :) </h3>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="doc/template/#" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" width="20px" src="storage/{{ $user->image }}" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-xs rounded-circle" width="40px" src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->image }}">
              <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
              <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
            </div>
            <a class="dropdown-item " href="/myprofile"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
            <form action="/logout" method="post">
              @csrf            
              <button type='submit' class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> Logo Out</button>
            </form>  
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>