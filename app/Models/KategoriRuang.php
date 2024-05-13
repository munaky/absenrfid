<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRuang extends Model
{
    use HasFactory;

    protected $table = 'kategori_ruang';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['name'];
}
