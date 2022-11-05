@extends('admin.main')
@section('container')

    <div class="content-wrapper">
      @if (session()->has('success'))
<div class="alert alert-success" role="alert">
   {{ session('success') }}
</div>
@endif
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Table jadwal absensi</h4>
                    {{-- .btn-outline-{color}  --}}
                    <div class="table-responsive pt-3">
                      <table class="table table-bordered">
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
                            @foreach ($attendance as $jadwal)
                            <tr class="table-info">
                              <td>
                                {{ $loop->iteration }}
                              </td>
                              <td>
                                {{ $jadwal->title }}
                              </td>
                              <td>
                                {{ $jadwal->position->posisi }}
                              </td>
                              <td>
                                @if ($jadwal->start_time == null )
                                    Bebas
                                @else
                                {{ $jadwal->start_time . ' - '.$jadwal->limit_start_time }} 
                                @endif                               
                              </td>
                              <td>
                                @if ($jadwal->end_time == null )
                                5 jam setelah absen 
                                @else
                                  {{ $jadwal->end_time . ' - '.$jadwal->limit_end_time }} 
                                @endif   
                              </td>
                              <td>
                                <a class="badge bg-warning border-0 text-dark text-decoration-none " href="/attendance/{{ $jadwal->id }}/edit">
                                  Edit</a>
                                  {{-- <form action="/attendance/{{ $jadwal->id }}" method="post" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="confirm('are you sure')">
                                     delete </button>
                                  </form> --}}
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
