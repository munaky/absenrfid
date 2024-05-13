{{-- Style for dots in chart --}}
<style>
    .hadir{
        background-color: rgb(153, 255, 153);
    }
    .tidak-hadir{
        background-color: rgb(255, 153, 153);
    }
    .menu-button {
        background-color: #eee;
        border: none;
        padding: 10px;
        font-size: 14px;
        width: 100px;
        border-radius: 10px;
        color: #0A6EBD;
        cursor: pointer;
        border: 2px solid;
    }
    .menu-button:active {
        color: white;
        transform: translateY(2px);
    }
    .menu-button:hover:not(:disabled) {
        background: #0A6EBD;
        color: white;
    }
    .menu-button:disabled {
        cursor: auto;
        color: grey;
    }
</style>

@foreach ($data as $x)
    <button class="menu-button" onclick="idRuang = {{ $x->ruang->id_ruang }}"><b>{{ $x->ruang->nama }}</b></button>
@endforeach


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ruang <span id="ruang"></span></h1>
</div>

<div class="row g-4 align-items-center">
    {{-- Pie Chart --}}
    <div class="col-sm-6 col-xl-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Kehadiran</h5>
                <div class="col-12 mb-3">
                    <canvas id="lab"></canvas>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="position-relative d-inline">
                            <span class="position-absolute translate-middle-y top-50 p-2 hadir rounded-circle"></span>
                        </div>
                        <div class="d-inline ml-4">
                            Hadir : <span id="hadir"></span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="position-relative d-inline">
                            <span class="position-absolute translate-middle-y top-50 p-2 tidak-hadir rounded-circle"></span>
                        </div>
                        <div class="d-inline ml-4">
                            Tidak Hadir : <span id="tidakHadir"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Detail --}}
    <div class="col-sm-6 col-xl-6">
        <div class="row justify-content-center gy-4">
            <div class="col-xl-8">
                <div class="card border-left-info shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-info">
                                <strong>Mata Pelajaran</strong>
                            </div>
                            <div class="col" id="mapel">

                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-book fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card border-left-success shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-success">
                                <strong>Guru</strong>
                            </div>
                            <div class="col" id="guru">

                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-person-chalkboard fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card border-left-primary shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-primary">
                                <strong>Kelas</strong>
                            </div>
                            <div class="col" id="kelas">

                            </div>
                            <div class="col-auto">
                                <i class="fa fa-people-roof fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card border-left-danger shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-danger">
                                <strong>Jam Mata Pelajaran</strong>
                            </div>
                            <div class="col" id="durasi">

                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-clock fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <h5 class="card-title"><strong>Absensi</strong></h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Keluar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <table>

            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status Murid</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/edit/absensi">
        @csrf
        <input type="text" class="d-none" id="editId" name="id">

        <div class="form-group">
            <label for="sel1">Status Murid</label>
            <select class="form-control" name="status" required>
                <option class="d-none" disabled selected value="">--Pilih Status Murid--</option>
              <option>Hadir</option>
              <option>Tidak Hadir</option>
              <option>Izin</option>
              <option>Sakit</option>
            </select>
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

<script>
var lab = document.getElementById('lab');
var chart = null;
var kehadiran = [0, 0];
var idRuang = null;

async function getData(){
    fetch('/api/detail/ruang', {
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        },
        body: JSON.stringify({id_ruang : idRuang})
    })
    .then((response) => response.json())
    .then((data) => showData(data));
}

function showData(data){
    document.getElementById('ruang').innerHTML = data.nama;
    document.getElementById('mapel').innerHTML = data.mapel.mapel;
    document.getElementById('guru').innerHTML = data.guru.nama;
    document.getElementById('kelas').innerHTML = data.kelas.kelas;
    document.getElementById('durasi').innerHTML = data.durasi;

    updateChart(lab, data.nama, data.hadir, data.tidak_hadir);
    showTable(data.murid);
}

function showTable(data){
    let listMurid = '';

    for(let x = 0; x < data.length; x++){
        listMurid += muridRow(x + 1, data[x].id_absensi, data[x].murid.nama, data[x].tanggal, data[x].status, data[x].jam_masuk, data[x].jam_keluar);
    }

    document.querySelector('tbody').innerHTML = listMurid;

    btnFunction();
}

function muridRow(num, id, nama, tanggal, status, jamMasuk, jamKeluar){
    let color = 'table-warning';
    let colNum = `<td scope="row">${num}</td>`;
    let colNama = `<td scope="row">${nama}</td>`;
    let colTanggal = `<td scope="row">${tanggal}</td>`;
    let colStatus = `<td scope="row">${status}</td>`;
    let colJamMasuk = `<td scope="row">${jamMasuk}</td>`;
    let colJamKeluar = `<td scope="row">${jamKeluar}</td>`;
    let colAksi = `<td><button type="button" class="btn btn-primary btn-sm edit-btn" data-id="${id}" data-status="${status}" data-toggle="modal" data-target="#modalEdit">Edit</button></td>`;

    if(status == 'Hadir'){
        color = 'table-success';
    }
    else if(status == 'Tidak Hadir'){
        color = 'table-danger';
    }

    let fullRow = `<tr class="${color}">${colNum + colNama + colTanggal + colStatus + colJamMasuk + colJamKeluar + colAksi}</tr>`;

    return fullRow;
}

function updateChart(element, ruang, hadir, tidakHadir){
    if(kehadiran[0] == hadir && kehadiran[1] == tidakHadir){
        return;
    }

    kehadiran = [hadir, tidakHadir];
    document.getElementById('hadir').innerHTML = hadir;
    document.getElementById('tidakHadir').innerHTML = tidakHadir;

    if(chart){
        chart.destroy();
    }

    chart = new Chart(element, {
    type: "pie",
    data: {
        labels: [
            'Hadir',
            'Tidak Hadir'
        ],
        datasets: [{
            data: [hadir, tidakHadir],
            backgroundColor: [
            'rgb(153, 255, 153)',
            'rgb(255, 153, 153)'
            ],
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
        legend: {
            display: true
        },
        title: {
            display: true,
            text: ruang
        }
        }
    },
    });
}

function btnFunction(){
    var editbtn = document.getElementsByClassName('edit-btn');

    for(var x = 0; x < editbtn.length; x++){
        editbtn[x].addEventListener('click', function () {
            document.getElementById('editId').value = this.dataset.id;
        })
    }
}

getData();
setInterval(getData, 1000);
</script>
