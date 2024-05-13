@php
    $mainData = App\Http\Controllers\GetDataController::getUsers();
    $index = 1;
@endphp

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data User</h1>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUser">
+ Tambah User
</button>

{{-- Table Users --}}
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Level</th>
        <th scope="col">Username</th>
        <th scope="col">Password</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($mainData as $row)
            <tr>
                <th scope="row">@php
                    echo $index;
                    $index++;
                @endphp</th>
                <td>{{$row['nama']}}</td>
                <td>{{ucfirst($row['level'])}}</td>
                <td>{{$row['username']}}</td>
                <td>{{$row['password']}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-nama="{{$row['nama']}}" data-level="{{$row['level']}}" data-username="{{$row['username']}}" data-password="{{$row['password']}}" data-userid="{{$row['id_user']}}" data-toggle="modal" data-target="#editUser">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-userid="{{$row['id_user']}}" data-toggle="modal" data-target="#deleteUser">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

<!-- Modal Add -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/add/data_users">
        @csrf

        <div>
            <label for="exampleInputNama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleInputNama" placeholder="Enter Nama" aria-describedby="NamaHelp" required>
        </div>

        <div class="form-group">
          <label for="sel1">Level</label>
          <select class="form-select form-control" name="level" id="pilihJurusan" required>
            <option class="d-none" selected disabled value="">Level User</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
          </select>
        </div>

       <div>
          <label for="exampleInputusername" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="exampleInputusername" placeholder="Enter Username" aria-describedby="usernameHelp" required>
       </div>


      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" required>
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
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/edit/data_users">
        @csrf
        <input type="text" class="d-none" value="" id="editId" name="editId">

        <div>
            <label for="exampleInputNama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="editNama" name="editNama" aria-describedby="NamaHelp" required>
        </div>

        <div class="form-group">
          <label>Level</label>
          <select class="form-control" id="editLevel" name="editLevel" required>
            <option class="d-none" selected disabled value="">Pilih Level User</option>
            <option>Admin</option>
            <option>Guru</option>
          </select>
        </div>

       <div>
          <label for="exampleInputusername" class="form-label">Username</label>
          <input type="text" class="form-control" id="editUsername" name="editUsername" aria-describedby="usernameHelp" required>
       </div>


      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="editPassword" name="editPassword" required>
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
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/delete/data_users">
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
            document.getElementById('deleteId').value = this.dataset.userid;
        })
    }
    for(var x = 0; x < editbtn.length; x++){
        editbtn[x].addEventListener('click', function () {
            document.getElementById('editId').value = this.dataset.userid;
            document.getElementById('editNama').value = this.dataset.nama;
            document.getElementById('editUsername').value = this.dataset.username;
            document.getElementById('editPassword').value = this.dataset.password;

            if(this.dataset.level == 'admin'){
                document.getElementById('editLevel').selectedIndex = 1;
            }
            else if(this.dataset.level == 'guru'){
                document.getElementById('editLevel').selectedIndex = 2;
            }
        })
    }


</script>
