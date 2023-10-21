<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;

use App\Models\Atendimento\Pessoa;

class LeadFila extends Model
{
    public $timestamps = false;

    protected $table      = 'com_leads_fila';
    protected $fillable   = [
        'proxima_pessoa',
    ];

    // RELACIONAMENTOS  ===========================================================================================
    public function nweliusadkwebjs()
    {
        return $this->hasOne(Lead::class, 'proxima_pessoa', 'id');
    }

}
