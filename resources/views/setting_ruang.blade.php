@php
	use App\Models\KategoriRuangHas;
	use App\Models\KategoriRuang;
	$data = KategoriRuangHas::with('kategori_ruang', 'ruang')->get();
    $kategori = KategoriRuang::get();
    $index = 1;
@endphp

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Ruang</h1>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUser">
+ Tambah Ruang
</button>

{{-- Table Users --}}
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kategori</th>
        <th scope="col">Ruang</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $x)
            <tr>
                <th scope="row">@php
                    echo $index;
                    $index++;
                @endphp</th>
                <td>{{ $x->kategori_ruang->name }}</td>
                <td>{{ $x->ruang->nama }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-name="{{$x->ruang->nama}}" data-id="{{$x->id}}" data-ruangid="{{$x->ruang->id_ruang}}" data-toggle="modal" data-target="#editUser">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$x->id}}" data-ruangid="{{$x->ruang->id_ruang}}" data-toggle="modal" data-target="#deleteUser">Hapus</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Ruang</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/add/setting_ruang">
        @csrf

        <div class="form-group">
          <label for="sel1">Kategori Ruang</label>
          <select class="form-select form-control" name="kategori" id="pilihJurusan" required>
            <option class="d-none" selected disabled value="">-- Pilih Kategori Ruang --</option>
            @foreach($kategori as $x)
            <option value="{{ $x->id }}">{{ $x->name }}</option>
            @endforeach
          </select>
        </div>

       <div>
          <label for="exampleInputusername" class="form-label">Nama Ruang</label>
          <input type="text" class="form-control" name="name" id="exampleInputusername" placeholder="Enter Nama Ruang" aria-describedby="usernameHelp" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Ruang</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/edit/setting_ruang">
        @csrf
        <input type="text" class="d-none" value="" id="editId" name="id">
        <input type="text" class="d-none" value="" id="editRuangId" name="ruangId">

        <div class="form-group">
          <label>Kategori Ruang</label>
          <select class="form-control" id="editLevel" name="kategori" required>
            <option class="d-none" selected disabled value="">-- Pilih Kategori Ruang --</option>
            @foreach($kategori as $x)
            <option value="{{ $x->id }}">{{ $x->name }}</option>
            @endforeach
          </select>
        </div>

       <div>
          <label for="exampleInputusername" class="form-label">Nama Ruang</label>
          <input type="text" class="form-control" id="editName" name="name" aria-describedby="usernameHelp" required>
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
      <form method="POST" action="/delete/setting_ruang">
        @csrf
        <input type="text" class="d-none" value="" id="deleteId" name="id">
        <input type="text" class="d-none" value="" id="deleteRuangId" name="ruangId">
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
            document.getElementById('deleteRuangId').value = this.dataset.ruangid;
        })
    }
    
    for (var x = 0; x < editbtn.length; x++) {
  editbtn[x].addEventListener('click', function() {
    document.getElementById('editId').value = this.dataset.id;
    document.getElementById('editRuangId').value = this.dataset.ruangid;
    document.getElementById('editName').value = this.dataset.name;
  });
}
    


</script>

