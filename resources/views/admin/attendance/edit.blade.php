@extends('admin.main')
@section('container')
<div class="content-wrapper">
  
  
  <div class="col-12 grid-margin mx-auto mt-3">
    <div class="card pt-2">
      <div class="card-body">
     
        <h4 class="card-title">Tambah Jadwal Absensi</h4>
        <form class="form-sample" method="post" action="/attendance/{{ $attendance->id }}">
          @method('patch')
          @csrf
          <div class="col-md-6 pb-2">
            <label class="pb-2">Title</label>
            <div id="the-basics">
              <input class="typeahead col-md-6" type="text" placeholder="jadwal untuk ....." name="title" value="{{ old('title', $attendance->title) }}">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Start time</label>
              <input class="typeahead col-md-6 " placeholder="07:00" name="start_time" value="{{ old('start_time', $attendance->start_time) }}"/>
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Limit Start time</label>
              <input class="typeahead col-md-6 " placeholder="07:10" name="limit_start_time" value="{{ old('limit_start_time', $attendance->limit_start_time) }}"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">End time</label>
              <input class="typeahead col-md-6 " placeholder="16:00" name="end_time" value="{{ old('end_time', $attendance->end_time) }}"/>
            </div>
            <div class="col-md-6">
              <label class="col-form-label">Limit end time</label>
              <input class="typeahead col-md-6 " placeholder="16:10" name="limit_end_time" value="{{ old('limit_end_time', $attendance->limit_end_time) }}"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Position</label>
              <select class="js-example-basic-single w-100 col-lg-12" name="position_id" value="{{old($attendance->position_id) }}"> 
                <option value={{ $attendance->position_id }} selected>{{ $attendance->position->posisi }}</option>
              </select>
            </div>
          </div>
      </div>
      <button type="submit" class="btn btn-primary  col-md-6 mx-auto mb-5">Edit Attendances </button>
      </form>
    </div>
  </div>
</div>
@endsection

