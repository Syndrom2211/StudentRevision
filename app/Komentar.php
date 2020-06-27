<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Komentar as Authenticatable;

class komentar extends Model
{
    //
    public $table = "komentar_proposal";
    protected $primaryKey = 'id_komentar';
    
    protected $fillable = [
      'id_komentar',
      'id_proposal',
      'id_pembimbing',
      'teks_komentar',
      'kategori_komentar',
      'tgl_komentar',
    ];
}
