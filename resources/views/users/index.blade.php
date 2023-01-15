@include('admin.partials.head')

<body>
  <div class="container-scroller">
    <div class=" page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-1">
          <div class="col-lg-4 mx-auto">
              <form class="pt-3" action="/logout" method="POST">
                @csrf
                <div class="mt-3">
                <h4 class="mb-4">Anda Tidak Punya Akses di web Ini </h4>
                <h6 class="mb-4 fw-light">mohon Logout di Sitstem Web Ini</h6>
                  <button type="submit" class="w-100 btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Logout</button>
                </div>
              </form>
            </div>
          </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  @include('admin.partials.script')
</body>

</html>
