<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\APIModel;
use App\Models\MuridModel;

class DaftarModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_daftar';

    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'id_murid', 'id_api'];

    public function murid() {
        return $this->belongsTo(MuridModel::class, 'id_murid', 'id_murid');
    }

    public function kelas() {
        return $this->belongsTo(KelasModel::class, 'id_kelas', 'id_kelas');
    }

    public function api() {
        return $this->belongsTo(APIModel::class, 'id_api', 'id_api');
    }
}
