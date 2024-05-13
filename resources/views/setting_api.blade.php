@php
    $data = App\Http\Controllers\GetDataController::getApi();
@endphp

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data API</h1>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd">
+ Tambah Token
</button>
<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
  <tr>
    <th scope="col" width="35%">Nama</th>
    <th scope="col" width="30%">Token</th>
    <th scope="col" width="10%">Counter</th>
    <th scope="col" width="5%">Mode</th>
    <th scope="col" width="20%">Aksi</th>
  </tr>
</thead>
<tbody>
    @foreach ($data as $row)
    <tr>
        <td>{{$row['nama']}}</td>
        <td>{{$row['token']}}</td>
        <td>{{$row['counter']}}</td>
        <td>{{ucfirst($row['api_mode']['mode'])}}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="{{$row['id_api']}}" data-nama="{{$row['nama']}}" data-mode="{{ucfirst($row['api_mode']['mode'])}}" data-toggle="modal" data-target="#modalEdit">Edit</button>
            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$row['id_api']}}" data-toggle="modal" data-target="#modalDelete">Hapus</button>
        </td>
      </tr>
    @endforeach
</tbody>
</table>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/add/setting_api">
                @csrf
                    <div>
                        <label for="validationCustom03" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter Nama" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="/edit/setting_api">
            @csrf
            <input type="text" class="d-none" value="" id="editId" name="id">
                <div>
                    <label for="validationCustom03" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="editNama" placeholder="Enter Nama" required>
                </div>
                <div class="form-group">
                    <label>Mode</label>
                    <select class="form-select form-control" id="editMode" name="api_mode_id" required>
                        <option selected disabled value="" class="d-none">--Pilih Mode--</option>
                        <option value="0">Off</option>
                        <option value="1">Absen</option>
                        <option value="2">Daftar</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/delete/setting_api">
                @csrf
                <input type="text" class="d-none" value="" id="deleteId" name="id">

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

            let mode = document.querySelectorAll('#editMode option');
            for(let x = 0; x < mode.length; x++){
                if(mode[x].innerHTML == this.dataset.mode){
                    document.getElementById('editMode').selectedIndex = x;
                    break;
                }
            }
        })
    }
</script>
