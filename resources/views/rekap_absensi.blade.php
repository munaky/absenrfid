@php
    $kelas = App\Http\Controllers\GetDataController::getKelas();
    $data = array('kelas' => $kelas);
    if (isset($absensi)){
        $data['absensi'] = $absensi;
    }
    $index = 1;
@endphp

<style>
    @media print {
   /* This media query only applies itself to the page during printing */
   button, label, h1, select, a,header, footer, nav, ul, li, input, .dropdown-menu{
     display: none !important;
   }
}
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekap Absensi Murid</h1>
</div>

<!-- Button trigger modal -->
<form method="POST" action="/filter/rekap_absensi">
@csrf
<div class="row align-items-center mb-3">
    <div class="col-md-3">
        <label>Rekap</label>
        <div class="form-group m-0">
            <select class="form-control" name="rekap" required>
                <option class="d-none" disable selected>Kurun Waktu</option>
                <option>Per 1 Minggu</option>
                <option>Per 2 Minggu</option>
                <option>Per 3 Minggu</option>
                <option>Per Bulan</option>
                <option>All</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Kelas</label>
        <select class="form-control form-select" name="kelas" required>
            <option class="d-none" disable selected>Pilih Kelas</option>
            @foreach ($data['kelas'] as $row)
                <option>{{$row['kelas']}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 align-self-end">
        <div class="btn-group" role="group">
            <div>
                <button type="submit" class="btn btn-primary h-100">Find</button>
            </div>

            @if (isset($absensi))
            <button type="button" class="btn btn-success dropdown-toggle ml-3 rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Export
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="window.print()">PDF</a>
                <a class="dropdown-item" href="/export/absensi">Excel</a>
            </div>
            @endif
        </div>
    </div>
</div>
</form>

<!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
+ Tambah
</button>-->
<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">Kelas</th>
    <th scope="col">Tanggal</th>
    <th scope="col">Mata Pelajaran</th>
    <th scope="col">Status</th>
    <th scope="col">Jam Masuk</th>
    <th scope="col">Jam Keluar</th>
    <th scope="col">Ruang</th>
  </tr>
</thead>
<tbody>
    @if (isset($absensi))
        @foreach ($data['absensi'] as $row)
        <tr>
            <th scope="row">@php
                echo $index;
                $index++
            @endphp</th>
            <td>{{$row['nama']}}</td>
            <td>{{$row['kelas']}}</td>
            <td>{{$row['tanggal']}}</td>
            <td>{{$row['mapel']}}</td>
            <td>{{$row['status']}}</td>
            <td>{{$row['jam_masuk']}}</td>
            <td>{{$row['jam_keluar']}}</td>
            <td>{{$row['ruang']}}</td>
        </tr>
        @endforeach
    @endif
</tbody>
</table>
</div>

<script>
    document.getElementById('test').onchange = function(s){
        console.log(this.option);
    }
</script>
