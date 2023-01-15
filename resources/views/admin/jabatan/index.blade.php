@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold fs-4">Data Jabatan</h4>
      <a href="#" data-bs-toggle="modal" data-bs-target="#tambahJabatan" class="btn btn-outline-info p-2 border-1">tambah data</a>
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
                  href="/jabatan/{{ $posisi->posisi }}">
                  <i class="bi bi-eye"></i></a>
                  <a class="btn btn-warning border-0" data-bs-target="#edit--{{ $posisi->id }}" data-bs-toggle="modal" href="#">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="#" data-bs-target="#hapus--{{ $posisi->id }}" data-bs-toggle="modal" class="btn-danger btn border-0">
                    <i class="bi bi-trash"></i>
                  </a>
              </td>
            </tr>


            {{-- modal editJabatan --}}
          <div class="modal fade" id='edit--{{$posisi->id}}' tabindex="-1" aria-labelledby="editDosenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editDosenLabel">Tambah Data Dosen</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action='/jabatan/{{ $posisi->id }}' method="post" enctype="multipart/form-data">
                  @method('patch')
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3 row">
                      <label for="Posisi" class="col-sm-4 col-form-label">Posisi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="Posisi" placeholder="posisi" name='posisi' value="{{$posisi->posisi}}">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- modal hapusJabatan --}}

          <div class="modal fade" id='hapus--{{ $posisi->id }}' tabindex="-1" aria-labelledby="hapusJabatan"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="hapusJabatan">Hapus {{ $posisi->posisi}}</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <div class="modal-body">
                      anda yakin menghapus posisi {{ $posisi->posisi }}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <form action='/jabatan/{{ $posisi->id }}' method="post">
                  @method('delete')
                  @csrf
                    <button type="submit" class="btn btn-danger" id="hapus">Hapus</button>
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

{{-- modal tambahJabatan --}}
  <div class="modal fade" id='tambahJabatan' tabindex="-1" aria-labelledby="editDosenLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editDosenLabel">Tambah Data Dosen</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action='/jabatan' method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3 row">
              <label for="Posisi" class="col-sm-4 col-form-label">Posisi</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="Posisi" placeholder="posisi" name='posisi'>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection