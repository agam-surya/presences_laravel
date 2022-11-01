@extends('admin.main')
@section('container')
<div class="content-wrapper">
  
  
  <div class="col-12 grid-margin mx-auto mt-3">
    <div class="card pt-2">
      <div class="card-body">
        <h4 class="card-title">Edit Data dosen</h4>
        <form class="form-sample" method="post" action="/dosen/{{ $dosen->id }}" enctype="multipart/form-data">
            @method('patch')
          @csrf
            <div class="row">
            <div class="col-md-6 pb-2">
                <label class="pb-2">Name</label>
                <div id="the-basics">
                <input class="typeahead col-md-6" type="text" placeholder="Input Name" name="name" value="{{ old('name',$dosen->name) }}">
                </div>
            </div>
            <div class="col-md-6 pb-2">
                <label class="pb-2">phone</label>
                <div id="the-basics">
                <input class="typeahead col-md-6"  placeholder="Input phone" name="phone" value="{{ old('phone',$dosen->phone) }}" autocomplete="off">
                </div>
            </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Email</label>
              <input class="typeahead col-md-6 @error('email') is-invalid @enderror" type="email" placeholder="input Email" name="email" value="{{ old('email',$dosen->email) }}" autocomplete="off"/>
            </div>
            <div class="col-md-6">
              <label class="col-form-label"> password </label>
              <input class="typeahead col-md-6 " type="text" placeholder="input new Password" name="password" value="{{ old('password') }}" autocomplete="off"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label">Address</label>
              <input class="typeahead col-md-6 " type="text" placeholder="input Adress" name="address" value="{{ old('address',$dosen->address) }}" autocomplete="off"/>
              @error('address')
              {{ $message }}
             @enderror
            </div>
            <div class="col-md-6">
                <label class="col-form-label">Role</label>
                <select class=" w-100 col-lg-12" name="role_id">
                  @foreach ($roles as $role)
                          @if (old('role_id') == $role->id)
                              <option value={{ $role->id }} selected>{{ $role->name }}</option>
                          @else
                              <option value={{ $role->id }}>{{ $role->name }}</option>
                          @endif
                      @endforeach
                </select>
              </div>
          </div>
          <div class="mb-3 mt-3">
            <label for="image" class="form-label">dosen Image</label>
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
            <a href="/dosen" class="btn btn-success text-decoration-none ">back</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/posts/checkSlug?slug=' + title.value)
            .then(response => response - > json())
            .then(data => slug.value => data.slug)
    })

    document.addEventListener('trix-file-accept', function(event) {
        event.preventDefault();
    })
    function previewImage() {
                    const image = document.querySelector('#image')
                    const prevImage = documetn.querySelector('.img-preview')

                    prevImage.style.display = 'block';
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);
                    oFReader.onload = function(oFRevent) {
                        prevImage.src = oFRevent.target.result
                    }
                  }
           
            
</script>
@endsection

