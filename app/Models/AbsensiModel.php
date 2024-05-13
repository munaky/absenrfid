<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GuruModel;
use App\Models\RuangModel;
use App\Models\KelasModel;
use App\Models\MuridModel;
use App\Models\MapelModel;

class AbsensiModel extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_absensi';

    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_absensi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_absensi', 'id_murid', 'id_guru', 'id_mapel', 'id_kelas', 'id_ruang', 'jam_masuk', 'jam_keluar', 'status', 'tanggal', 'start', 'end'];

    public function murid() {
        return $this->belongsTo(MuridModel::class, 'id_murid', 'id_murid');
    }

    public function kelas() {
        return $this->belongsTo(KelasModel::class, 'id_kelas', 'id_kelas');
    }

    public function guru() {
        return $this->belongsTo(GuruModel::class, 'id_guru', 'id_guru');
    }

    public function mapel() {
        return $this->belongsTo(MapelModel::class, 'id_mapel', 'id_mapel');
    }

    public function ruang() {
        return $this->belongsTo(RuangModel::class, 'id_ruang', 'id_ruang');
    }
}
