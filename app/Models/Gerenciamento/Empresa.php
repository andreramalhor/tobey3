<?php

namespace App\Models\Gerenciamento;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

class Empresa extends Model
{
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps    = false;
  protected $table      = 'ger_empresa';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id',
    'nome',
    'razao_social',
    'cnpj',
    'rua',
    'numero',
    'complemento',
    'bairro',
    'cidade',
    'uf',
    'cep',
    'telefone_fixo',
    'celular_comercial1',
    'celular_comercial2',
    'celular_financeiro',
    'celular_pedagogico',
    'celular_modelos',
    'email',
    'site',
    'facebook',
    'instagram',
    'lightwidget',
    'mapa',
    'horario_segunda',
  ];
  protected $appends = [
    'whatsapp',
  ];

// ================================================================================================================= RELACIONAMENTOS
  
public function getEnderecoAttribute()
{
  return $this->rua.','.$this->numero.' - Bairro: '.$this->bairro.'.</br>'.$this->cidade.'/'.$this->uf;
}
// ================================================================================================================= MÉTODOS
  public function getWhatsappAttribute()
  {
      $remove_espacos     = str_replace(" ", "", $this->celular_comercial1);
      $remove_parenteses1 = str_replace("(", "", $remove_espacos);
      $remove_parenteses2 = str_replace(")", "", $remove_parenteses1);
      $remove_tracos      = str_replace("-", "", $remove_parenteses2);

      return "https://api.whatsapp.com/send?phone=55".$remove_tracos;
  }

// ================================================================================================================= ATRIBUTOS (Nomes)

}
