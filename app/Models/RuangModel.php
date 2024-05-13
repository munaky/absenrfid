<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\GuruModel;
use App\Models\JampelModel;

class RuangModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_ruang';

    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_ruang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_ruang', 'nama', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'id_guru', 'id_mapel', 'id_kelas', 'start', 'end'];

    public function guru() {
        return $this->belongsTo(GuruModel::class, 'id_guru', 'id_guru');
    }

    public function mapel() {
        return $this->belongsTo(MapelModel::class, 'id_mapel', 'id_mapel');
    }

    public function kelas() {
        return $this->belongsTo(KelasModel::class, 'id_kelas', 'id_kelas');
    }
}
