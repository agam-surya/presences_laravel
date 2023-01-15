@extends('admin.main')
@section('container')
<div class="content-wrapper">
  
  
  <div class="col-12 grid-margin mx-auto mt-3">
    <div class="card pt-2">
      <div class="card-body">
     
        <h4 class="card-title">Tambah Jadwal Absensi</h4>
        <form class="form-sample" method="post" action="/attendance">
          @csrf
          <div class="col-md-6 pb-2">
            <label class="pb-2">Title</label>
            <div id="the-basics">
              <input class="typeahead col-md-6" type="text" placeholder="jadwal untuk ....." name="title">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Start time</label>
              <input class="typeahead col-md-6 " placeholder="07:00" name="start_time"/>
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Limit Start time</label>
              <input class="typeahead col-md-6 " placeholder="07:10" name="limit_start_time"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">End time</label>
              <input class="typeahead col-md-6 " placeholder="16:00" name="end_time"/>
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Limit end time</label>
              <input class="typeahead col-md-6 " placeholder="16:10" name="limit_end_time"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Position</label>
              <select class="js-example-basic-single w-100 col-lg-12" name="position_id">
                @foreach ($position as $jabatan)
                        @if (old('position_id') == $jabatan->id)
                            <option value={{ $jabatan->id }} selected>{{ $jabatan->posisi }}</option>
                        @else
                            <option value={{ $jabatan->id }}>{{ $jabatan->posisi }}</option>
                        @endif
                    @endforeach
              </select>
            </div>
          </div>
      </div>
      <button type="submit" class="btn btn-primary  col-md-6 mx-auto mb-5">Add Attendances </button>
      </form>
    </div>
  </div>
</div>
@endsection

