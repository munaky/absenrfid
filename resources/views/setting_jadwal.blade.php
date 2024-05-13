@php
    $dataNamaRuang = App\Http\Controllers\GetDataController::getNamaRuang();
    $dataGuru = App\Http\Controllers\GetDataController::getGuru();
    $dataMapel = App\Http\Controllers\GetDataController::getMapel();
    $dataKelas = App\Http\Controllers\GetDataController::getKelas();
    $data = array('ruang' => $dataNamaRuang, 'guru' => $dataGuru, 'mapel' => $dataMapel, 'kelas' => $dataKelas);
@endphp

<datalist id="datalistRuang">
    @foreach ($data['ruang'] as $row)
        <option value="{{$row['nama']}}">
    @endforeach
</datalist>

<datalist id="datalistGuru">
    @foreach ($data['guru'] as $row)
        <option value="{{$row['nama']}}">
    @endforeach
</datalist>

<datalist id="datalistMapel">
    @foreach ($data['mapel'] as $row)
        <option value="{{$row['mapel']}}">
    @endforeach
</datalist>

<datalist id="datalistKelas">
    @foreach ($data['kelas'] as $row)
        <option value="{{$row['kelas']}}">
    @endforeach
</datalist>

<form method="POST" action="/edit/jadwal_pelajaran">
@csrf

<div class="row align-items-center mb-3">
    <div class="col-6">
        Ruang
    </div>
    <div class="col-6">
        Hari
    </div>
    <div class="col-6">
        <div class="form-group m-0">
            <input class="form-control" list="datalistRuang" name="ruang" placeholder="Pilih Ruang" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group m-0">
            <select class="form-control" name="hari" required>
              <option class="d-none" disabled selected value="">Pilih Hari</option>
              <option value="senin">Senin</option>
              <option value="selasa">Selasa</option>
              <option value="rabu">Rabu</option>
              <option value="kamis">Kamis</option>
              <option value="jumat">Jumat</option>
            </select>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        Jam Mulai sd. Selesai
    </div>
    <div class="col-12">
        <div class="input-group">
            <select class="form-control" name="start" required>
                <option class="d-none" disabled selected value="">Jam Mulai</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
              </select>
            <span class="input-group-text">sd.</span>
            <select class="form-control" name="end" required>
                <option class="d-none" disabled selected value="">Jam Selesai</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
              </select>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-4">Guru Mapel</div>
    <div class="col-4">Mata Pelajaran</div>
    <div class="col-4">Kelas</div>
    <div class="col-4">
        <div class ="form-group m-0">
            <input class="form-control" list="datalistGuru" name="guru" placeholder="Pilih Guru" required>
        </div>
    </div>
    <div class="col-4">
        <div class ="form-group m-0">
            <input class="form-control" list="datalistMapel" name="mapel" placeholder="Pilih Mata Pelajaran" required>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group m-0">
            <input class="form-control" list="datalistKelas" name="kelas" placeholder="Pilih Kelas" required>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-auto">
        <div>
         <button type="submit" class="btn btn-primary h-100">Update</button>
        </div>
    </div>
</div>
</form>
