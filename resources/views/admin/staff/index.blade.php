@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      
      <h4 class="card-title fw-bold fs-4">Data Staff  </h4>
      <a href="#" data-bs-toggle="modal" data-bs-target="#tambahDosen" class="btn btn-outline-info p-2 border-1">tambah data</a>
      <div class="table-responsive pt-3 mb-3">
        <table id="id_table" class="table table-bordered  table-striped mt-2">
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
              <th>status
              </th>
              <th>aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dosens as $index=>$user)
            @if($user->id != auth()->user()->id)
            <tr>
              <td>
                {{ $loop->iteration }}
              </td>
              @if (file_exists('storage/' . $user->image))    
              <td>
                <img src="{{ asset('storage/' . $user->image) }}" alt="">
              </td>
              @else
                  <td>
                    <img src="/person/person.jpg" alt="">
                  </td>
              @endif
              <td>
                {{ $user->role->name }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                {{ $user->name }}
              </td>
              <td>
                {{ $user->phone }}
              </td>
              <td>
                {{ $user->address }}
              </td>
             
             
              @if($user->tokens()->first())
              <td>
                <div class="btn btn-success">
                  <i class="bi bi-box-arrow-in-right"></i>
                </div>
              </td>
              @else
              <td>
                <div class="btn btn-danger">
                  <i class="bi bi-box-arrow-right"></i>
                </div>
              </td>
              @endif
              <td class="text-center">
                <a href="#{{ $user->id }}" class="btn btn-warning"
                  data-bs-target="#edit-{{ $user->id }}" data-bs-toggle="modal">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="#{{ $user->id }}" class="btn btn-danger" data-bs-target="#hapus-{{ $user->id }}" data-bs-toggle="modal">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
            @endif

            {{-- modal hapusDosen --}}
            <div class="modal fade" id='hapus-{{ $user->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDosenLabel">Edit Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                    <div class="modal-body">
                        anda yakin menghapus user {{ $user->name }}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  <form action='/staff/{{ $user->id }}' method="post">
                    @method('delete')
                    @csrf
                      <button type="submit" class="btn btn-danger" id="hapus">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal EditDosen-->
            <div class="modal fade" id='edit-{{ $user->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDosenLabel">Edit {{$user->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action='/staff/{{ $user->id }}' method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="modal-body">
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="staticEmail" value="{{ $user->name }}" name='name'>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control" id="staticEmail" value="{{ $user->email }}"
                            name="email">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">new password</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="staticEmail" name="password">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" id="staticEmail" value="{{ $user->phone }}"
                            name="phone">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="staticEmail" value="{{ $user->address }}"
                            name="address">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-form-label col-sm-4">Role</label>
                        <select class="col-sm" name="role_id">
                          @foreach ($roles as $role)
                          @if (old('role_id') != $role->id)
                          <option value={{ $role->id }} selected>{{ $role->name }}</option>
                          @else
                          <option value={{ $role->id }}>{{ $role->name }}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-8">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                            value="{{ $user->position->posisi }}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="image" class="col-sm-4 col-form-label">Gambar</label>
                        <div class="col-sm-8">
                          <img  class="rounded mb-3" style="background-size: cover; width:100px; height:100px" src="../../storage/{{ $user->image }}" alt="image" id="imageOutputStaff">
                          <input class="form-control-sm form-control" type="file" id="image" name="image" value="" onchange="loadfileStaff(event)">
                        </div>
                        <script>
                          var loadfileStaff = function (e) {
                            var loadfileDataStaff = document.getElementById('imageOutputStaff')
                            loadfileDataStaff.src = URL.createObjectURL(event.target.files[0])
                          }
                        </script>
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

{{-- modal tambah user --}}
<div class="modal fade" id='tambahDosen' tabindex="-1" aria-labelledby="editDosenLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editDosenLabel">Tambah {{$posisi->first()->posisi}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action='/staff/{{$posisi->first()->id}}' method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="nameCreate" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nameCreate" placeholder="name" name='name'>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="emailCreate" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="emailCreate" placeholder="email"
                name="email">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="passwordCreate" class="col-sm-4 col-form-label">new password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="passwordCreate" placeholder="password" name="password">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="phoneCreate" class="col-sm-4 col-form-label">Phone</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="phoneCreate" placeholder="phone"
                name="phone">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addressCreate" class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="addressCreate" placeholder="adress"
                name="address">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-form-label col-sm-4">Role</label>
            <select class="col-sm" name="role_id">
              @foreach ($roles as $role)
              @if (old('role_id') != $role->id)
              <option value={{ $role->id }} selected>{{ $role->name }}</option>
              @else
              <option value={{ $role->id }}>{{ $role->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Position</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                value="{{ $position[0]->posisi }}">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="image" class="col-sm-4 col-form-label">Gambar</label>
            <div class="col-sm-8">
              <img class="rounded mb-3" style="background-size: cover; width:100px; height:100px"
                src="" alt="image" id="imageCreateDosen">
              <input class="form-control-sm form-control" type="file" id="image" name="image"
                value="" onchange="loadimageDosen(event)">
            </div>
            <script>
              var loadimageDosen = function (e) {
                var loadimageDosen = document.getElementById('imageCreateDosen')
                loadimageDosen.src = URL.createObjectURL(event.target.files[0])
              }

            </script>
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
@endsection




