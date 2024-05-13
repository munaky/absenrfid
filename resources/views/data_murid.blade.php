@php
    use App\Models\KelasModel;
    $kelas = KelasModel::all();
    $index = 1;
@endphp

<div id="validateAlert"></div>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Murid</h1>
</div>

<div class="row align-items-center mb-3">
    <div class="col-md-5">
        <label>Kelas</label>
        <div class="form-group m-0">
            <select class="form-select form-control" id="kelas">
                <option class="d-none" value="" disabled selected>Pilih Kelas</option>
                <option>X</option>
                <option>XI</option>
                <option>XII</option>
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <label>Jurusan</label>
        <div class="form-group m-0">
            <select class="form-select form-control" id="jurusan">
                <option class="d-none" value="" disabled selected>Pilih Jurusan</option>
                <option>TJKT 1</option>
                <option>TJKT 2</option>
                <option>TJKT 3</option>
                <option>TKJ 1</option>
                <option>TKJ 2</option>
                <option>TKJ 3</option>
            </select>
        </div>
    </div>

    <div class="col-md-auto align-self-end mt-2">
        <div>
            <button type="submit" class="btn btn-primary h-100" id="findBy">Find</button>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahData">
    + Tambah
</button>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID kartu</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<!-- Modal Add -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Murid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div>
                        <label for="exampleInputnama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="addNama" name="nama"
                            placeholder="Enter Nama Murid" required>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-select form-control" id="addKelas" name="id_kelas" required>
                            <option selected disabled value="" class="d-none">--Pilih Kelas--</option>
                            @foreach ($kelas as $x)
                                <option value="{{ $x->id_kelas }}">{{ $x->kelas }}</option>
                            @endforeach
                        </select>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="add">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Murid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <input type="text" class="d-none" value="" id="editId" name="id_murid">

                    <div>
                        <label for="exampleInputusername" class="form-label">Id Kartu</label>
                        <input type="text" class="form-control" id="editIdKartu" name="id_kartu" required>
                    </div>

                    <div>
                        <label for="exampleInputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama"required>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-select form-control" id="editKelas" name="id_kelas" required>
                            <option selected disabled value="">--Pilih Kelas--</option>
                            @foreach ($kelas as $x)
                                <option value="{{ $x->id_kelas }}">{{ $x->kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update"
                        data-dismiss="modal">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="d-none" value="" id="deleteId">
                <div>
                    Apakah yakin ingin menghapus Data Tersebut??
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('findBy').onclick = getTable;
    document.getElementById('add').addEventListener('click', addData);
    document.getElementById('delete').addEventListener('click', deleteData);
    document.getElementById('update').addEventListener('click', updateData);

    async function getTable() {
        let kelas = document.getElementById('kelas').value + ' ' + document.getElementById('jurusan').value;

        fetch('/api/table/murid', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    kelas: kelas
                })
            })
            .then((response) => response.json())
            .then((data) => showTable(data));
    }

    function showTable(data) {
        let listMurid = '';

        for (let x = 0; x < data.length; x++) {
            listMurid += `
        <tr>
            <th scope="row">` + (x + 1) + `</th>
            <td>` + data[x].id_kartu + `</td>
            <td>` + data[x].nama + `</td>
            <td>` + data[x].kelas.kelas + `</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="` + data[x].id_murid +
                `" data-kelas="` + data[x].kelas.kelas + `" data-kartu="` + data[x].id_kartu + `" data-nama="` + data[x]
                .nama + `" data-toggle="modal" data-target="#modalEdit">Edit</button>
                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="` + data[x].id_murid + `" data-toggle="modal" data-target="#modalDelete">Hapus</button>
            </td>
        </tr>
        `
        }

        document.querySelector('tbody').innerHTML = listMurid;

        btnFunction();
    }

    async function addData() {
        let nama = document.getElementById('addNama').value;
        let id_kelas = document.getElementById('addKelas').value;

        if (nama == '' || id_kelas == '') {
            validateResult(['false', 'Semua Field Harus Diisi']);
            return;
        }

        await fetch('/add/data_murid', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    nama: nama,
                    id_kelas: id_kelas
                })
            })
            .then(function(response) {
                let statusCode = response.status;
                if (response.status != 200) {
                    validateResult(['false', 'Error : ' + statusCode]);
                    return;
                }

                response.json().then(function(data) {
                    console.log(data);
                    validateResult(data);
                    getTable();
                })
            });
    }

    function updateData() {
        let id = document.getElementById('editId').value;
        let id_kartu = document.getElementById('editIdKartu').value;
        let nama = document.getElementById('editNama').value;
        let id_kelas = document.getElementById('editKelas').value;

        if (nama == '' || id_kelas == '') {
            validateResult(['false', 'Field Nama dan Kelas Harus Diisi']);
            return;
        }

        fetch('/edit/data_murid', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    id_murid: id,
                    id_kartu: id_kartu,
                    nama: nama,
                    id_kelas: id_kelas
                })
            })
            .then(function(response) {
                let statusCode = response.status;
                if (response.status != 200) {
                    validateResult(['false', 'Error : ' + statusCode]);
                    return;
                }

                response.json().then(function(data) {
                    console.log(data);
                    validateResult(data);
                    getTable();
                })
            });
    }

    function validateResult(data) {
        let alertClass = 'alert-success';
        if (data[0] == "false") {
            alertClass = 'alert-danger';
        }
        document.querySelector('#validateAlert').innerHTML += `
    <div class="position-fixed top-0 start-50 translate-middle-x alert ${alertClass} alert-dismissible fade show" style="margin-top: 50px; z-index: 1090;" role="alert">
        ${data[1]}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    `;
    }

    function deleteData() {
        let id = document.getElementById('deleteId').value;

        fetch('/delete/data_murid', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    id: id
                })
            })
            .then(function(response) {
                let statusCode = response.status;
                if (response.status != 200) {
                    validateResult(['false', 'Error : ' + statusCode]);
                    return;
                }

                response.json().then(function(data) {
                    console.log(data);
                    validateResult(data);
                    getTable();
                })
            });
    }

    function btnFunction() {
        var editbtn = document.getElementsByClassName('edit-btn');
        var delbtn = document.getElementsByClassName('delete-btn');

        for (var x = 0; x < delbtn.length; x++) {
            delbtn[x].addEventListener('click', function() {
                document.getElementById('deleteId').value = this.dataset.id;
            })
        }

        for (var x = 0; x < editbtn.length; x++) {
            editbtn[x].addEventListener('click', function() {
                document.getElementById('editId').value = this.dataset.id;
                document.getElementById('editIdKartu').value = this.dataset.kartu;
                document.getElementById('editNama').value = this.dataset.nama;

                let kelas = document.querySelectorAll('#editKelas option');
                for (let x = 0; x < kelas.length; x++) {
                    if (kelas[x].innerHTML == this.dataset.kelas) {
                        document.getElementById('editKelas').selectedIndex = x;
                        break;
                    }
                }

            })
        }
    }
</script>
