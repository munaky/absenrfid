<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRuangHas extends Model
{
    use HasFactory;

    protected $table = 'kategori_ruang_has';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['kategori_ruang_id', 'tb_ruang_id'];

    public function ruang(){
        return $this->hasOne(RuangModel::class, 'id_ruang');
    }

    public function kategori_ruang(){
        return $this->belongsTo(KategoriRuang::class);
    }
}
