@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold fs-4">Tabel Jabatan</h4>
      <div class="table-responsive pt-3">
        <table class="table table-bordered table-striped" id="id_table">
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
            @foreach ($position as $posisi)
            <tr>
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
                <a class="btn btn-success border-0  text-decoration-none "
                  href="/{{ $posisi->posisi }}">
                  <i class="bi bi-eye"></i></a>
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