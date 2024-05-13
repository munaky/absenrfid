@php
    $dataNamaRuang = App\Http\Controllers\GetDataController::getNamaRuang();
    $data = array('ruang' => $dataNamaRuang);
    $index = 1;
    if(isset($jadwal)){
        $data['jadwal'] = $jadwal;
    }
@endphp
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jadwal Pelajaran @if(isset($ruang)){{$ruang}}@endif</h1>
</div>

<!-- Content Row -->

<!-- Button trigger modal -->
<form method="POST" action="/filter/jadwal_pelajaran">
@csrf
<div class="row align-items-center mb-3">

<div class="col-md-3">
    <div class="form-group m-0">

        <select class="form-control form-select" name="ruang">
            <option class="d-none" disabled selected value=" ">Pilih Ruangan</option>
            @foreach ($data['ruang'] as $row)
                <option>{{$row['nama']}}</option>
            @endforeach
        </select>

    </div>
</div>

<div class="col-auto">
    <div>
     <button type="submit" class="btn btn-primary h-100">Find</button>
    </div>
</div>

</div>
</form>

<div class="table-responsive">
<table class="table table-striped table-hover text-center">
<thead>
  <tr>
    <th scope="col">Jam</th>
    <th scope="col">Senin</th>
    <th scope="col">Selasa</th>
    <th scope="col">Rabu</th>
    <th scope="col">Kamis</th>
    <th scope="col">Jumat</th>
  </tr>
</thead>
<tbody>
    @if (isset($data['jadwal']))
    @foreach ($data['jadwal'] as $row)
        <tr>
            <th scope="row">@php
                echo $index;
                $index++;
            @endphp</th>
            <td>
                {{$row['senin']['guru']}}
                <p class="mb-0">{{$row['senin']['mapel']}}/{{$row['senin']['kelas']}}</p>
            </td>
            <td>
                {{$row['selasa']['guru']}}
                <p class="mb-0">{{$row['selasa']['mapel']}}/{{$row['selasa']['kelas']}}</p>
            </td>
            <td>
                {{$row['rabu']['guru']}}
                <p class="mb-0">{{$row['rabu']['mapel']}}/{{$row['rabu']['kelas']}}</p>
            </td>
            <td>
                {{$row['kamis']['guru']}}
                <p class="mb-0">{{$row['kamis']['mapel']}}/{{$row['kamis']['kelas']}}</p>
            </td>
            <td>
                {{$row['jumat']['guru']}}
                <p class="mb-0">{{$row['jumat']['mapel']}}/{{$row['jumat']['kelas']}}</p>
            </td>
        </tr>
    @endforeach
    @endif
</tbody>
</table>
</div>
