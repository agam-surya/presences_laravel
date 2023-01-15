@include('admin.partials.head')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
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
  @include('admin.partials.script')

</html>
