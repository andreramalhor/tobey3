<?php

namespace App\Models\Atendimento;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Atendimento\PessoaTipo;
use App\Models\Atendimento\PessoaCliente;
use App\Models\Atendimento\PessoaEquipe;
use App\Models\Atendimento\AgendaOrdem;
use App\Models\ACL\FuncaoPessoa;
use App\Models\ACL\Funcao;
use App\Models\Cadastro\ServicoProduto;
use App\Models\Configuracao\Tipo_de_Pessoa;
use App\Models\Ferramenta\Tarefa;
use App\Models\PDV\Caixa;
use App\Models\PDV\Comanda;
use App\Models\PDV\ComandaDetalhe;
use App\Models\pivots\ColaboradorServico;
use App\Models\PDV\Venda;
use App\Models\PDV\VendaDetalhe;
use App\Models\Gerenciamento\Empresa;
use App\Models\Financeiro\ContaInterna;
use App\Models\ACL\Permissao;
use App\Models\Comercial\Lead;
use App\Models\Comercial\Portfolio;
use App\Models\User as Usuario;

class Pessoa extends Authenticatable
{
  use SoftDeletes;

  protected $table      = 'atd_pessoas';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_empresa',
    'apelido',
    'nome',
    'dt_nascimento',
    'email',
    'sexo',
    'cpf',
    'instagram',
    'observacao',
    'id_criador',
    'ddd',
    'telefone',
    'cep',
    'logradouro',
    'numero',
    'bairro',
    'cidade',
    'uf',
  ];
  protected $appends = [
    // 'nomes',
    // 'foto_tabela',
    // 'whatsapp',
    // 'endereco_principal',
    // 'nascimento',
    // 'saldo_conta',
    // 'ultimo_agendamento',
    // 'cpf_cnpj',
    // 'src_foto',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function hgvqzcnfxwfqjue()
  {
    return $this->hasOne(Pessoa::class, 'id','id_criador')->withTrashed();
  }

  public function klwqejqlkwndwiqo()
  {
    return $this->hasOne(Empresa::class, 'id','id_empresa');
  }

  public function kjahdkwkbewtoip()
  {
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

  public function wuclsoqsdppaxmf()
  {
    return $this->hasManyThrough(
      Funcao::class,                // Model Alvo
      FuncaoPessoa::class,          // Model Através
      'id_pessoa',                  // Chave estrangeira na model Através ...
      'id',                         // Chave estrangeira na model Alvo...
      'id',                         // Chave principal na model que estou...
      'id_funcao');                 // Chave principal na model Através...
  }

  public function lcldxgfwmrzybmm()
  {
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

  public function xlwznisvhoqjqpx()
  {
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

  public function gxtisamceedomas()
  {
    return $this->hasMany(Venda::class, 'id_cliente', 'id');
  }

  public function aeahvtsijjoprlc()
  {
    return $this->hasMany(ColaboradorServico::class, 'id_profexec', 'id');
  }

  public function kehfywbcsqalfpw()
  {
    return $this->hasManyThrough(
      ServicoProduto::class,
      ColaboradorServico::class,
      'id_profexec',
      'id',
      'id',
      'id_servprod');
  }

  public function abcde()
  {
    return $this->hasMany(Caixa::class, 'id_usuario_abertura', 'id')->where('dt_abertura', '>=', \Carbon\Carbon::today())->where('status', '=', 'Aberto');
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

  public function opmnhtrvanmesd()
  {
    return $this->hasMany(ContaInterna::class, 'id_pessoa', 'id');
  }

  public function ATD_Pessoa_Usuario()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id');
  }

  public function ACL_Pessoa_Funcao()
  {
    // dd('ACL_Pessoa_Funcao');
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

  public function ktykrtasd1lrfdf()
  {
    return $this->hasMany(PessoaCliente::class, 'id_cliente', 'id');
  }

  public function fjowenfsiasdwqe()
  {
    return $this->hasMany(Tarefa::class, 'id_responsavel', 'id');
  }

  public function eoprtjweornweuq()
  {
    return $this->belongsTo(Usuario::class, 'id', 'id');
  }

  public function jlwjilwjldsdslf()
  {
    // return $this->belongsTo(Pessoa::class, 'atd_pessoas_clientes', 'id_pessoa', 'id_cliente');
    return $this->hasManyThrough(
      Pessoa::class,                // Model Final
      PessoaCliente::class,         // Model Meio
      'id_pessoa',                  // Chave estrangeira na model Meio ...
      'id',                         // Chave principal na model Final ...
      'id',                         // Chave principal na model que estou ...
      'id_cliente');                // Chave principal na model Meio ...
  }

  public function aslfenvkvuelkds()
  {
    return $this->hasOne(AgendaOrdem::class, 'id_pessoa', 'id');
  }

  public function flkejfoeiasldjp()
  {
    return $this->hasMany(Portfolio::class, 'id_pessoa', 'id');
  }

  public function sakljqekliwuwef()
  {
    return $this->hasMany(Lead::class, 'id_pessoa', 'id')->orderBy('updated_at', 'asc');
  }

  public function ksdjflsksdjkdjs()
  {
    return $this->hasMany(Lead::class, 'id_pessoa', 'id')->where('id_consultor', '=', auth()->user()->id)->orderBy('updated_at', 'asc');
  }

  public function paernvsdfjweimf()
  {
    return $this->hasManyThrough(
      Pessoa::class,                // Model Final
      PessoaEquipe::class,          // Model Meio
      'id_omega',                   // Chave estrangeira na model Meio ...
      'id',                         // Chave principal na model Final ...
      'id',                         // Chave principal na model que estou ...
      'id_alpha');                  // Chave principal na model Meio ...
  }

  public function fiiffdiosfusenf()
  {
    return $this->hasMany(PessoaEquipe::class, 'id_alpha', 'id');
  }

  public static function empresas()
  {
    return Pessoa::whereHas('wuclsoqsdppaxmf', function(Builder $query)
    {
      $query->where('nome', '=','Cliente');
    });
  }

  public static function vendedores()
  {
    return Pessoa::whereHas('wuclsoqsdppaxmf', function(Builder $query)
    {
      $query->where('nome', '=','Vendedor');
    });
  }

  public static function colaboradores()
  {
    return Pessoa::whereHas('wuclsoqsdppaxmf', function(Builder $query)
    {
      $query->where('nome', '=','Colaborador');
    });
  }

  public static function minhas_empresas()
  {
    $minhas_empresas = Pessoa::find(auth()->user()->id)->jlwjilwjldsdslf();

    return $minhas_empresas;
  }

  public static function meus_leads()
  {
    $meus_leads = Pessoa::
      whereHas('sakljqekliwuwef', function(Builder $query)
      {
        $query->where('id_consultor', '=', auth()->user()->id);
      });

    return $meus_leads;
  }

// MUTATORS         ===========================================================================================
  public function getEnderecoAttribute()
  {
    if($this->logradouro != null || $this->bairro != null)
    {
      return $this->logradouro.', '.$this->numero.' - Bairro: '.$this->bairro.'. '.$this->cidade.'/'.$this->uf;
    }
  }

  public function getFoneAttribute()
  {
    if($this->ddd != null || $this->bairro != null)
    {
      return '('.$this->ddd.') '.$this->telefone;
    }
  }

  public function setNomeAttribute($value)
  {
    $this->attributes['nome'] = ucwords(strtolower($value));
  }

  // public function setIdEmpresaAttribute($value)
  // {
  //   $this->attributes['id_empresa'] = $value->klwqejqlkwndwiqo->id;
  // }

  // public function getIdEmpresaAttribute($value)
  // {
  //   return $value->klwqejqlkwndwiqo->id;
  // }

  public function getCpfCnpjAttribute($value)
  {
    return true;
  }

  public function setApelidoAttribute($value)
  {
    $this->attributes['apelido'] = ucwords(strtolower($value));
  }

  public function getNomesAttribute()
  {
    return "{$this->apelido} | {$this->nome}";
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

  public function getFotoTabelaAttribute()
  {
    if(file_exists(public_path('/img/atendimentos/pessoas/'.$this->id.'.png')))
    {
      return '<img src="'.asset('/img/atendimentos/pessoas/'.$this->id.'.png').'" class="img-circle" alt="'.$this->apelido.'" width="25px">';
    }
    else
    {
      return '<img src="'.asset('/img/atendimentos/pessoas/0.png').'" class="img-circle" alt="'.$this->apelido.'" width="25px">';
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
  // FUNÇÕES          ===========================================================================================
  public function adminlte_image()
  {
    return asset('/img/atendimentos/pessoas/'.$this->id.'.png');
  // return 'https://picsum.photos/300/300';
  }

  public function adminlte_desc()
  {
    return '';
    // return 'That\'s a nice guy';
  }

  public function adminlte_profile_url()
  {
    return route('atd.pessoas.mostrar', $this->id);
  }

  public function getdiaDesdeUltimaVendaAttribute()
  {
    if ($this->gxtisamceedomas->count() > 0)
    {
      return \Carbon\Carbon::parse(optional($this->gxtisamceedomas)->sortBy('created_at')->last()->created_at)->diff(\Carbon\Carbon::today())->format('%d');
    }
    else
    {
      return null;
    }

  }

  public function getdiaDesdeUltimaVendaColorAttribute()
  {
    $dias_perc = $this->dia_desde_ultima_venda / 90 * 100;

    if ($dias_perc >= 0 && $dias_perc < 33.34)
    {
      return 'green';
    }
    elseif ($dias_perc >= 33.34 && $dias_perc < 66.667)
    {
      return 'yellow';
    }
    else
    {
      return 'red';
    }
  }

  public function getdiaDesdeUltimoAgendamentoAttribute()
  {
    if ($this->iemzmwadhadlask->count() > 0)
    {
      return \Carbon\Carbon::parse(optional($this->iemzmwadhadlask)->sortBy('start')->first()->start)->format('d/m/Y');
    }
    else
    {
      return null;
    }
  }

  public function getultimoAgendamentoAttribute()
  {
    if ($this->iemzmwadhadlask->count() > 0)
    {
      return \Carbon\Carbon::parse(optional($this->iemzmwadhadlask)->sortByDesc('start')->first()->start);
    }
  }

  public function getfrequenciaAgendamentosAttribute()
  {
    if ($this->iemzmwadhadlask->count() > 0)
    {
      $datas_agendamentos = $this->iemzmwadhadlask()
                                ->whereDate('start', '<=', Carbon::now())
                                ->selectRaw('DATE(start) as dia')
                                ->groupBy('dia')
                                ->get();

      $dados['agendamentos_group_dias'] = collect();

      foreach ($datas_agendamentos as $item)
      {
        $registros = $this->iemzmwadhadlask()
                          ->whereRaw('DATE(start) = ?', [$item->dia])
                          ->get();

        $dados['agendamentos_group_dias']->push($registros);
      }

      $dados['quantidade'] = $dados['agendamentos_group_dias']->count();

      if ($dados['quantidade'] > 1)
      {
        $dados['data_primeiro'] = $dados['agendamentos_group_dias']->first()->first()->start;
        $dados['data_ultimo']   = $dados['agendamentos_group_dias']->last()->last()->start;
        $dados['intervalos']    = $dados['agendamentos_group_dias']->count() - 1;
        $dados['tempo_entre']   = \Carbon\Carbon::parse($dados['data_primeiro'])->diffInDays($dados['data_ultimo']);
        $dados['frequencia']    = $dados['tempo_entre'] / $dados['intervalos'];
      }
      else
      {
        $dados['agendamentos_group_dias'] = 1;
        $dados['quantidade']    = 1;
        $dados['data_primeiro'] = \Carbon\Carbon::parse($this->iemzmwadhadlask->first()->start);
        $dados['data_ultimo']   = \Carbon\Carbon::today()->addDays(1);
        $dados['intervalos']    = 1;
        $dados['tempo_entre']   = \Carbon\Carbon::parse($dados['data_primeiro'])->diffInDays($dados['data_ultimo']);
        $dados['frequencia']    = $dados['tempo_entre'] / $dados['intervalos'];
        $dados['color']         = 'grey';
      }

      if ($dados['frequencia'] >= 0 && $dados['frequencia'] < 15)
      {
        $dados['color']       = 'green';
      }
      elseif ($dados['frequencia'] >= 15 && $dados['frequencia'] < 30)
      {
        $dados['color']       = 'yellow';
      }
      else
      {
        $dados['color']       = 'red';
      }
    }
    else
    {
      $dados['agendamentos_group_dias'] = 0;
      $dados['quantidade']    = 0;
      $dados['data_primeiro'] = \Carbon\Carbon::today();
      $dados['data_ultimo']   = \Carbon\Carbon::today();
      $dados['intervalos']    = 0;
      $dados['tempo_entre']   = 0;
      $dados['frequencia']    = 0;
      $dados['color']         = 'grey';
    }

    return $dados;
  }

  // AUXILIARES              ===========================================================================================
  public static function procurar($pesquisa)
  {
    return empty($pesquisa)
    ? static::query()
    : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
                     ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
  }

  // ACL              ===========================================================================================

  public function vincauladoAoFuncao(PessoaEquipe $funcoes)
  {
    dd('vincauladoAoFuncao');
    if( is_array() || is_object() )
    {
      foreach ($funcoes as $key => $funcao)
      {
        return $this->funcoes->contains('nome', $funcao->nome);
      }
    }
    return $this->funcoes->contains('nome', $funcoes);
  }

  // public function isAdminSistema($admin)    // O Gate verifica, antes de tudo, se possui Tipo 'Administrador do Sistema'
  // {
  //   return $this->AtdPessoasTipos->contains('nome', $admin);
  // }



  // O Gate verifica permissão por permissão na hora de saber se possui o daquele item que ele pretende entrar
  public function temPermissao(Permissao $permissao)
  {
    // dd('temPermissao', $permissao);
    return $this->pacoteFuncao($permissao->dzjvxinawjwtnfa);
  }

  public function pacoteFuncao($funcoes)
  {
    // dd('pacoteFuncao', $funcoes);
    if( is_array($funcoes) || is_object($funcoes) )
    {
      return !! $funcoes->intersect($this->ACL_Pessoa_Funcao)->count();
    }
    return $this->ACL_Pessoa_Funcao->contains('nome', $funcoes);
  }

  public function isAdminSistema($admin)
  {
    // dd('isAdminSistema', $admin);
    return $this->ACL_Pessoa_Funcao->contains('nome', $admin);
  }

  public function temFuncao($funcao)
  {
    // dd('temFuncao', $funcao);
    return $this->ACL_Pessoa_Funcao->contains('nome', $funcao);
  }

  function getlinkIdAttribute()
  {
    return '<a class="link-dark text-decoration-underline" onclick="pessoas_mostrar('.$this->id.')" style="cursor: pointer;">'.$this->id.'</a>';
  }

  function getsrcFotoAttribute()
  {
    return url('stg/img/empresa/logo.png');
    return url('storage/users/andre-ramalho-celestino-rocha.png');
    $oldUrl = env("APP_URL");

    $newUrl = str_replace("/app", "/www", $oldUrl);

    $headers = get_headers($newUrl.'/img/atendimentos/pessoas/'.$this->id.'.png');

    if ( $headers && strpos($headers[0], "200 OK") !== false )
    {
      return $newUrl.'/img/atendimentos/pessoas/'.$this->id.'.png';
    }
    else
    {
      return $newUrl.'/img/atendimentos/pessoas/0.png';
    }
  }

  public function scopeCLientes($query)
  {
    if(auth()->user()->kjahdkwkbewtoip->contains('nome', 'Vendedor'))
    {
        $query->whereHas('wuclsoqsdppaxmf', function(Builder $query)
        {
          $query->where('nome', '=','Cliente');
        })->
        whereHas('ktykrtasd1lrfdf', function (Builder $query)
        {
            $query->where('id_pessoa', '=',auth()->user()->id);
        });
    }
    else
    {
        $query->whereHas('wuclsoqsdppaxmf', function(Builder $query)
        {
          $query->where('nome', '=','Cliente');
        });
    }
  }

  public function scopeVendedores($query)
  {
    if(auth()->user()->kjahdkwkbewtoip->contains('nome', 'Vendedor'))
    {
        $query->whereHas('wuclsoqsdppaxmf', function(Builder $query)
        {
          $query->where('nome', '=','Vendedor');
        })->
        whereHas('ktykrtasd1lrfdf', function (Builder $query)
        {
            $query->where('id_pessoa', '=',auth()->user()->id);
        });
    }
    else
    {
        $query->whereHas('wuclsoqsdppaxmf', function(Builder $query)
        {
          $query->where('nome', '=','Vendedor');
        });
    }
  }

  public function scopeSocios($query)
  {
    $query->whereHas('wuclsoqsdppaxmf', function(Builder $query)
    {
      $query->where('nome', '=','Sócios');
    });
  }

  public function scopeTipo($query)
  {
    if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cliente') )
    {
      $query->where('id_pessoa', '=', \Auth::User()->id);
    }
    else if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') )
    {
      $query->where('id_consultor', '=', \Auth::User()->id);
    }
  }
}
