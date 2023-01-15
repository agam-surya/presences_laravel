@extends('admin.main')
@section('container')

    <div class="content-wrapper">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title fw-bold fs-4">Tabel Jadwal Absensi</h4>
                     <a href="#" data-bs-toggle="modal" data-bs-target="#tambahJadwal" class="btn btn-outline-info p-2 border-1">tambah data</a>
                    {{-- .btn-outline-{color}  --}}
                    <div class="table-responsive pt-3">
                      <table class="table table-bordered table-striped" id="id_table">
                        <thead>
                          <tr>
                            <th>
                              #
                            </th>
                            <th>
                              Title
                            </th>
                            <th>Position
                            </th>
                            <th>Enter Presence
                            </th>
                            <th>Out Presence
                            </th>
                            <th>Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                            <tr>
                              <td>
                                {{ $loop->iteration }}
                              </td>
                              <td>
                                {{ $attendance->title }}
                              </td>
                              <td>
                                {{ $attendance->position->posisi }}
                              </td>
                              <td>
                                @if ($attendance->start_time == null )
                                    Bebas
                                @else
                                {{ $attendance->start_time . ' - '.$attendance->limit_start_time }} 
                                @endif                               
                              </td>
                              <td>
                                @if ($attendance->end_time == null )
                                5 jam setelah absen 
                                @else
                                  {{ $attendance->end_time . ' - '.$attendance->limit_end_time }} 
                                @endif   
                              </td>
                              <td>
                                <a class="btn btn-warning border-0 text-dark text-decoration-none" href="#{{ $attendance->id }}"  data-bs-toggle="modal" data-bs-target="#edit-{{ $attendance->id }}">
                                  <i class="bi bi-pencil-square"></i></a>
                                  <a href="#" data-bs-target="#hapus--{{ $attendance->id }}" data-bs-toggle="modal" class="btn-danger btn border-0">
                                    <i class="bi bi-trash"></i>
                                  </a>
                              </td>
                            </tr>
                            <!-- Modal EditJadwal-->
                            <div class="modal fade" id='edit-{{ $attendance->id }}' tabindex="-1" aria-labelledby="editatAbsen"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editatAbsen">edit {{ $attendance->title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action='/attendance/{{ $attendance->id }}' method="post" >
                                    @method('put')
                                    @csrf
                                    <div class="modal-body">
                                      <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Position</label>
                                        <div class="col-sm-8">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                            value="{{ $attendance->position->posisi }}">
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="title" class="col-sm-4 col-form-label">Title</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="title" value="{{ $attendance->title}}" name='title'>
                                        </div>
                                      </div>
                                      <input type="hidden"  id="start" value="{{ $attendance->position->id }}" name="position_id">
                                      <div class="mb-3 row">
                                        <label for="start" class="col-sm-4 col-form-label">Absen Masuk</label>
                                        <div class="col-sm-8">
                                          <input type="time" class="form-control" id="start" value="{{ $attendance->start_time }}"
                                            name="start_time">
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="limitStart" class="col-sm-4 col-form-label">Limit Absen Masuk</label>
                                        <div class="col-sm-8">
                                          <input type="time" class="form-control" id="limitStart" name="limit_start_time" value="{{ $attendance->limit_start_time }}"> 
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="end" class="col-sm-4 col-form-label">Absen Pulang</label>
                                        <div class="col-sm-8">
                                          <input type="time" class="form-control" id="end" value="{{ $attendance->end_time }}"
                                            name="end_time">
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="limit_end" class="col-sm-4 col-form-label">limit Absen Pulang</label>
                                        <div class="col-sm-8">
                                          <input type="time" class="form-control" id="limit_end" value="{{ $attendance->limit_end_time }}"
                                            name="limit_end_time">
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
                            {{-- Modal HapusJadwal --}}
                            <div class="modal fade" id='hapus--{{ $attendance->id }}' tabindex="-1" aria-labelledby="hapusJabatan"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="hapusJabatan">Hapus Dosen</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                    <div class="modal-body">
                                        anda yakin menghapus jadwal Absen untuk posisi {{ $attendance->position->posisi }}
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                  <form action='/attendance/{{ $attendance->id }}' method="post">
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
       
    {{-- modal tambahJadwal --}}
    <div class="modal fade" id='tambahJadwal' tabindex="-1" aria-labelledby="tambahJadwalAbsen"
    aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahJadwalAbsen">Tambah Data Jadwal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action='/attendance' method="post">
            @csrf
            <div class="modal-body">
              <div class="mb-3 row">
                <label class="col-form-label col-sm-4">Role</label>
                            <select class="col-sm" name="position_id">
                              @foreach ($position as $pos)
                              @if (old('position_id') != $pos->id)
                              <option value={{ $pos->id }} selected>{{ $pos->posisi }}</option>
                              @else
                              <option value={{ $pos->id }}>{{ $pos->posisi }}</option>
                              @endif
                              @endforeach
                            </select>
              </div>
              <div class="mb-3 row">
                <label for="title" class="col-sm-4 col-form-label">Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="title" placeholder="title" name='title'>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="title" class="col-sm-4 col-form-label">Absen Masuk</label>
                <div class="col-sm-8">
                  <input type="time" class="form-control" id="title" placeholder="title" name='start_time'>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="title" class="col-sm-4 col-form-label">Batas Absen Masuk</label>
                <div class="col-sm-8">
                  <input type="time" class="form-control" id="title" placeholder="title" name='limit_start_time'>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="absen_pulang" class="col-sm-4 col-form-label">Absen Pulang</label>
                <div class="col-sm-8">
                  <input type="time" class="form-control" id="absen_pulang" placeholder="5 jam Setelah Absen" name='end_time'>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="batas_absen_pulang" class="col-sm-4 col-form-label">Batas Absen Pulang</label>
                <div class="col-sm-8">
                  <input type="time" class="form-control" id="batas_absen_pulang" placeholder="5 jam setelah Absen" name='limit_end_time'>
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
