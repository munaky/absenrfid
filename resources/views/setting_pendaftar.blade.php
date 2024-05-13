@php
    use App\Models\APIModel;
    $listAPI = APIModel::all();
@endphp

<div class="row align-items-center mb-3">

    <div class="col-5">
        Kelas
    </div>
    <div class="col-5">
        Jurusan
    </div>
    <div class="col-5">
        <div class="form-group m-0">
            <select class="form-select form-control" id="kelas">
                <option selected disabled class="d-none" value=" ">Pilih Kelas</option>
                <option>X</option>
                <option>XI</option>
                <option>XII</option>
              </select>
        </div>
    </div>
    <div class="col-5">
        <div class="form-group m-0">
            <select class="form-select form-control" id="jurusan">
                <option selected disabled class="d-none" value=" ">Pilih Jurusan</option>
                <option>TJKT 1</option>
                <option>TJKT 2</option>
                <option>TJKT 3</option>
                <option>TKJ 1</option>
                <option>TKJ 2</option>
                <option>TKJ 3</option>
              </select>
        </div>
    </div>

    <div class="col-auto">
        <div>
         <button type="button" class="btn btn-primary h-100" id="findBy">Find</button>
        </div>
    </div>

</div>
<button type="button" class="btn btn-primary btn-sm" id="daftar" data-toggle="modal" data-target="#exampleModal">
Daftar
</button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pendaftaran ID Murid</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form>
        <div class="form-group">
            <h6><b><i>*<span id="muridTerpilih">3</span> Murid Terpilih</i></b></h6>
            <label for="sel1">Nama API</label>
            <select class="form-control" id="pilihAPI">
                <option selected disabled class="d-none" value="">--Pilih API--</option>
                @foreach ($listAPI as $x)
                <option value="{{$x->id_api}}">{{$x->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update" data-dismiss="modal">Update</button>
    </div>
  </form>
</div>
</div>
</div>

<script>
var muridTerpilih = 0;
var list_check = document.getElementsByClassName('check');

document.getElementById('checkAll').onclick = function(){
    for(let x = 0; x < list_check.length; x++){
        list_check[x].checked = this.checked;
    }
}

document.getElementById('daftar').onclick = function(){
    checkedMurid();
    document.getElementById('muridTerpilih').innerHTML = muridTerpilih;
}

function checkedMurid(){
    muridTerpilih = 0;
    for(let x = 0; x < list_check.length; x++){
        if(list_check[x].checked == true){
            muridTerpilih += 1;
        }
    }
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

function rowOnClick(){
    var list_muridRow = document.querySelectorAll('tr');
    for(let x = 0; x < list_muridRow.length; x++){
        list_muridRow[x].onclick = function(){
            let check = this.querySelector('th .check');
            if(check.checked == true){
                check.checked = false;
                return;
            }
            check.checked = true;
        }
    }
}

function showTable(data){
    let listMurid = '';

    for(let x = 0; x < data.length; x++){
        listMurid += `
        <tr>
            <th><input type="checkbox" class="check" data-id="`+data[x].id_murid+`"></th>
            <th scope="row">`+(x + 1)+`</th>
            <td>`+data[x].id_kartu+`</td>
            <td>`+data[x].nama+`</td>
            <td>`+data[x].kelas.kelas+`</td>
        </tr>
        `
    }

    document.getElementById('table_murid').innerHTML = listMurid;

    rowOnClick();
    workingCheckbox();
}

document.getElementById('update').addEventListener('click', addPendaftar);

function addPendaftar(){
    let listMurid = [];
    let id_api = document.getElementById('pilihAPI').value;

    if(muridTerpilih == 0 || id_api == ""){
        return false;
    }

    for(let x = 0; x < list_check.length; x++){
        if(list_check[x].checked == true){
            listMurid.push(list_check[x].dataset.id);
        }
    }

    fetch('/api/add/pendaftar', {
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        },
        body: JSON.stringify({
            murid : listMurid,
            id_api : id_api
        })
    })
    .then(getTable);
}

document.getElementById('findBy').onclick = getTable;

async function getTable(){
    let kelas = document.getElementById('kelas').value + ' ' + document.getElementById('jurusan').value;

    fetch('/api/table/muridEmpty', {
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        },
        body: JSON.stringify({kelas : kelas})
    })
    .then((response) => response.json())
    .then((data) => showTable(data));
}
</script>
