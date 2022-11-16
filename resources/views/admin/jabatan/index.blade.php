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
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tabel Jabatan</h4>
      {{-- .btn-outline-{color} --}}
      
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