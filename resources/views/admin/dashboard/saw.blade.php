@extends('admin.main')
@section('container')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold fs-4">Tabel Saw</h4>
      <div class="table-responsive pt-3">
        
        <table class="table table-bordered" id="id_table">
          <thead>
           
            <tr>
              <th>
                #
              </th>
              <th>
                 Nama
              </th>
              <th>Skor
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($saw as $data)
            <tr>
              <td>
                {{ $loop->iteration }}
              </td>
              <td>
                {{ $data['nama'][0] }}
              </td>
              <td>
                {{ $data['skor'][0] }}
              </td>
              
            </tr>
            @endforeach
          </tbody>
        </table>

        <table class="table table-bordered" id="id_table">
          
        </table>
      </div>
    </div>
  </div>
</div>
@endsection