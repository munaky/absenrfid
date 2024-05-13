@php
    $dataKelas = App\Http\Controllers\GetDataController::getKelas();
    $dataGuru = App\Http\Controllers\GetDataController::getGuru();
    $data = array('kelas' => $dataKelas, 'guru' => $dataGuru);
    $index = 1;
@endphp

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kelas & Wali Kelas</h1>
</div>


<!-- Content Row -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
+ Tambah
</button>
<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Kelas</th>
    <th scope="col">Wali Kelas</th>
    <th scope="col">Aksi</th>
  </tr>
</thead>
<tbody>
    @foreach ($data['kelas'] as $row)
        <tr>
            <th scope="row">@php
                echo $index;
                $index++;
            @endphp</th>
            <td>{{$row['kelas']}}</td>
            <td>{{$row['guru']}}</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="{{$row['id_kelas']}}" data-kelas="{{$row['kelas']}}" data-guru="{{$row['guru']}}" data-toggle="modal" data-target="#modalEdit">Edit</button>
                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$row['id_kelas']}}" data-toggle="modal" data-target="#modalDelete">Hapus</button>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
</div>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Tambah Kelas & Wali Kelas</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" action="/add/data_kelas">
    @csrf
<div>
    <label class="form-label">Kelas</label>
    <input type="text" class="form-control" name="kelas" aria-describedby="KelasHelp" required>
</div>

<div>
    <label class="form-label">Wali Kelas</label>
    <input class="form-control" list="datalistOptions" name="guru" placeholder="Pilih Wali Kelas" required>
    <datalist id="datalistOptions">
        @foreach ($data['guru'] as $row)
            <option value="{{$row['nama']}}">
        @endforeach
    </datalist>
 </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas & Wali Kelas</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/edit/data_kelas">
        @csrf
        <input type="text" class="d-none" value="" id="editId" name="id">

        <div>
            <label for="exampleInputKelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="editKelas" name="kelas" aria-describedby="KelasHelp" required>
        </div>

        <div>
            <label class="form-label">Wali Kelas</label>
            <input class="form-control" list="datalistOptions" id="editGuru" name="guru" placeholder="Pilih Wali Kelas" required>
            <datalist id="datalistOptions">
                @foreach ($data['guru'] as $row)
                    <option value="{{$row['nama']}}">
                @endforeach
            </datalist>
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
      <form method="POST" action="/delete/data_kelas">
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
            document.getElementById('editKelas').value = this.dataset.kelas;
            document.getElementById('editGuru').value = this.dataset.guru;
        })
    }
</script>
