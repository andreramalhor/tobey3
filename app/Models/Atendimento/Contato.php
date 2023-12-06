<?php

namespace App\Models\Atendimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Contato extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'id';
  protected $table      = 'atd_contatos_site';
  protected $fillable   = [
    'nome',
    'empresa',
    'email',
    'telefone',
    'mensagem',
  ];
  protected $appends = [
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function HGVQZCNFXWFQJUE()
  {
    return $this->hasOne(Pessoa::class, 'id','id_criador')->withTrashed();
  }

  public function uqbchiwyagnnkip()
  {
    return $this->hasMany(PessoaEndereco::class, 'id_pessoa', 'id');
  }

  public function ginthgfwxbdhwtu()
  {
    return $this->hasMany(PessoaContato::class, 'id_pessoa', 'id');
  }

  public function lcldxgfwmrzybmm()
  {
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

  public function xlwznisvhoqjqpx()
  {
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

  public function GXTPCCEEPNAOMKC()
  {
    return $this->hasMany(Comanda::class, 'id_pessoa', 'id');
  }

  public function aeahvtsijjoprlc()
  {
    return $this->hasMany(ColaboradorServico::class, 'id_profexec', 'id');
  }

  public function iemzmwadhadlask()
  {
    return $this->hasMany(Agendamento::class, 'id_cliente', 'id');
  }

  public function ATD_Pessoas_Agendamentos_Profissioanis()
  {
    return $this->hasMany(Agendamento::class, 'id_profexec', 'id');
  }

  public function GXTPCCEEPNAOMKCDetalhes()
  {
    // dd($this->hasManyThrough(
    //   ComandaDetalhe::class,        // Model Alvo
    //   Comanda::class,               // Model Através
    //   'id_cliente',                 // Chave estrangeira na model Através ...
    //   'id_comanda',                 // Chave estrangeira na model Alvo...
    //   '33333333',                         // Chave principal na model que estou...
    //   'id')->toSql());
    return $this->hasManyThrough(
      ComandaDetalhe::class,        // Model Alvo
      Comanda::class,               // Model Através
      'id_cliente',                 // Chave estrangeira na model Através ...
      'id_comanda',                 // Chave estrangeira na model Alvo...
      'id',                         // Chave principal na model que estou...
      'id');                // Chave principal na model Através...
  }

  public function eidwuedoeduzdsd()
  {
    // dd($this->hasManyThrough(
    //   ComandaDetalhe::class,        // Model Alvo
    //   Comanda::class,               // Model Através
    //   'id_cliente',                 // Chave estrangeira na model Através ...
    //   'id_comanda',                 // Chave estrangeira na model Alvo...
    //   '33333333',                         // Chave principal na model que estou...
    //   'id')->toSql());
    return $this->hasManyThrough(
      VendaDetalhe::class,        // Model Alvo
      Venda::class,               // Model Através
      'id_cliente',                 // Chave estrangeira na model Através ...
      'id_venda',                  // Chave estrangeira na model Alvo...
      'id',                         // Chave principal na model que estou...
      'id');                // Chave principal na model Através...
  }

  public function ATD_Pessoas_Possui_Caixa()
  {
    return $this->hasMany(Caixa::class, 'id_usuario_abertura', 'id');
  }

  public function EsseProfissinalFazEQuaisServicosComQualComissao()
  {
    dd('s');
    return $this->hasMany(ColabServ::class, 'id_profexec', 'id')->withPivot(['executa', 'prc_comissao']);
  }

  public function opmnhtrvanmesd()
  {
    return $this->hasMany(ContaInterna::class, 'id_pessoa', 'id');
  }

// MUTATORS         ===========================================================================================
  public function setNomeAttribute($value)
  {
    $this->attributes['nome'] = ucwords(trim($value));
  }

  public function getCpfCnpjAttribute($value)
  {
  return true;
  }
  public function setApelidoAttribute($value)
  {
    $this->attributes['apelido'] = ucwords(trim($value));
  }

  public function getNomesAttribute()
  {
    return $this->nome.' | '.$this->apelido;
  }

  public function getLabelCpfCnpjAttribute()
  {
    if( $this->cpf == "" )
    {
      return 'CPF/CNPJ';
    }
    if( strlen($this->cpf) <= 11 )
    {
      return 'CPF';
    }
    else
    {
      return 'CNPJ';
    }
  }

  function mask($val, $mask)
  {
      $maskared = '';
      $k = 0;
      for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
          if ($mask[$i] == '#') {
              if (isset($val[$k])) {
                  $maskared .= $val[$k++];
              }
          } else {
              if (isset($mask[$i])) {
                  $maskared .= $mask[$i];
              }
          }
      }

      return $maskared;
  }

  public function getNascimentoAttribute()
  {
    if ( !is_null($this->dt_nascimento) AND Carbon::parse($this->dt_nascimento)->age > 99 )
    {
      return Carbon::parse($this->dt_nascimento)->format('d/m');
    }
    else if ( !is_null($this->dt_nascimento))
    {
      return Carbon::parse($this->dt_nascimento)->format('d/m/Y').' ('.Carbon::parse($this->dt_nascimento)->age.' anos)';
    }
    return null;
  }

  public function getFotoPerfilAttribute()
  {
    if(file_exists(public_path('/img/atendimentos/pessoas/'.$this->id.'.png')))
    {
      return asset('/img/atendimentos/pessoas/'.$this->id.'.png');
    }
    else
    {
      return asset('/img/atendimentos/pessoas/0.png');
    }
  }

  public function getFotoTabelaAttribute()
  {
    if(file_exists(public_path('/img/atendimentos/pessoas/'.$this->id.'.png')))
    {
      return '<img src="'.asset('/img/atendimentos/pessoas/'.$this->id.'.png').'" class="img-circle" alt="User Image" width="25px">';
    }
    else
    {
      return '<img src="'.asset('/img/atendimentos/pessoas/0.png').'" class="img-circle" alt="User Image" width="25px">';
    }
  }

  public function getEnderecoPrincipalAttribute()
  {
    if ( !is_null($this->uqbchiwyagnnkip->first()) )
    {
      if ($this->uqbchiwyagnnkip->first()->complemento == '')
      {
        return 'Rua '.$this->uqbchiwyagnnkip->first()->logradouro.', '.$this->uqbchiwyagnnkip->first()->numero.' - '.$this->uqbchiwyagnnkip->first()->bairro.' - '.$this->uqbchiwyagnnkip->first()->cidade.'/'.$this->uqbchiwyagnnkip->first()->uf;
      }
      return 'Rua '.$this->uqbchiwyagnnkip->first()->logradouro.', '.$this->uqbchiwyagnnkip->first()->numero.' ('.$this->uqbchiwyagnnkip->first()->complemento.') - '.$this->uqbchiwyagnnkip->first()->bairro.' - '.$this->uqbchiwyagnnkip->first()->cidade.'/'.$this->uqbchiwyagnnkip->first()->uf;
    }
    else
    {
      return 'Sem Endereços cadastrados.';
    }
  }

  public function getWhatsappAttribute()
  {
    if( !is_null($this->ginthgfwxbdhwtu->where('whatsapp', 1)->first()) )
    {
      $remove_espaco = str_replace(" ", "", $this->ginthgfwxbdhwtu->where('whatsapp', true)->first()->ddd.$this->ginthgfwxbdhwtu->where('whatsapp', true)->first()->telefone);
      $remove_traco  = str_replace("-", "", $remove_espaco);
      return $remove_traco;
    }
  }

  public function getSaldoContaAttribute()
  {

    return $this->opmnhtrvanmesd->where('status', '=', 'Em Aberto')->sum('valor');
    // return $this->AtdPessoasContatos->where('principal', 1)->first()['ddd'] . $this->AtdPessoasContatos->where('principal', 1)->first()['numero'];
  }

}
