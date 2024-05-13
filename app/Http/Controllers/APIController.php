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

class APIController extends Controller
{
    public function addPendaftar(Request $request){
        info('controller APIController tableMurid ----------');

        $listMurid = $request->input('murid');
        $id_api = $request->input('id_api');
        $data = array();

        foreach($listMurid as $x){
            if(!DaftarModel::where('id_murid', $x)->exists()){
                array_push($data, ['id_murid' => $x, 'id_api' => $id_api]);
            }
        }

        APIModel::where('id_api', $id_api)->update(['api_mode_id' => 2]);
        DaftarModel::insert($data);

        return response(['true']);
    }

    public function deletePendaftar(Request $request){
        info('controller APIController deletePendaftar ----------');

        $id_murid = $request->input('id_murid');

        DaftarModel::whereIn('id', $id_murid)->delete();
    }
}
