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
                <img class="img-xs rounded-circle" width="40px" src="{{ asset('../../storage/' . auth()->user()->image) }} "
                    alt="logo" />
                {{-- <div class="fs-100">P</div> --}}
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Selamat Datang, <span
                        class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
                <h3 class="welcome-sub-text">You can do it </h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            {{-- belum selesai --}}
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>
            {{-- belum selesai --}}
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="icon-mail icon-lg"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                    aria-labelledby="notificationDropdown">
                    <a class="dropdown-item py-3 border-bottom">
                        <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-alert m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                            <p class="fw-light small-text mb-0"> Just now </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-settings m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                            <p class="fw-light small-text mb-0"> Private message </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-airballoon m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                            <p class="fw-light small-text mb-0"> 2 days ago </p>
                        </div>
                    </a>
                </div>
            </li>
            {{-- belum selesai --}}
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="icon-bell"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                    aria-labelledby="countDropdown">
                    <a class="dropdown-item py-3">
                        <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                            <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                            <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                            <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">

                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    @if (file_exists('storage/' . auth()->user()->image))
                        <img class="img-xs rounded-circle" width="20px"
                            src="{{ asset('../../storage/' . auth()->user()->image) }}"
                            alt="{{ auth()->user()->image }}">
                    @else
                        <img class="img-xs rounded-circle" width="20px" src="../../person/person.jpg"
                            alt="{{ auth()->user()->image }}">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        @if (file_exists('storage/' . auth()->user()->image))
                            <img class="img-xs rounded-circle" width="40px"
                                src="{{ asset('../../storage/' . auth()->user()->image) }}" alt="..">
                        @else
                            <img class="img-xs rounded-circle" width="40px" src="../../person/person.jpg"
                                alt="image">
                        @endif
                        <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                        <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myprofile"><i
                            class="dropdown-item-icon bi bi-person text-primary me-2"></i> My Profile</button>
                    <form action="/logout" method="post">
                        @csrf
                        <button type='submit' class="dropdown-item"><i
                                class="dropdown-item-icon bi bi-power text-primary me-2"></i> Logo Out</button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="myprofile" tabindex="-1" aria-labelledby="myprofileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="myprofileLabel">My Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/myprofile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal-body">

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="staticEmail" value="{{ auth()->user()->name }}"
                                name='name'>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="staticEmail" value="{{ auth()->user()->email }}"
                                name="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">new password</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="staticEmail" name="password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="staticEmail" value="{{ auth()->user()->phone }}"
                                name="phone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="staticEmail"
                                value="{{ auth()->user()->address }}" name="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-4">Jabatan</label>
                        <select class="col-sm" name="position_id">
                            @foreach ($position as $posisi)
                                @if (old('position_id') != $posisi->id)
                                    <option value={{ $posisi->id }} selected>{{ $posisi->posisi }}</option>
                                @else
                                    <option value={{ $posisi->id }}>{{ $posisi->posisi }}</option>
                                @endif
                            @endforeach
                        </select>
                        {{-- </div> --}}
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                value="{{ auth()->user()->role->name }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="image" class="col-sm-4 col-form-label">Gambar</label>
                        <div class="col-sm-8">
                            <img class="rounded mb-3" style="background-size: cover; width:100px; height:100px"
                                src="{{ asset('../../storage/' . auth()->user()->image) }}" alt="image"
                                id="imageOutput">
                            <input class="form-control-sm form-control" type="file" id="image" name="image"
                                value="{{ auth()->user()->image }}" onchange="loadfile(event)">
                        </div>
                        <script>
                            var loadfile = function(e) {
                                var loadfile = document.getElementById('imageOutput')
                                imageOutput.src = URL.createObjectURL(event.target.files[0])
                            }
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
