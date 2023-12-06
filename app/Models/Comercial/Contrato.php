<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Pedagogico\Curso;
use App\Models\Pedagogico\Turma;
use App\Models\Atendimento\Pessoa;
// use App\Models\pivots\ColaboradorServico as ColabServ;

class Contrato extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'id';
  protected $table      = 'com_contratos';
  protected $fillable   = [
    'cod_contrato', 
    'id_consultor', 
    'dt_cadastro', 
    'id_origem', 
    'id_aluno', 
    'id_responsavel_legal', 
    'id_responsavel_financeiro', 
    'id_curso', 
    'id_turma', 
    'taxa_matricula', 
    'qtd_parcelas', 
    'vlr_bru_curso', 
    'porcentagem_descon', 
    'vlr_liq_curso', 
    'vlr_pri_parcela', 
    'status', 
    'dt_cancelamento', 
    'dt_trancamento', 
  ];
  protected $appends = [
  ];

// RELACIONAMENTOS  ===========================================================================================
public function qoneqweqwoepqwe()
{
  return $this->hasMany(LeadConversa::class, 'id_lead', 'id')->withTrashed();
}

public function rtyyvaqazxgdssf()
{
  return $this->hasOne(Turma::class, 'cod', 'id_turma')->withTrashed();
}

public function sfwmfkmrbeesfsd()
{
  return $this->hasMany(LeadTurma::class, 'id_lead', 'id');
}

public function lskdfjweklwejrq()
{
  return $this->hasOne(Pessoa::class, 'id', 'id_consultor');
}

public function uqbchiwyagnnkip()
{
  return $this->hasMany(PessoaEndereco::class, 'id_pessoa', 'id');
}

public function ginthgfwxbdhwtu()
{
  return $this->hasMany(PessoaContato::class, 'id_pessoa', 'id');
}

public function AISTFGWBXGRRHER()
{
  return $this->hasMany(FuncaoPessoa::class, 'id_pessoa', 'id');
}

public function aistggwbdgrrher()
{
  return $this->belongsToMany(Tipo_de_Pessoa::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
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

public function setTelefoneAttribute($value)
{
  $telefone = str_replace(' ', '', str_replace('-', '', str_replace('+', '', $value)));
  
  switch (strlen($telefone))
  {
    case 8:
      $this->attributes['telefone'] = '339' . $telefone;
    break;
    
    case 9:
      $this->attributes['telefone'] = '33' . $telefone;
    break;
    
    case 13:
      $this->attributes['telefone'] = substr_replace($telefone, '', 0, 2);
    break;
    
    default:
      $this->attributes['telefone'] = $telefone;
    break;
  }
}

public function getNomesAttribute()
{
  return $this->nome.' | '.$this->apelido;
}

public function getLinkWhatsappAttribute()
{
  return "https://api.whatsapp.com/send?phone=55".preg_replace("/[^0-9]/", "",$this->telefone ?? 0000000);
}

public function getColorStatusAttribute()
{
  switch ($this->status)
  {
    case 'entrada_lead':
      return 'warning';
    break;
    
    case 'apresentacao_curso':
      return 'info';
    break;
      
    case 'proposta_enviada':
      return 'success';
    break;

    case 'negociando_venda':
      return 'secondary';
    break;

    case 'cancelado':
      return 'danger';
    break;
      
    case 'Ganho':
      return 'Verde';
    break;

    default:
      return 'default';
    break;
  }
}

public function getColorInteresseAttribute()
{
  switch ($this->interesse)
  {
    case 'frio':
      return 'border-left-color: #3c8dbc;';
    break;
    
    case 'morno':
      return 'border-left-color: #ff851b';
    break;
    
    case 'quente':
      return 'border-left-color: #dc3545';
    break;
    
    default:
      return 'border-left-color: white';
    break;
  }
}

public function getBadgeStatusAttribute()
{
  switch ($this->status)
  {
    case 'entrada_lead':
      return '<span class="badge bg-info">Entrada do Lead</span>';
    break;
    
    case 'apresentacao_curso':
      return '<span class="badge bg-primary">Apresentação do Curso</span>';
    break;
    
    case 'proposta_enviada':
      return '<span class="badge bg-secondary">Proposta Enviada</span>';
    break;
    
    case 'negociando_venda':
      return '<span class="badge bg-dark">Negociando</span>';
    break;
    
    default:
      return '<span class="badge bg-warning">Warning</span>';
    break;
  }
}

public function getBadgeInteresseAttribute()
{
  switch ($this->interesse)
  {
    case 'frio':
      return '<span class="badge bg-dark p-1" style="background-color: #3c8dbc !important;"><i style="width: 12px; font-size: 12px !important;" class="fa-solid fa-snowflake"></i></span>';
    break;
    
    case 'morno':
      return '<span class="badge bg-dark p-1" style="background-color: #ff851b !important;"><i style="width: 12px; font-size: 12px !important;" class="fa-solid fa-temperature-half"></i></span>';
    break;
    
    case 'quente':
      return '<span class="badge bg-dark p-1" style="background-color: #dc3545 !important;"><i style="width: 12px; font-size: 12px !important;" class="fa-brands fa-hotjar"></i></span>';
    break;
    
    
    default:
      return '<span class="badge bg-dark p-1"><i style="width: 12px; font-size: 12px !important;" class="fa-solid fa-snowflake"></i></span>';
    break;
  }
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

public function getOrigemAttribute()
{
  switch ($this->id_origem)
  {
    case 1 :
      return 'Assistente';
    break;
    
    case 2 :
      return 'Telemarketing';
    break;
    
    case 3 :
      return 'Consultor Externo';
    break;
    
    case 4 :
      return 'Panfletos';
    break;
    
    case 5 :
      return 'Mala Direta';
    break;
    
    case 6 :
      return 'Book Fotográfico';
    break;
    
    case 7 :
      return 'Campanha de Indicação';
    break;
    
    case 8 :
      return 'Renovações';
    break;
    
    case 9 :
      return 'Corporativo';
    break;
    
    case 10:
      return 'Visitas Antigas';
    break;
    
    case 11:
      return 'Compre e Aplique';
    break;
    
    case 12:
      return 'TV';
    break;
    
    case 13:
      return 'Jornal';
    break;
    
    case 14:
      return 'Outdoor';
    break;

    case 15:
      return 'Cartaz';
    break;

    case 16:
      return 'Faixa';
    break;

    case 17:
      return 'Muro';
    break;

    case 18:
      return 'Carro de Som';
    break;

    case 19:
      return 'Indicação Espontânea';
    break;

    case 20:
      return 'Fachada';
    break;

    case 21:
      return 'Internet/Site';
    break;

    case 22:
      return 'Lista Telefônica';
    break;

    case 23:
      return 'Outros';
    break;

    case 24:
      return 'Rádio';
    break;

    case 25:
      return 'Facebook';
    break;

    case 26:
      return 'Google';
    break;

    case 27:
      return 'Site da Franquia';
    break;

    case 28:
      return 'SMS';
    break;

    case 29:
      return 'Bing';
    break;

    case 30:
      return 'Instagram';
    break;

    case 31:
      return 'Yahoo';
    break;

    case 32:
      return 'Twitter';
    break;

    case 33:
      return 'Outlook';
    break;

    case 34:
      return 'Vendas Online';
    break;

    case 35:
      return 'Recebimento de Transferência';
    break;

    case 36:
      return 'WhatsApp';
    break;

    case 38:
      return 'Modelo';
    break;

    case 39:
      return 'Revista';
    break;

    case 40:
      return 'Workshop';
    break;

    case 41:
      return 'BusDoor';
    break;

    case 42:
      return 'E-Mail Marketing';
    break;

    case 43:
      return 'Parceria Prefeitura';
    break;

    case 104:
      return 'Indicação de Ex-Aluno';
    break;

    case 987:
      return 'Facebook Lucas';
    break;

    default:
      return $this->id_origem.'ERRO NA INFORMCAO';
    break;
  }

}

}
