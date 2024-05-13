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
use App\Models\RuangModel;
use App\Models\JampelModel;
use App\Models\AbsensiModel;

class APIGetController extends Controller
{
    public function dashboard(){
        $r1 = GetDataController::detailRuangPure(1);
        $r2 = GetDataController::detailRuangPure(2);
        $r3 = GetDataController::detailRuangPure(3);
        $r4 = GetDataController::detailRuangPure(4);
        $newAbsen = GetDataController::newestAbsensi(10);

        $data = ['chart' => [$r1, $r2, $r3, $r4], 'newAbsen' => $newAbsen];

        return response(json_encode($data));
    }

    public function detailRuang(Request $request){
        info('controller APIGetController detailRuang ----------');

        $id_ruang = $request->input('id_ruang');

        $relations = ['guru', 'mapel', 'kelas'];

        $data = RuangModel::with($relations)->where('id_ruang', $id_ruang)->get(['nama', 'id_guru', 'id_mapel', 'id_kelas', 'start', 'end'])->first();
        $dateNow = date('Y/m/d');
        $day = AnyController::DayToHari(date('D'));
        $start = json_decode(JampelModel::where('hari', $day)->value($data->start));
        $end = json_decode(JampelModel::where('hari', $day)->value($data->end));
        $data['durasi'] = $data->start . ' - ' . $data->end . ' ( ' . $start->start . ' - ' . $end->end . ' )';
        $data['hadir'] = AbsensiModel::where([['id_guru', $data->id_guru], ['id_mapel', $data->id_mapel], ['id_kelas', $data->id_kelas], ['id_ruang', $id_ruang], ['tanggal', $dateNow], ['start', $data->start], ['end', $data->end], ['status', 'Hadir']])->count();
        $data['tidak_hadir'] = AbsensiModel::where([['id_guru', $data->id_guru], ['id_mapel', $data->id_mapel], ['id_kelas', $data->id_kelas], ['id_ruang', $id_ruang], ['tanggal', $dateNow], ['start', $data->start], ['end', $data->end], ['status', 'Tidak Hadir']])->count();
        $data['murid'] = AbsensiModel::with('murid.kelas')->where([['id_guru', $data->id_guru], ['id_mapel', $data->id_mapel], ['id_kelas', $data->id_kelas], ['id_ruang', $id_ruang], ['tanggal', $dateNow], ['start', $data->start], ['end', $data->end]])->get();

        return response(json_encode($data));
    }

    public function tableMurid(Request $request){
        info('controller APIGetController tableMurid ----------');

        $kelas = $request->input('kelas');

        $pendaftarExist =  DaftarModel::select('id_murid')->pluck('id_murid')->all();

        if(isset($kelas)){
            $id_kelas = KelasModel::where('kelas', $kelas)->get();
            if(count($id_kelas) != 1){
                return response(['false']);
            }
            return MuridModel::with('kelas')->where('id_kelas', $id_kelas[0]->id_kelas)->get();
        }

        return MuridModel::with('kelas')->get();
    }

    public function tableMuridEmptyCard(Request $request){
        info('controller APIGetController tableMurid ----------');

        $kelas = $request->input('kelas');

        $pendaftarExist =  DaftarModel::select('id_murid')->pluck('id_murid')->all();

        if(isset($kelas)){
            $id_kelas = KelasModel::where('kelas', $kelas)->get();
            if(count($id_kelas) != 1){
                return response(['false']);
            }
            return MuridModel::with('kelas')->where([['id_kelas', $id_kelas[0]->id_kelas], ['id_kartu', '']])->whereNotIn('id_murid', $pendaftarExist)->get();
        }

        return MuridModel::with('kelas')->where('id_kartu', '')->whereNotIn('id_murid', $pendaftarExist)->get();

    }

    public function tablePendaftar(Request $request){
        info('controller APIGetController tablePendaftar ----------');

        $id_api = $request->input('id_api');
        $relation = ['murid.kelas', 'api', 'kelas'];

        if(isset($id_api)){
            $data = DaftarModel::with($relation)->where('id_api', $id_api)->get();
        }
        else{
            $data = DaftarModel::with($relation)->get();
        }

        return $data;
    }
}
