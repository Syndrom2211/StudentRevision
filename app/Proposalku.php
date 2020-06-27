<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Proposalku as Authenticatable;

class proposalku extends Model
{
    //
    public $table = "dokumen_proposals";
    protected $primaryKey = 'id_proposal';
    
    protected $fillable = [
      'id_proposal',
      'id_mahasiswa',
      'nama_dokumen',
      'tipe_dokumen',
      'link_dokumen',
      'keterangan',
      'updated_at',
      'created_at',
    ];
}
