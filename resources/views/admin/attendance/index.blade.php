@extends('admin.main')
@section('container')

    <div class="content-wrapper">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Table absensi</h4>
                    {{-- .btn-outline-{color}  --}}
                    <div class="table-responsive pt-3">
                      <table class="table table-bordered table-striped">
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
                              </td>
                            </tr>
                            <!-- Modal EditDosen-->
                            <div class="modal fade" id='edit-{{ $attendance->id }}' tabindex="-1" aria-labelledby="editatAbsen"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editatAbsen">edit at</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action='/attendance/{{ $attendance->id }}' method="post" >
                                    @method('put')
                                    @csrf
                                    <div class="modal-body">
                                      <div class="mb-3 row">
                                        <label for="title" class="col-sm-4 col-form-label">Title</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="title" value="{{ $attendance->title}}" name='title'>
                                        </div>
                                      <input type="hidden"  id="start" value="{{ $attendance->position->id }}"
                                      name="position_id">
                                      <div class="mb-3 row">
                                        <label for="start" class="col-sm-4 col-form-label">Start time</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="start" value="{{ $attendance->start_time }}"
                                            name="start_time">
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="limitStart" class="col-sm-4 col-form-label">Limit Start time</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="limitStart" name="limit_start_time" value="{{ $attendance->limit_start_time }}"> 
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="end" class="col-sm-4 col-form-label">end time</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="end" value="{{ $attendance->end_time }}"
                                            name="end_time">
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="limit_end" class="col-sm-4 col-form-label">limit end time</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="limit_end" value="{{ $attendance->limit_end_time }}"
                                            name="limit_end_time">
                                        </div>
                                      </div>
                                      <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Position</label>
                                        <div class="col-sm-8">
                                          <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                            value="{{ $attendance->position->posisi }}">
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
                    </div>
                  </div>
                </div>
              </div>
       
    
    
@endsection
