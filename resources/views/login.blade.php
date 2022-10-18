@include('admin.partials.head')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>  
            @endif
            @if (session()->has('loginFail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{session('loginFail')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>  
            @endif
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              
              <h4>Presensi Login </h4>
              <h6 class="fw-light">Login to continue.</h6>
              <form method="post" actions="/login" class="pt-3">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                </div>
                
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="doc/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="doc/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="doc/template/js/off-canvas.js"></script>
  <script src="doc/template/js/hoverable-collapse.js"></script>
  <script src="doc/template/js/template.js"></script>
  <script src="doc/template/js/settings.js"></script>
  <script src="doc/template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
