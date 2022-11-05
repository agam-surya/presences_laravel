@extends('admin.main')
@section('container')
<div class="content-wrapper">
  @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
  @elseif((session()->has('error')))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('error')}}
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
  @endif
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Table pegawai</h4>
      {{-- .btn-outline-{color} --}}
      <div class="col-md-6">
        <a href="/pegawai/create" class="btn btn-outline-info">tambah data</a>
      </div>
      <div class="table-responsive pt-3">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                gambar
              </th>
              <th>role
              </th>
              <th>email
              </th>
              <th>Nama
              </th>
              <th>phone
              </th>
              <th>Address
              </th>
              <th>Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pegawais as $pegawai)
            @if ($pegawai->id != $user->id)
            <tr class="table-info">
              <td>
                {{ $loop->iteration }}
              </td>

              <td>
                <img src="{{ asset('storage/' . $pegawai->image) }}" alt="">
              </td>
              <td>
                {{ $pegawai->role->name }}
              </td>
              <td>
                {{ $pegawai->email }}
              </td>
              <td>
                {{ $pegawai->name }}
              </td>
              <td>
                {{ $pegawai->phone }}
              </td>
              <td>
                {{ $pegawai->address }}
              </td>
              <td>
                <a class="badge bg-warning border-0 text-dark text-decoration-none "
                  href="/pegawai/{{ $pegawai->id }}/edit">
                  Edit</a>
                <form action="/pegawai/{{ $pegawai->id }}" method="post" class="d-inline-block">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="confirm('are you sure')">
                    delete </button>
                </form>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection