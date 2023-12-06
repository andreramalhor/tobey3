<?php

namespace App\Models\Configuracao;

use Illuminate\Database\Eloquent\Model;
use App\Models\Atendimento\Pessoa;
use App\Models\Cadastro\ServicoProduto;

class ColaboradasdsadorServico extends Model
{
  public $timestamps   = false;
  
  protected $primaryKey = 'id';
  // protected $primaryKey = ['id_profexec', 'id_servprod'];
  public $incrementing = false;
  
  protected $table      = 'cnf_colaborador_servico';
  protected $fillable   = [
    'id_profexec',
    'id_servprod',
    'prc_comissao',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function AtdPessoaServico()
  {
    return $this->belongsToMany(Pessoa::class, 'cnf_colaborador_servico', 'id', 'id_colaborador');
  }
  
  public function AtdServicoColaborador()
  {
    return $this->belongsToMany(ServicoProduto::class, 'cnf_colaborador_servico', 'id', 'id_servprod');
  }

// MÉTODOS          ===========================================================================================


// ATRIBUTOS        ===========================================================================================
}