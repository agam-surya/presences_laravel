@extends('admin.main')
@section('container')
<div class="content-wrapper">
  
  
  <div class="col-12 grid-margin mx-auto mt-3">
    <div class="card pt-2">
      <div class="card-body">
        <h4 class="card-title">My profile</h4>
        {{-- <div class="ms-auto"> --}}
        <img class="rounded text-center" width="140px" src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->image }}">
        {{-- </div> --}}
        <form class="form-sample" method="post" action="/myprofile/{{ $user->id }}" enctype="multipart/form-data">
            @method('patch')
          @csrf
            <div class="row">
            <div class="col-md-6 pb-2">
                <label class="pb-2">Name</label>
                <div id="the-basics">
                <input class="typeahead col-md-6" type="text" placeholder="Input Name" name="name" value="{{ old('name',$user->name) }}">
                </div>
            </div>
            <div class="col-md-6 pb-2">
                <label class="pb-2">phone</label>
                <div id="the-basics">
                <input class="typeahead col-md-6"  placeholder="Input phone" name="phone" value="{{ old('phone',$user->phone) }}" autocomplete="off">
                </div>
            </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Email</label>
              <input class="typeahead col-md-6 @error('email') is-invalid @enderror" type="email" placeholder="input Email" name="email" value="{{ old('email', $user->email) }}" autocomplete="off"/>
            </div>
            <div class="col-md-6">
              <label class="col-form-label"> reset password </label>
              <input class="typeahead col-md-6 " type="text" placeholder="input new Password" name="password" value="{{ old('password') }}" autocomplete="off"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Address</label>
              <input class="typeahead col-md-6 " type="text" placeholder="input Adress" name="address" value="{{ old('address',$user->address) }}" autocomplete="off"/>
              @error('address')
              {{ $message }}
             @enderror
            </div>
            <div class="col-md-6">
                <label class="col-form-label">Jabatan</label>
                <select class=" w-100 col-lg-12" name="position_id">
                  @foreach ($position as $posisi)
                          @if (old('role_id') != $posisi->id)
                              <option value={{ $posisi->id }} selected>{{ $posisi->posisi }}</option>
                          @else
                              <option value={{ $posisi->id }}>{{ $posisi->posisi }}</option>
                          @endif
                      @endforeach
                </select>
              </div>
          </div>
          <div class="mb-3 mt-3">
            <label for="image" class="form-label">Pegawai Image</label>
            <input class="form-control form-control-sm col-md-6 @error('image') is-invalid @enderror" id="image"
            type="file" name="image" onchange='previewImage'>
            <img alt="" class="img-preview img-fluid">
            @error('image')
                {{ $message }}
            @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 mx-auto">
            <button type="submit" class="btn btn-primary  mx-auto mb-5 ">submit </button>
        </div>
        <div class="col-sm-4">
            <a href="/dashboard" class="btn btn-success text-decoration-none ">back</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

