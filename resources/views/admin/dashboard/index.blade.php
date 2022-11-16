@extends('admin.main')
@section('container')
    <div class="content-wrapper">
        @if (session()->has('success'))
  <div class="alert-dismissible fade show alert alert-success" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @elseif(session()->has('error'))
  <div class="alert-dismissible fade show alert alert-danger" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
        <div class="row">
            <div class="col-md-6  grid-margin stretch-card">
                <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Jumlah Posisi</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="status-summary-ight-white mb-1">saat ini</p>
                                <h2 class="text-white">{{ $PositionCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6  grid-margin stretch-card">
                <div class="card bg-success card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Jumlah User</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="status-summary-ight-white mb-1">saat ini</p>
                                <h2 class="text-info">{{ $UserCount }}</h2>
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
    </div>
@endsection
