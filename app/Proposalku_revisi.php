<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Proposalku_revisi as Authenticatable;

class proposalku_revisi extends Model
{
    //
    public $table = "dokumen_proposals_revisi";
    protected $primaryKey = 'id_revisi';
    
    protected $fillable = [
      'id_revisi',
      'id_proposal',
      'id_mahasiswa',
      'nama_dokumen',
      'tipe_dokumen',
      'link_dokumen',
      'catatan_pembimbing',
      'updated_at',
      'created_at',
    ];
}
