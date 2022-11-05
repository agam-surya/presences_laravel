@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Table dosen</h4>
      <div class="table-responsive pt-3">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                 Nama
              </th>
              <th>izin
              </th>
              <th>keterangan
              </th>
              <th>tanggal izin
              </th>
              <th>file
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($permissions as $permission)
            <tr class="table-info">
              <td>
                {{ $loop->iteration }}
              </td>
              <td>
                {{ $permission->user->name }}
              </td>
              <td>
                {{ $permission->permissionType->name }}
              </td>
              <td>
                {{ $permission->desciption }}
              </td>
              <td>
                {{ $permission->tanggal_sart_izin }} sampai {{ $permission->tanggal_end_izin }}
              </td>
              <td>
                <a href="{{ asset('storage/'. $permission->file) }}"><button class="btn-success btn">Download</button></a>
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