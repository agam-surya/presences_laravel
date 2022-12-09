@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold fs-4">Tabel Libur</h4>
      {{-- .btn-outline-{color} --}}
      <a href="#" data-bs-toggle="modal" data-bs-target="#tambahDataLibur" class="btn btn-outline-info p-2 border-1">tambah data</a>
      <div class="table-responsive pt-3">
        <table class="table table-bordered table-striped" id="id_table">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                Deskripsi
              </th>
              <th>Tanggal Libur
              </th>
              <th>Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($holidays as $holiday)
            <tr>
              <td>
                {{ $loop->iteration }}
              </td>
              <td>
                {{ $holiday->keterangan }}
              </td>
              <td>
               {{ $holiday->date_holidays }}
              </td>
              <td class="text-center">
                <a href="#{{ $holiday->id }}" class="btn btn-warning"
                  data-bs-target="#edit-{{ $holiday->id }}" data-bs-toggle="modal">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="#{{ $holiday->id }}" class="btn btn-danger" data-bs-target="#hapus-{{ $holiday->id }}" data-bs-toggle="modal">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>




            <div class="modal fade" id='hapus-{{ $holiday->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editDosenLabel">Edit Dosen</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                      <div class="modal-body">
                          anda yakin menghapus holiday {{ $holiday->keterangan }}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <form action='/holidays/{{ $holiday->id }}' method="post">
                      @method('delete')
                      @csrf
                        <button type="submit" class="btn btn-danger" id="hapus">Hapus</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modal EditDosen-->
              <div class="modal fade" id='edit-{{ $holiday->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editDosenLabel">Edit Dosen</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='/holidays/{{ $holiday->id }}' method="post">
                      @method('patch')
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3 row">
                          <label  class="col-sm-4 col-form-label">Ketarangan</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control"  value="{{ $holiday->keterangan }}" name='keterangan'>
                          </div>
                        </div>
                        
                        <div class="mb-3 row">
                          <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal</label>
                          <div class="col-sm-8">
                            <input type="date" class="form-control" id="staticEmail" value="{{ $holiday->date_holidays }}"
                              name="date_holidays">
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
            @endforeach
          </tbody>
        </table>

        <div class="modal fade" id='tambahDataLibur' tabindex="-1" aria-labelledby="editDosenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editDosenLabel">Edit Dosen</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action='/holidays' method="post">
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3 row">
                      <label  class="col-sm-4 col-form-label">Ketarangan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name='keterangan'>
                      </div>
                    </div>
                    
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="staticEmail" 
                          name="date_holidays">
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
      </div>
    </div>
  </div>
</div>
@endsection