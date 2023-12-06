<?php

namespace App\Models\pivots;

use Illuminate\Database\Eloquent\Model;

use App\Models\Atendimento\Pessoa;
use App\Models\Cadastro\ServicoProduto;

class ColaboradorServico extends Model
{
  protected $primaryKey = 'id';
  // public $incrementing = false;
  public $timestamps   = false;

  protected $table = 'cnf_colaborador_servico';
  protected $fillable = [
    'id_profexec',
    'id_servprod',
    'prc_comissao',
  ];

  // RELACIONAMENTOS  ===========================================================================================
  public function dwsdjqwqwekowqe()
  {
    return $this->belongsTo(Pessoa::class, 'id_profexec', 'id')->withTrashed();
  }
  
  public function aslqmpqwplspiry()
  {
    return $this->belongsTo(ServicoProduto::class, 'id_servprod', 'id');    
  }

}
