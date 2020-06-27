<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Proposalku as Authenticatable;

class datamahasiswa extends Model
{
    //
    public $table = "mhs_bimbingan";
    protected $primaryKey = 'id_mhs_bimbingan';
    
    protected $fillable = [
      'id_mhs_bimbingan',
      'id_pembimbing',
      'id',
      'id_proposal',
    ];
}