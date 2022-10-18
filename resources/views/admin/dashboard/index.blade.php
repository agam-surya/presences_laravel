@extends('admin.main')
@section('container')
 
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-12">
          <img class="img-md rounded-circle" width="100px" src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->image }}">
        </div>
      {{-- </div> --}}
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
  </div>
@endsection