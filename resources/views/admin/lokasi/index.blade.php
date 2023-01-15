@extends('admin.main')
@section('container')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title fw-bold fs-4">Lokasi Absensi</h4>
        <div class="row mt-2">
          <div class="col-md-8 mb-2">
            <div class="table-responsive" id="col-lokasi">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3212.961720634252!2d114.30471131416029!3d-8.294104685715096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3045beb8a6c8ef66!2zOMKwMTcnMzguOCJTIDExNMKwMTgnMjQuOCJF!5e1!3m2!1sid!2sus!4v1669259222403!5m2!1sid!2sus" width="800" height="450" class="ms-auto" allowfullscreen="yes" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
            </div>
          </div>
          <div class="col-md-4">
            <ul class="list-group fs-6 fst-italic">
              <li class="list-group-item ">Jalan Raya Jember No.KM13, Kawang,
                Labanasem, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461</li>
              <li class="list-group-item ">P844+8Q Labanasem, Kabupaten Banyuwangi, Jawa Timur</li>
              <li class="list-group-item ">https://www.poliwangi.ac.id/</li>
              <li class="list-group-item ">0333636780</li>
            </ul>
          </div>
        </div>
          
         
        
        
        
      </div>
    </div>
</div>


@endsection

{{-- @section('script') --}}
{{-- <script>
  if($(document).width() <= 759){
    var width = 300
  }else{
    var width = 900
  }
 $("#col-lokasi").html(`<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3212.961720634252!2d114.30471131416029!3d-8.294104685715096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3045beb8a6c8ef66!2zOMKwMTcnMzguOCJTIDExNMKwMTgnMjQuOCJF!5e1!3m2!1sid!2sus!4v1669259222403!5m2!1sid!2sus" width="${$(document).width()-360}" height="450" class="ms-auto" allowfullscreen="yes" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>`)
</script> --}}
{{-- @endsection --}}