<?php

namespace App\Models\Configuracao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

class Mensagem extends Model
{
  use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados
  public $timestamps   = true;

  protected $table      = 'cfg_mensages';
  protected $fillable   = [
    'id_empresa',
    'area',
    'mensagem',
  ];
  protected $appends = [
    'testemsg',
  ];

// RELACIONAMENTOS  ===========================================================================================
public function setMensagemAttribute($value)
{
  $mensagem = str_replace('&nbsp;', '', $value);
  $mensagem = str_replace('<br>', '%0A', $mensagem);
  $mensagem = str_replace('<div>', '', $mensagem);
  $mensagem = str_replace('</div>', '', $mensagem);
  $mensagem = str_replace('<p>', '%0A', $mensagem);
  $mensagem = str_replace('</p>', '%0A', $mensagem);
  $mensagem = str_replace('<b>', '*', $mensagem);
  $mensagem = str_replace('</b>', '*', $mensagem);
  $mensagem = str_replace('<i>', '_', $mensagem);
  $mensagem = str_replace('</i>', '_', $mensagem);
  
  $this->attributes['mensagem'] = strip_tags($mensagem);
}

public function getTestemsgAttribute()
{
  return $this->attributes['mensagem'];
}

public function getMensagemAttribute($value)
{
  $mensagem = str_replace('%0A', '<br>', $value);
  // $mensagem = str_replace('',      '<div>',    $mensagem);
  // $mensagem = str_replace('',      '</div>',   $mensagem);
  // $mensagem = str_replace('%0A',   '<p>',      $mensagem);
  // $mensagem = str_replace('%0A',   '</p>',     $mensagem);
  // $mensagem = str_replace('*',     '<b>',      $mensagem);
  // $mensagem = str_replace('*',     '</b>',     $mensagem);
  // $mensagem = str_replace('_',     '<i>',      $mensagem);
  // $mensagem = str_replace('_',     '</i>',     $mensagem);
  // $mensagem = str_replace('~',     '<u>',      $mensagem);
  // $mensagem = str_replace('~',     '</u>',     $mensagem);

  $count = substr_count($mensagem, '*'); // Conta o número de asteriscos (*)
  $contador = 0; // Inicializa um contador
  
  // Percorre o texto substituindo os asteriscos por <b> ou </b>
  $mensagem = preg_replace_callback('/\*/', function($match) use (&$contador)
  {
    $contador++; // Incrementa o contador
    if ($contador % 2 === 0)
    {
      return '</b>'; // Substitui por </b> se o contador for par
    }
    else
    {
      return '<b>'; // Substitui por <b> se o contador for ímpar
    }
  }, $mensagem);



  $count = substr_count($mensagem, '_'); // Conta o número de underline (_)
  $contador = 0; // Inicializa um contador
  
  // Percorre o texto substituindo os underline por <i> ou </i>
  $mensagem = preg_replace_callback('/\_/', function($match) use (&$contador)
  {
    $contador++; // Incrementa o contador
    if ($contador % 2 === 0)
    {
      return '</i>'; // Substitui por </i> se o contador for par
    }
    else
    {
      return '<i>'; // Substitui por <i> se o contador for ímpar
    }
  }, $mensagem);


  
  return $mensagem;
}

// MÉTODOS          ===========================================================================================
public function teste()
{
  return 12911;
}


// ATRIBUTOS        ===========================================================================================
}