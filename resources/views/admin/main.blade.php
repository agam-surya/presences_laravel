@include('admin.partials.head')
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
   @include('admin.partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.partials.sidebar')
      <!-- partial -->
      {{-- <div class="main"></div> --}}
      <div class="main-panel">
        @yield('container')
        <!-- main-panel ends -->
        @include('admin.partials.footer')
      </div>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
    @include('admin.partials.script')
  <!-- End custom js for this page-->
</body>

</html>
