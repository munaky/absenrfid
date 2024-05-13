<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FilterDataController;
use App\Models\MuridModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\UsersModel;
use App\Models\APIModel;
use App\Models\RuangModel;
use App\Models\KategoriRuangHas;

class DeleteDataController extends Controller
{
    //

    public function deleteUser(Request $request){
        info('controller DeleteDataController deleteUser ----------');

        $id = $request->input('deleteId');

        UsersModel::find($id)->delete();

        return redirect('/data_users');
    }

    public function deleteMurid(Request $request){
        info('controller DeleteDataController deleteMurid ----------');

        $id = $request->all()['id'];

        MuridModel::find($id)->delete();

        return response()->json(['true', 'Data Berhasil Dihapus']);
    }
    public function deleteKelas(Request $request){
        info('controller DeleteDataController deleteKelas ----------');

        $validated = $request->validate([
            'deleteId' => 'required|exists:tb_kelas,id_kelas'
        ]);

        $id = $request->input('deleteId');

        KelasModel::find($id)->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function deleteGuru(Request $request){
        info('controller DeleteDataController deleteGuru ----------');

        $validated = $request->validate([
            'deleteId' => 'required|exists:tb_guru,id_guru'
        ]);

        $id = $request->input('deleteId');

        GuruModel::find($id)->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function deleteApi(Request $request){
        info('controller DeleteDataController deleteApi ----------');

        $validated = $request->validate([
            'id' => 'required|exists:tb_api,id_api'
        ]);

        $id = $request->input('id');

        APIModel::find($id)->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
    
    public function deleteRuang(Request $request){
        info('controller DeleteDataController deleteApi ----------');

        $validated = $request->validate([
            'id' => 'required',
            'ruangId' => 'required'
        ]);

        $input = $request->all();

	KategoriRuangHas::find($input['id'])->delete();
        RuangModel::find($input['ruangId'])->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
