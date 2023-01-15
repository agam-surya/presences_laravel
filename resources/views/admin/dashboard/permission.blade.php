@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold fs-4">Tabel Izin Users</h4>
      <div class="table-responsive pt-3">
        <table class="table table-bordered" id="id_table">
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
              <th>
                Status
              </th>
              <th>file
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($permissions as $permission)
            <tr>
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
                {{ $permission->description }}
              </td>
              <td>
                {{ $permission->tanggal_start_izin }} sampai {{ $permission->tanggal_end_izin }}
              </td>
                @if ($permission->aksi == null)    
              <td>
                <a href="#{{$permission->id}}" class="btn btn-warning" data-bs-target="#status-{{$permission->id}}" data-bs-toggle="modal">menunggu</a>
              </td>
              @elseif ($permission->aksi == 'accept')
              <td>
                <div class="btn btn-success">Diterima</div>
              </td>
              @else
              <td>
                <div class="btn btn-danger">Ditolak</div>
              </td>
              @endif

              @if ($permission->file == null)
                <td>
                   ---
                </td>
              @else   
              <td>
                <a href="{{ asset('storage/'. $permission->file) }}"><button class="btn-success btn">Download</button></a>
              </td>
              @endif
            </tr>

            {{-- modal status --}}
            <div class="modal fade" id='status-{{ $permission->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDosenLabel">Status Permission</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                    <div class="modal-body">
                      <form action='/permission/{{ $permission->id }}' method="post">
                        @method('patch')
                        @csrf
                      Berikan Status pada data izin ini !
                      <select class="col-sm" name="aksi">
                        <option value='accept' selected>Terima</option>
                        <option value='reject'>Tolak</option>
                      </select>
                    </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection