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
      <div class="row align-items-center align-items-center">
        <div class="col-md-10">
          
          <h4 class="card-title fw-bold fs-4">Tabel kehadiran</h4>
        </div>
        <div class="col-md-2 ">
            <a href="#" target="blank" class="btn-primary btn p-1" data-bs-toggle="modal" data-bs-target="#cetakPDF"><i class="bi bi-printer-fill"></i> cetak pdf</a>
        </div>
      </div>
    
      <div class="table-responsive pt-3">
        <table class="table table-bordered" id="id_table">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                tanggal
              </th>
              <th>
                 Nama
              </th>
              <th>jabatan
              </th>
              <th>absen masuk
              </th>
              <th>absen keluar
              </th>
              <th>lokasi (long, lat)
              </th>
              <th>keterangan
              </th>
            </tr>
          </thead>
          <tbody>
              @foreach ($presences as $presence)
              <?php 
                $radius = $presence->radius < $rad;
              ?> 
              <tr >
                  <td>
                      {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $presence->presence_date }}
                </td>
                  <td>
                      {{ $presence->user->name }}
                  </td>
                  <td>
                      {{ $presence->user->position->posisi }}
                  </td>
                  <td>
                      @if ($presence->presence_enter_time == null)
                      tidak absen masuk
                      @else
                      {{ $presence->presence_enter_time }}
                      @endif
                  </td>
                  <td>
                      @if ($presence->presence_out_time == null)
                      tidak absen keluar
                      @else
                      {{ $presence->presence_out_time }}
                      @endif
                  </td>
                  <td>
                      @if ($presence->longitude == NULL)
                      lokasi tidak ada
                      @else
                      ({{ $presence->longitude }},{{ $presence->latitude }})
                      @endif
                  </td>
                  <td>
                      @if (!$radius)
                      {{ $presence->radius }}
                      @else
                      Absen di dalam kampus
                      @endif
                  </td>
              </tr>
              @endforeach
          </tbody>    
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cetakPDF" tabindex="-1" aria-labelledby="cetakPDFLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cetakPDFLabel">Cetak Data Pertanggal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
            <input type="date" class="form-control" id="tanggal_awal" aria-describedby="tanggal_awal" name="tanggal_awal">
          </div>
          <div class="mb-3">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" class="form-control" id="tanggal_akhir" aria-describedby="tanggal_akhir" name="tanggal_akhir">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="" type="button" class="btn btn-primary" onclick="this.href='/cetakKehadiran/' + document.getElementById('tanggal_awal').value + '/' + document.getElementById('tanggal_akhir').value">Submit</a>
      </div>
    </div>
  </div>
</div>

@endsection