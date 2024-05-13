{{-- Custom Style --}}
<style>
    .hadir{
        background-color: rgb(153, 255, 153)
    }
    .tidak-hadir{
        background-color: rgb(255, 153, 153)
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

{{-- Pie Chart Lab 1 - 4 --}}
<div class="row g-4">
    <div class="col-sm-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" id="ruang"></h5>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="col-12 mb-3">
                            <canvas id="chart"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-6 align-self-center">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Hadir : <span id="hadir"></span>
                                </div>
                            </div>
                            <div class="col-12 align-self-center">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 tidak-hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Tidak Hadir : <span id="tidakHadir"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Kelas
                                </div>
                                <div class="col-md-8 text-right" id="kelas">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Guru
                                </div>
                                <div class="col-md-8 text-right" id="guru">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Mata Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="mapel">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Jam Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="durasi">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" id="ruang"></h5>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="col-12 mb-3">
                            <canvas id="chart"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-6 align-self-center">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Hadir : <span id="hadir"></span>
                                </div>
                            </div>
                            <div class="col-12 align-self-center">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 tidak-hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Tidak Hadir : <span id="tidakHadir"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Kelas
                                </div>
                                <div class="col-md-8 text-right" id="kelas">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Guru
                                </div>
                                <div class="col-md-8 text-right" id="guru">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Mata Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="mapel">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Jam Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="durasi">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" id="ruang"></h5>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="col-12 mb-3">
                            <canvas id="chart"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-6 align-self-center">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Hadir : <span id="hadir"></span>
                                </div>
                            </div>
                            <div class="col-12 align-self-center">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 tidak-hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Tidak Hadir : <span id="tidakHadir"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Kelas
                                </div>
                                <div class="col-md-8 text-right" id="kelas">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Guru
                                </div>
                                <div class="col-md-8 text-right" id="guru">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Mata Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="mapel">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Jam Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="durasi">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" id="ruang"></h5>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="col-12 mb-3">
                            <canvas id="chart"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-6 align-self-center">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Hadir : <span id="hadir"></span>
                                </div>
                            </div>
                            <div class="col-12 align-self-center">
                                <div class="position-relative d-inline">
                                    <span class="position-absolute translate-middle-y top-50 p-2 tidak-hadir rounded-circle"></span>
                                </div>
                                <div class="d-inline ml-4">
                                    Tidak Hadir : <span id="tidakHadir"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Kelas
                                </div>
                                <div class="col-md-8 text-right" id="kelas">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Guru
                                </div>
                                <div class="col-md-8 text-right" id="guru">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Mata Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="mapel">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="border border-primary rounded">
                            <div class="row p-2">
                                <div class="col-4">
                                    Jam Pelajaran
                                </div>
                                <div class="col-md-8 text-right" id="durasi">

                                </div>
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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Absensi Terbaru</strong></h5>
                <table class="table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="30%">Nama</th>
                            <th scope="col" width="10%">Kelas</th>
                            <th scope="col" width="10%">Tanggal</th>
                            <th scope="col" width="20%">Mapel</th>
                            <th scope="col" width="12.5%">Jam Masuk</th>
                            <th scope="col" width="12.5%">Jam Keluar</th>
                            <th scope="col" width="5%">Ruang</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
var ruangEl = document.querySelectorAll('#ruang');
var mapelEl = document.querySelectorAll('#mapel');
var guruEl = document.querySelectorAll('#guru');
var kelasEl = document.querySelectorAll('#kelas');
var durasiEl = document.querySelectorAll('#durasi');
var hadirEl = document.querySelectorAll('#hadir');
var tidakHadirEl = document.querySelectorAll('#tidakHadir');
var chartEl = document.querySelectorAll('#chart');
var chart = [null, null, null, null];
var kehadiran = [[0, 0], [0, 0], [0, 0], [0, 0]]

async function getData(){
    fetch('/api/dashboard')
    .then((response) => response.json())
    .then((data) => showData(data));
}

function showData(data){
    for(let x = 0; x < data.chart.length; x++){
        let y = data.chart[x];

        ruangEl[x].innerHTML = y.nama;
        mapelEl[x].innerHTML = y.mapel.mapel;
        guruEl[x].innerHTML = y.guru.nama;
        kelasEl[x].innerHTML = y.kelas.kelas;
        durasiEl[x].innerHTML = y.durasi;

        updateChart(x, chartEl[x], y.nama, y.hadir, y.tidak_hadir);
        showTable(data.newAbsen);
    }
}

function showTable(data){
    let listMurid = '';

    for(let x = 0; x < data.length; x++){
        listMurid += `
        <tr>
            <td scope="row">${data[x].murid.nama}</td>
            <td scope="row">${data[x].murid.kelas.kelas}</td>
            <td scope="row">${data[x].tanggal}</td>
            <td scope="row">${data[x].mapel.mapel}</td>
            <td scope="row">${data[x].jam_masuk}</td>
            <td scope="row">${data[x].jam_keluar}</td>
            <td scope="row">${data[x].ruang.nama}</td>
        </tr>
        `;
    }

    document.querySelector('tbody').innerHTML = listMurid;
}

function updateChart(index, element, ruang, hadir, tidakHadir){
    if(kehadiran[index][0] == hadir && kehadiran[index][1] == tidakHadir){
        return;
    }

    kehadiran[index] = [hadir, tidakHadir];
    hadirEl[index].innerHTML = hadir;
    tidakHadirEl[index].innerHTML = tidakHadir;

    if(chart[index]){
        chart[index].destroy();
    }

    chart[index] = new Chart(element, {
    type: "pie",
    data: {
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

getData();
setInterval(getData, 2000);
</script>
