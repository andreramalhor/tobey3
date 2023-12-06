<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\Pedagogico\Turma;
// use App\Models\pivots\ColaboradorServico as ColabServ;

class LeadTurma extends Model
{
	public $timestamps = false;

    protected $primaryKey = 'id';
    protected $table      = 'com_leads_turmas';
    protected $fillable   = [
        'id_lead',
        'cod_turma',
    ];
    protected $appends = [
        // 'nomes',
    ];

    // // RELACIONAMENTOS  ===========================================================================================
    public function asjfeiemwerfewr()
    {
      return $this->hasOne(Turma::class, 'cod', 'cod_turma')->withTrashed();
    }

    // // MUTATORS         ===========================================================================================
    // public function getTellinkAttribute()
    // {
    //     return $this->ddd.preg_replace("/[^0-9]/", "",$this->telefone);;
    // }
}
