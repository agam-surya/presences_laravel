@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      
      <h4 class="card-title fw-bold fs-4">Table dosen</h4>
      {{-- .btn-outline-{color} --}}
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
              <th>aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dosens as $index=>$dosen)
            @if($dosen->id != auth()->user()->id)
            <tr>
              <td>
                {{ $loop->iteration }}
              </td>
              <td>
                <img src="{{ asset('storage/' . $dosen->image) }}" alt="">
              </td>
              <td>
                {{ $dosen->role->name }}
              </td>
              <td>
                {{ $dosen->email }}
              </td>
              <td>
                {{ $dosen->name }}
              </td>
              <td>
                {{ $dosen->phone }}
              </td>
              <td>
                {{ $dosen->address }}
              </td>
              <td class="text-center">
                <a href="#{{ $dosen->id }}" class="btn btn-warning"
                  data-bs-target="#edit-{{ $dosen->id }}" data-bs-toggle="modal">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="#{{ $dosen->id }}" class="btn btn-danger" data-bs-target="#hapus-{{ $dosen->id }}" data-bs-toggle="modal">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
            @endif


            {{-- modal hapusDosen --}}
            <div class="modal fade" id='hapus-{{ $dosen->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDosenLabel">Edit Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                    <div class="modal-body">
                        anda yakin menghapus dosen {{ $dosen->name }}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  <form action='/dosen/{{ $dosen->id }}' method="post">
                    @method('delete')
                    @csrf
                      <button type="submit" class="btn btn-danger" id="hapus">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal EditDosen-->
            <div class="modal fade" id='edit-{{ $dosen->id }}' tabindex="-1" aria-labelledby="editDosenLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDosenLabel">Edit Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action='/dosen/{{ $dosen->id }}' method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="modal-body">
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="staticEmail" value="{{ $dosen->name }}" name='name'>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control" id="staticEmail" value="{{ $dosen->email }}"
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
                          <input type="number" class="form-control" id="staticEmail" value="{{ $dosen->phone }}"
                            name="phone">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="staticEmail" value="{{ $dosen->address }}"
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
                            value="{{ $dosen->position->posisi }}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="image" class="col-sm-4 col-form-label">Gambar</label>
                        <div class="col-sm-8">
                          <img class="rounded mb-3" style="background-size: cover; width:100px; height:100px"
                            src="storage/{{ $dosen->image }}" alt="image" id="imageOutputDosen">
                          <input class="form-control-sm form-control" type="file" id="image" name="image"
                            value="{{ $dosen->image }}" onchange="loadimageDosen(event)">
                        </div>
                        <script>
                          var loadimageDosen = function (e) {
                            var loadimageDosen = document.getElementById('imageOutputDosen')
                            imageOutputDosen.src = URL.createObjectURL(event.target.files[0])
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

{{-- modal tambah dosen --}}
<div class="modal fade" id='tambahDosen' tabindex="-1" aria-labelledby="editDosenLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editDosenLabel">Tambah Data Dosen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action='/dosen' method="post" enctype="multipart/form-data">
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




