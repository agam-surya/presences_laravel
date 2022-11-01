@extends('admin.main')
@section('container')
<div class="content-wrapper">
  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
  @endif
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Table dosen</h4>
      {{-- .btn-outline-{color} --}}
      <div class="col-md-6">
        <a href="/dosen/create" class="btn btn-outline-info">tambah data</a>
      </div>
      <div class="table-responsive pt-3">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                Posisi
              </th>
              <th>Jumlah
              </th>
              <th>Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($positions as $posisi)
            <tr class="table-info">
              <td>
                {{ $loop->iteration }}
              </td>
              <td>
                {{ $posisi->posisi }}
              </td>
              <td>
                {{  $usercount->where('position_id', $posisi->id)->count() }}
              </td>
              <td>
                <a class="badge bg-primary border-0  text-decoration-none "
                  href="/{{ $posisi->posisi }}/create">
                  tambah</a>
                <a class="badge bg-success border-0  text-decoration-none "
                  href="/{{ $posisi->posisi }}">
                  lihat</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection