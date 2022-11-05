@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Table kehadiran</h4>
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
            @foreach ($users as $user)
            @if ($presence->user_id == $user->id)
            @if ($presence->longitude != null && $presence->latitude != null)
            <?php 
              $lokasizone_latitude = 1;
              $lokasizone_maxlatitude = 2; 
              $lokasizone_longitude = 1;
              $lokasizone_maxlongitude = 2;
              $long = $presence->longitude > $lokasizone_longitude && $presence->longitude < $lokasizone_maxlongitude;    
              $lat = $presence->latitude > $lokasizone_latitude && $presence->latitude < $lokasizone_maxlatitude;
            ?> 
            <tr class="table-info">
              <td>
                {{ $loop->iteration }}
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
                ({{ $presence->longitude  }},{{ $presence->latitude }})
              @endif
            </td>
              <td>
              @if (!$lat || !$long)
                login di  luar kampus
              @else
                login  di dalam kampus    
              @endif
              </td>
            </tr>
            @endif 
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection