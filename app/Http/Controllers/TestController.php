<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //

    public static function importMuridFromDB(){
        $kelas = 'XII TKJ 3';
        $data = array();

        $dbMurid = DB::table('siswa')->where('kelas', $kelas)->get();
        if(count($dbMurid) <=25){
            info('database murid yang ditemukan kurang dari 30 siswa');
            return false;
        }

        $id_kelas = DB::table('tb_kelas')->where('kelas', $kelas)->get('id_kelas');
        if(count($id_kelas) != 1){
            info('id_kelas bedasarkan kelas tidak bisa ditemukan di database');
            return false;
        }

        foreach($dbMurid as $x){
            array_push($data, array('id_kelas' => $id_kelas[0]->id_kelas, 'nama' => $x->nama, 'id_kartu' => ""));
        }

        DB::table('tb_murid')->insert($data);
        return true;
    }
}
