@include('admin.partials.head')

<body style="text-align: center;">
    <h1>laporan Kehadiran</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>
                    tanggal
                </th>
                <th>
                    Nama
                </th>
                <th>jabatan
                </th>
                <th>absen masuk
                </th>
                <th>absen keluar
                </th>
                <th>lokasi (long, lat)
                </th>
                <th>keterangan
                </th>
            </tr>
        </thead>   
        <tbody>
           
            @foreach ($presences as $presence)
            <?php 
          $radius = $presence->radius < $rad;
        ?>
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $presence->presence_date }}
                </td>
                <td>
                    {{ $presence->user->name }}
                </td>
                <td>
                    {{ $presence->user->position->posisi }}
                </td>
                <td>
                    @if ($presence->presence_enter_time == null)
                    tidak absen masuk
                    @else
                    {{ $presence->presence_enter_time }}
                    @endif
                </td>
                <td>
                    @if ($presence->presence_out_time == null)
                    tidak absen keluar
                    @else
                    {{ $presence->presence_out_time }}
                    @endif
                </td>
                <td>
                    @if ($presence->longitude == NULL)
                    lokasi tidak ada
                    @else
                    ({{ $presence->longitude }},{{ $presence->latitude }})
                    @endif
                </td>
                <td>
                    @if (!$radius)
                    login di luar kampus
                    @else
                    login di dalam kampus
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        

    </table>

    <script>
      window.print();
    </script>
</body>

</html>