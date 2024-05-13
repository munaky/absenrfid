<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\AnyController;
use App\Models\APIModel;
use App\Models\MuridModel;
use App\Models\KelasModel;
use App\Models\DaftarModel;

class RFIDController extends Controller
{
    //
    public function selectMode(Request $request){
        info('controller RFIDController selectMode ----------');

        $token = $request->header('absenrfid_token');

        $counter = DB::update("UPDATE tb_api SET counter = counter + 1 WHERE token = '$token'");
        if($counter == 0){
            return response('Token Tidak Valid');
        }

        $mode = DB::table('api_mode')
            ->where('id', APIModel::where('token', $request->header('absenrfid_token'))->first()->api_mode_id)
            ->value('mode');

        if($mode == 'absen'){
            return self::absen($request);
        }
        else if($mode == 'daftar'){
            return self::daftar($request);
        }
        else{
            return response('false');
        }
    }

    public static function absen(Request $request){
        info('controller RFIDController absen ----------');

        $id_kartu = $request->input('id_kartu');
        $ruang = $request->input('ruang');
        $tanggal = date('Y/m/d');
        $jam = strtotime(date('H:i'));
        $hari = AnyController::DayToHari(date('D'));

        $dbRuang = DB::table('tb_ruang')->where('nama', $ruang)->get('id_ruang');
        if(count($dbRuang) == 0){
            return response()->json([
                'Ruang Tidak Valid'
            ]);
        }
        $id_ruang = $dbRuang[0]->id_ruang;

        $dbMurid = DB::table('tb_murid')->where('id_kartu', $id_kartu)->get();
        if(count($dbMurid) == 0){
            return response()->json([
                'ID Kartu Tidak Valid'
            ]);
        }
        $id_murid = $dbMurid[0]->id_murid;
        $nama_murid = $dbMurid[0]->nama;

        $dbAbsensi = DB::table('tb_absensi')->where([['id_murid', $id_murid], ['id_ruang', $id_ruang], ['tanggal', $tanggal]])->get();
        if(count($dbAbsensi) == 0){
            return response()->json([
                'Absensi Tidak Valid'
            ]);
        }
        $id_absensi = $dbAbsensi[0]->id_absensi;
        $id_mapel = $dbAbsensi[0]->id_mapel;
        $start = $dbAbsensi[0]->start;
        $end = $dbAbsensi[0]->end;

        $dbJampel = DB::table('tb_jampel')->where('hari', $hari)->get([$start, $end]);
        if(count($dbJampel) == 0){
            return response()->json([
                'Sekarang Weekend'
            ]);
        }

        $start = strtotime(json_decode($dbJampel[0]->$start, true)['start']);
        $end = strtotime(json_decode($dbJampel[0]->$end, true)['end']);

        if(empty($dbAbsensi[0]->jam_masuk) && $jam >= $start && $jam < $end){
            $absenMasuk = DB::table('tb_absensi')->where([['id_absensi', $id_absensi], ['id_murid', $id_murid], ['id_ruang', $id_ruang], ['id_mapel', $id_mapel], ['tanggal', $tanggal]])->update(['status' => 'Hadir', 'jam_masuk' => date('H:i')]);
            if($absenMasuk == 1){
                return response()->json([
                    'Anda Berhasil Absen Masuk',
                    $nama_murid
                ]);
            }
            else{
                return response()->json([
                    'Anda Gagal Absen Masuk'
                ]);
            }
        }
        else if(empty($dbAbsensi[0]->jam_keluar) && !empty($dbAbsensi[0]->jam_masuk) && $jam >= $end){
            $absenMasuk = DB::table('tb_absensi')->where([['id_absensi', $id_absensi], ['id_murid', $id_murid], ['id_ruang', $id_ruang], ['id_mapel', $id_mapel], ['tanggal', $tanggal]])->update(['jam_keluar' => date('H:i')]);
            if($absenMasuk == 1){
                return response()->json([
                    'Anda Berhasil Absen Keluar',
                    $nama_murid
                ]);
            }
            else{
                return response()->json([
                    'Anda Gagal Absen Keluar'
                ]);
            }
        }

        return response()->json([
            'Tidak Valid'
        ]);
    }

    public static function daftar(Request $request){
        info('controller RFIDController daftar ----------');

        $token = $request->header('absenrfid_token');
        $id_kartu = $request->input('id_kartu');

        $idCardExist = MuridModel::where('id_kartu', $id_kartu)->exists();
        if($idCardExist){
            return response()->json([
                'ID Kartu Sudah Terdaftar'
            ]);
        }

        $id_api = APIModel::where('token', $token)->first()->id_api;
        $firstId = DaftarModel::where([['terdaftar', 0], ['id_api', $id_api]])->first();
        info($firstId);
        if($firstId == null){
            return response()->json([
                'Tidak Ada Pendaftar'
            ]);
        }

        DaftarModel::where('id', $firstId->id)->update(['terdaftar' => 1]);
        MuridModel::where('id_murid', $firstId->id_murid)->update(['id_kartu' => $id_kartu]);

        $nama = MuridModel::where('id_murid', $firstId->id_murid)->first()->nama;

        return response()->json([
            'Anda Berhasil Terdaftar',
            $nama
        ]);
    }

    public function validToken(Request $request){
        info('controller RFIDController validToken ----------');

        $token = $request->header('absenrfid_token');

        $isValid = DB::table('tb_api')->where('token', $token)->get();
        if(count($isValid) != 1){
            return response('false');
        }

        return response('true');
    }
}
