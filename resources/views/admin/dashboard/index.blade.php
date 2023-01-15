@extends('admin.main')
@section('container')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3  grid-margin stretch-card">
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
            <div class="col-md-3  grid-margin stretch-card">
                <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Jumlah User</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="status-summary-ight-white mb-1">saat ini</p>
                                <h2 class="text-white">{{ $UserCount }}</h2>
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>
            @foreach ($position as $posisi)
            <div class="col-md-3  grid-margin stretch-card">
                <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Jumlah Posisi {{ $posisi->posisi }}</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="status-summary-ight-white mb-1">saat ini</p>
                                <h2 class="text-white">{{ $Users->where('position_id',$posisi->id)->count() }}</h2>
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>  
            @endforeach
        </div>
        <div class="card">
          <div class="card-body">
            <h4 class="card-title fw-bold fs-4">Rekomendasi Staff Paling Rajin</h4>
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
                    <th>Jabatan
                    </th>
                    <th>Skor
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($saw as &$data)
                  <tr>
                    <td>
                      {{ $loop->iteration }}
                    </td>
                    <td>
                      {{ $data['nama'] }}
                    </td>
                    <td>
                      {{ $data['jabatan'] }}
                    </td>
                    <td>
                      {{ $data['skor'] }}
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
