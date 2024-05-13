<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\APIModel;
use App\Models\GuruModel;
use App\Models\KelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MuridModel;
use App\Models\RuangModel;
use App\Models\KategoriRuangHas;

class EditDataController extends Controller
{
    //

    public function editUser(Request $request){
        info('controller EditDataController editUSer ----------');

        $validated = $request->validate([
            'editId' => 'required|exists:tb_users,id_user',
            'editNama' => 'required',
            'editLevel' => 'required|in:Admin,Guru',
            'editPassword' => 'required',
        ]);

        $id = $request->input('editId');
        $nama = $request->input('editNama');
        $level = strtolower($request->input('editLevel'));
        $username = $request->input('editUsername');
        $password = $request->input('editPassword');

        DB::table('tb_users')->where('id_user', $id)->update(['nama' => $nama, 'level' => $level, 'username' => $username, 'password' => $password]);

        return redirect('/data_users');
    }

    public function editMurid(Request $request){
        info('controller EditDataController editMurid ----------');

        $data = $request->except('_token');

        if($data['id_kartu'] != ''){
            $idKartuExist = MuridModel::where('id_kartu', $data['id_kartu'])->exists();

            if($idKartuExist){
                return response(json_encode(['false', 'ID Kartu Sudah Terdaftar']));
            }
        }
        else{
            $data['id_kartu'] = '';
        }

        MuridModel::find($data['id_murid'])->update($data);

        return response(json_encode(['true', 'Data Berhasil Di Update']));
    }

    public function editKelas(Request $request){
        info('controller EditDataController editKelas ----------');

        $validated = $request->validate([
            'kelas' => 'required',
            'guru' => 'required|exists:tb_guru,nama'
        ]);

        $id = $request->input('id');
        $kelas = $request->input('kelas');
        $guru = $request->input('guru');
        $id_guru = DB::table('tb_guru')->where('nama', $guru)->get('id_guru');

        KelasModel::find($id)->update(['kelas' => $kelas, 'id_guru' => $id_guru[0]->id_guru]);

        return back()->with('success', 'Data Berhasil Diupdate');
    }

    public function editGuru(Request $request){
        info('controller EditDataController editGuru ----------');

        $validated = $request->validate([
            'id' => 'required|exists:tb_guru,id_guru',
            'nama' => 'required',
            'mapel' => 'required|exists:tb_mapel,mapel'
        ]);

        $id = $request->input('id');
        $nama = $request->input('nama');
        $mapel = $request->input('mapel');
        $id_mapel = '';

        foreach($mapel as $x){
            $dbMapel = DB::table('tb_mapel')->where('mapel', $x)->get('id_mapel');
            $id_mapel .= $dbMapel[0]->id_mapel . '|';
        }

        GuruModel::find($id)->update(['nama' => $nama, 'id_mapel' => $id_mapel]);

        return back()->with('success', 'Data Berhasil Diupdate');
    }

    public function editJadwalPelajaran(Request $request){
        info('controller EditDataController editJadwalPelajaran ----------');

        $validated = $request->validate([
            'ruang' => 'required|exists:tb_ruang,nama',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat',
            'start' => 'required|min:1|max:13',
            'end' => 'required|min:1|max:13',
            'guru' => 'required|exists:tb_guru,nama',
            'mapel' => 'required|exists:tb_mapel,mapel',
            'kelas' => 'required|exists:tb_kelas,kelas'
        ]);


        $namaRuang = $request->input('ruang');
        $hari = $request->input('hari');
        $start = $request->input('start');
        $end = $request->input('end');
        $guru = $request->input('guru');
        $mapel = $request->input('mapel');
        $kelas = $request->input('kelas');

        $id_ruang = DB::table('tb_ruang')->where('nama', $namaRuang)->get('id_ruang')[0]->id_ruang;
        $id_guru = DB::table('tb_guru')->where('nama', $guru)->get('id_guru')[0]->id_guru;
        $id_mapel = DB::table('tb_mapel')->where('mapel', $mapel)->get('id_mapel')[0]->id_mapel;
        $id_kelas = DB::table('tb_kelas')->where('kelas', $kelas)->get('id_kelas')[0]->id_kelas;

        $dbJadwal = DB::table('tb_ruang')->where('id_ruang', $id_ruang)->get($hari)[0]->$hari;
        $jadwal = json_decode($dbJadwal, true);

        foreach($jadwal as $x => $valx){
            if($x >= $start && $x <= $end){
                $jadwal[$x]['jadwal_masuk'] = $start;
                $jadwal[$x]['jadwal_keluar'] = $end;
                $jadwal[$x]['id_guru'] = $id_guru;
                $jadwal[$x]['id_mapel'] = $id_mapel;
                $jadwal[$x]['id_kelas'] = $id_kelas;
            }
        }

        DB::table('tb_ruang')->where('id_ruang', $id_ruang)->update([$hari => json_encode($jadwal)]);

        return back()->with('success', 'Data Berhasil Diupdate');
    }

    public function editAbsensi(Request $request){
        info('controller EditDataController editAbsensi ----------');

        $validated = $request->validate([
            'id' => 'required|exists:tb_absensi,id_absensi',
            'status' => 'required|in:Hadir,Tidak Hadir,Izin,Sakit',
        ]);

        $id = $request->input('id');
        $status = $request->input('status');

        AbsensiModel::find($id)->update(['status' => $status]);

        return back()->with('success', 'Data Berhasil Diupdate');
    }

    public function editApi(Request $request){
        info('controller EditDataController editApi ----------');

        $validated = $request->validate([
            'id' => 'required|exists:tb_api,id_api',
            'nama' => 'required',
            'api_mode_id' => 'required|exists:api_mode,id'
        ]);

        $id = $request->input('id');
        $nama = $request->input('nama');
        $api_mode_id = $request->input('api_mode_id');

        APIModel::find($id)->update(['nama' => $nama, 'api_mode_id' => $api_mode_id]);

        return back()->with('success', 'Data Berhasil Diupdate');
    }
    
    public function editRuang(Request $request){
        info('controller EditDataController editRuang ----------');

        $validated = $request->validate([
            'id' => 'required',
            'ruangId' => 'required',
            'name' => 'required',
            'kategori' => 'required'
        ]);

        $input = $request->all();

        RuangModel::where('id_ruang', $input['ruangId'])->update(['nama' => $input['name']]);
        KategoriRuangHas::where('id', $input['id'])->update(['kategori_ruang_id' => $input['kategori']]);

        return back()->with('success', 'Data Berhasil Diupdate');
    }
}
