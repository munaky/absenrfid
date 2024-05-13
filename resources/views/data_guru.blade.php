@php
    $dataGuru = App\Http\Controllers\GetDataController::getGuru();
    $dataMapel = App\Http\Controllers\GetDataController::getmapel();
    $data = array('guru' => $dataGuru, 'mapel' => $dataMapel);
    $index = 1;
@endphp

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
</div>

<!-- Content Row -->

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
+ Tambah
</button>
<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">Mata Pelajaran</th>
    <th scope="col">Aksi</th>
  </tr>
</thead>
<tbody>
    @foreach ($data['guru'] as $row)
        <tr>
            <th scope="row">@php
                echo $index;
                $index++;
            @endphp</th>
            <td>{{$row['nama']}}</td>
            <td>
                @foreach ($row['mapel'] as $mapel)
                    <p>{{$mapel}}</p>
                @endforeach
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="{{$row['id_guru']}}" data-nama="{{$row['nama']}}" data-mapel="{{json_encode($row['mapel'])}}" data-toggle="modal" data-target="#modalEdit">Edit</button>
                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$row['id_guru']}}" data-toggle="modal" data-target="#modalDelete">Hapus</button>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
</div>

{{-- Datalist --}}
<datalist id="datalistOptions">
    @foreach ($data['mapel'] as $row)
        <option value="{{$row['mapel']}}">
    @endforeach
</datalist>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" action="/add/data_guru">
@csrf

<div>
    <label class="form-label m-0">Nama</label>
    <input type="text" class="form-control" name="nama" placeholder="Enter Nama " aria-describedby="namaHelp" required>
</div>
<div>
    <label class="form-label w-100 position-relative m-0">Mata Pelajaran <span class="badge bg-primary position-absolute end-0 top-50 translate-middle-y" onclick="modalAddTambah()">+ Tambah Mapel</span></label>
    <input type="text" list="datalistOptions" class="form-control mb-2" name="mapel[]" placeholder="Pilih" required>
    <div id="modalAddList">

    </div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Guru</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <form method="POST" action="/edit/data_guru">
        @csrf
        <input type="text" class="d-none" value="" id="editId" name="id">

        <div>
            <label for="exampleInputnama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="editNama" aria-describedby="namaHelp" required>
        </div>
        <div>
            <label class="form-label w-100 position-relative m-0">Mata Pelajaran <span class="badge bg-primary position-absolute end-0 top-50 translate-middle-y" onclick="modalEditTambah()">+ Tambah Mapel</span></label>
            <input type="text" list="datalistOptions" class="form-control mb-2" name="mapel[]" id="editMapel" placeholder="Pilih" required>
            <div id="modalEditList">

            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>
</div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/delete/data_guru">
        @csrf
        <input type="text" class="d-none" value="" id="deleteId" name="deleteId">
     <div>
        Apakah yakin ingin menghapus Data Tersebut??
     </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
  </form>
</div>
</div>
</div>

<script>
    var editbtn = document.getElementsByClassName('edit-btn');
    var delbtn = document.getElementsByClassName('delete-btn');

    for(var x = 0; x < delbtn.length; x++){
        delbtn[x].addEventListener('click', function () {
            document.getElementById('deleteId').value = this.dataset.id;
        })
    }

    for(var x = 0; x < editbtn.length; x++){
        editbtn[x].addEventListener('click', function () {
            document.getElementById('editId').value = this.dataset.id;
            document.getElementById('editNama').value = this.dataset.nama;

            let mapel = JSON.parse(this.dataset.mapel);
            let mapelList = "";

            for(let y = 1; y < mapel.length; y++){
                mapelList += `
        <div class="input-group mb-2">
            <button class="btn btn-danger" type="button" onclick="hapusMapel(this)">-</button>
            <input type="text" list="datalistOptions" class="form-control" name="mapel[]" placeholder="Pilih" value="`+mapel[y]+`" required>
        </div>
        `;
            }

            document.getElementById('modalEditList').innerHTML = mapelList;
            document.getElementById('editMapel').value = mapel[0];

        })
    }

    function modalAddTambah(){
        document.getElementById('modalAddList').innerHTML += `
        <div class="input-group mb-2">
            <button class="btn btn-danger" type="button" onclick="hapusMapel(this)">-</button>
            <input type="text" list="datalistOptions" class="form-control" name="mapel[]" placeholder="Pilih" required>
        </div>
        `;
    }

    function modalEditTambah(){
        document.getElementById('modalEditList').innerHTML += `
        <div class="input-group mb-2">
            <button class="btn btn-danger" type="button" onclick="hapusMapel(this)">-</button>
            <input type="text" list="datalistOptions" class="form-control" name="mapel[]" placeholder="Pilih" required>
        </div>
        `;
    }

    function hapusMapel($x){
        $x.parentNode.remove();
    }
</script>
