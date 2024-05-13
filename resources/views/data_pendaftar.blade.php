@php
    use App\Models\APIModel;
    $listAPI = APIModel::all();
@endphp

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran</h1>
    </div>

<!-- Content Row -->

<!-- Button trigger modal -->
<div class="row align-items-center mb-3">
    <div class="col-md-3">
        <div class="form-group m-0">
            <select class="form-select form-control" id="pilihAPI">
                <option selected disabled class="d-none" value="">--Pilih API--</option>
                @foreach ($listAPI as $x)
                <option value="{{$x->id_api}}">{{$x->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div>
         <button type="button" class="btn btn-primary h-100" id="findBy">Find</button>
        </div>
    </div>
    <div class="col-auto">
        <div>
            <button type="button" class="btn btn-danger btn-sm" style="display:none" id="deleteAll" data-toggle="modal" data-target="#deleteModal">Hapus</button>
        </div>
    </div>
    <div class="col-auto align-self-end">
        <div>
            <input type="checkbox" class="btn-check realTime" id="btn-check-outlined" autocomplete="off">
            <label class="btn btn-outline-success m-0" for="btn-check-outlined">Real Time</label><br>
        </div>
    </div>


</div>

</div>

<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col" width="7.5%"><input type="checkbox" id="checkAll">   All</th>
        <th scope="col">No</th>
        <th scope="col">ID kartu</th>
        <th scope="col">Nama</th>
        <th scope="col">Kelas</th>
      </tr>
    </thead>
    <tbody id="table_murid">

    </tbody>
  </table>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">

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
var list_check = document.getElementsByClassName('check');
var autoUpdate = null

document.querySelector('.realTime').addEventListener('click', realTime);

function realTime(){
    let btn = document.querySelector('.realTime').checked;

    if(btn == true){
        autoUpdate = setInterval(getTable, 1000);
    }
    else{
        clearInterval(autoUpdate);
    }
}

function deleteAll(){
    for(let x = 0; x < list_check.length; x++){
        if(list_check[x].checked == true){
            document.getElementById('deleteAll').style.display = 'block';
            return
        }
    }
    document.getElementById('deleteAll').style.display = 'none';
}

function workingCheckbox(){
    for(let x = 0; x < list_check.length; x++){
        list_check[x].onclick = function(){
            if(this.checked == false){
                this.checked = true;
            }
            else{
                this.checked = false;
            }
        }
    }
}

document.getElementById('checkAll').onclick = function(){
    if(this.checked == false){
        document.getElementById('deleteAll').style.display = 'none';
    }
    else{
        document.getElementById('deleteAll').style.display = 'block';
    }

    for(let x = 0; x < list_check.length; x++){
        list_check[x].checked = this.checked;
    }
}

function rowOnClick(){
    var list_muridRow = document.querySelectorAll('tr');
    for(let x = 0; x < list_muridRow.length; x++){
        list_muridRow[x].onclick = function(){
            let check = this.querySelector('th .check');
            if(check.checked == true){
                check.checked = false;
            }
            else{
                check.checked = true;
            }
            deleteAll();
        }
    }
}

function showTable(data){
    console.log(data);
    let listMurid = '';

    for(let x = 0; x < data.length; x++){
        listMurid += `
        <tr>
            <th><input type="checkbox" class="check" data-id="`+data[x].id+`"></th>
            <th scope="row">`+(x + 1)+`</th>
            <td>`+data[x].murid.id_kartu+`</td>
            <td>`+data[x].murid.nama+`</td>
            <td>`+data[x].murid.kelas.kelas+`</td>
        </tr>
        `
    }

    document.getElementById('table_murid').innerHTML = listMurid;

    rowOnClick();
    workingCheckbox();
}

document.getElementById('findBy').onclick = getTable;

async function getTable(){
    let id_api = document.getElementById('pilihAPI').value

    fetch('/api/table/pendaftar', {
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        },
        body: JSON.stringify({id_api : id_api})
    })
    .then((response) => response.json())
    .then((data) => showTable(data));
}

document.getElementById('delete').addEventListener('click', deletePendaftar);

function deletePendaftar(){
    let listMurid = [];

    for(let x = 0; x < list_check.length; x++){
        if(list_check[x].checked == true){
            listMurid.push(list_check[x].dataset.id);
        }
    }

    fetch('/api/delete/pendaftar', {
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        },
        body: JSON.stringify({
            id_murid : listMurid,
        })
    })
    .then(getTable);
}

</script>
