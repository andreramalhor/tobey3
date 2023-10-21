<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\{LeadConversa, LeadAtendimento};

class Lead extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table      = 'com_leads';
    protected $fillable   = [
        'id_pessoa',
        'nome',
        'telefone',
        'obs',
        'cidade',
        'email',
        'id_origem',
        'interesse',
        'id_consultor',
        'id_turma',
        'status',
        'endereco',
        'favorito',
        'arquivado',
        'proximo_atendimento',
        'produto',
        'valor',
    ];
    // protected $appends = [
    // ];

    // RELACIONAMENTOS  ===========================================================================================
    public function fghtvxswwryiiil()
    {
        return $this->hasMany(LeadConversa::class, 'id_lead', 'id');
    }

    public function kflfdlmmsfsdfks()
    {
        return $this->hasMany(LeadAtendimento::class, 'id_lead', 'id');
    }

    public function lskdfjweklwejrq()
    {
        return $this->hasone(Pessoa::class, 'id', 'id_consultor');
    }

    public function rfsdkfjwenfcbew()
    {
        return $this->hasone(Pessoa::class, 'id', 'id_pessoa');
    }

    public function ultimo_atendimento()
    {
        return $this->hasOne(LeadConversa::class, 'id_lead', 'id')->orderBy('proximo_atendimento', 'desc');
    }

    public function akdjwlkefjdlkfn()
    {
        return $this->hasOne(LeadConversa::class, 'id_lead', 'id');
    }

    public static function proximo_atendimento($id)
    {
        $leads = Lead::
                        where('id_pessoa', '=', $id)->
                        where('id_consultor', '=', auth()->user()->id)->
                        where(function ($query) {
                            $query->where('proximo_atendimento', '<=', now())
                            ->orWhere('proximo_atendimento', '=', null);
                        })->
                        // orWhere('proximo_atendimento', '=', null)->
                        // whereHas('ultimo_atendimento', function($query)
                        // {
                        //   $query->
                        //           orderBy('proximo_atendimento', 'desc');
                        // })->
                        // orderByRaw('-deleted_at DESC')->
                        // orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                        // orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                        orderBy(\DB::raw('ISNULL(proximo_atendimento)'), 'ASC')->
                        orderBy('proximo_atendimento', 'ASC')->
                        first();

        return $leads;
    }

    public static function procurar($pesquisa)
    {
        return empty($pesquisa)
            ? static::query()
            : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('id', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('id_pessoa', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('telefone', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('obs', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('cidade', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('email', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('id_origem', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('interesse', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('id_consultor', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('status', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('favorito', 'LIKE', '%'.$pesquisa.'%')
                        ->orWhere('arquivado', 'LIKE', '%'.$pesquisa.'%');
    }


    public static function filtro()
    {
        $leads = Lead::
                when(auth()->user()->kjahdkwkbewtoip->contains('nome', 'Administrador do Sistema'), function ($query)
                {
                    $query;
                })->
                when(auth()->user()->kjahdkwkbewtoip->contains('nome', 'Cliente'), function ($query)
                {
                    $query->where('id_pessoa', '=', auth()->user()->id);
                })->
                when(auth()->user()->kjahdkwkbewtoip->contains('nome', 'Vendedor'), function ($query)
                {
                    $query->where('id_consultor', '=', auth()->user()->id);
                });

        return $leads;
    }

    //MÉTODO PARA DELETAR RELACIONAMENTOS AO DELETAR ITEM
    public static function boot()
    {
        parent::boot();

        static::deleting(function($leads)
        {
            $leads->fghtvxswwryiiil()->delete();
        });
    }

    // MUTATORS         ===========================================================================================
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = ucwords(trim($value));
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

    public function opcoes_status()
    {
        $status = [
            [
                'nome'=> 'entrada_lead',
                'cor' => 'warning',
            ],
            [
                'nome'=> 'apresentacao_curso',
                'cor' => 'info',
            ],
            [
                'nome'=> 'proposta_enviada',
                'cor' => 'success',
            ],
            [
                'nome'=> 'negociando_venda',
                'cor' => 'secondary',
            ],
            [
                'nome'=> 'cancelado',
                'cor' => 'danger',
            ],
            [
                'nome'=> 'Ganho',
                'cor' => 'green',
            ]
        ];

        return $status;
    }

    public function opcoes_interesse()
    {
        if( $this->fghtvxswwryiiil->count() > 0)
        {
            switch(optional($this->fghtvxswwryiiil->last())->nivel_interesse)
            {
                case 'Frio':
                    return [
                        'cor' => '#3c8dbc',
                        'label' => 'info',
                        'interesse' => 'Frio',
                    ];
                    break;

                case 'Morno':
                    return [
                        'cor' => '#ff851b',
                        'label' => 'warning',
                        'interesse' => 'Morno',
                    ];
                    break;

                case 'Quente':
                    return [
                        'cor' => '#dc3545',
                        'label' => 'danger',
                        'interesse' => 'Quente',
                    ];
                    break;

                default:
                    return [
                        'cor' => '#808080',
                        'label' => 'default',
                        'interesse' => '-',
                    ];
                    break;
            }
        }
        else
        {
            return [
                'cor' => '#808080',
                'label' => 'default',
                'interesse' => '-',
            ];
        }
    }

    public function getColorInteresseAttribute()
    {
        switch ($this->interesse)
        {
            case 'frio':
                return 'border-left-color: #3c8dbc';
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
        for ($i = 0; $i <= strlen($mask) - 1; ++$i)
        {
            if ($mask[$i] == '#')
            {
                if (isset($val[$k]))
                {
                    $maskared .= $val[$k++];
                }
            }
            else
            {
                if (isset($mask[$i]))
                {
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

    public function getsrcFotoAttribute()
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
                return 'Telemarketing';
                break;
            case 2 :
                return 'Consultor Externo';
                break;
            case 3 :
                return 'Panfletos';
                break;
            case 4 :
                return 'Mala Direta';
                break;
            case 5 :
                return 'TV';
                break;
            case 6 :
                return 'Indicação';
                break;
            case 7 :
                return 'Link do Site';
                break;
            case 8 :
                return 'Outros';
                break;
            case 9 :
                return 'Rádio';
                break;
            case 10 :
                return 'Facebook';
                break;
            case 11 :
                return 'Google';
                break;
            case 12 :
                return 'SMS';
                break;
            case 13 :
                return 'Instagram';
                break;
            case 14 :
                return 'Outlook';
                break;
            case 15 :
                return 'Vendas Online';
                break;
            case 16 :
                return 'Revista';
                break;
            case 17 :
                return 'Workshop';
                break;
            case 18 :
                return 'BusDoor';
                break;
            case 19 :
                return 'E-Mail Marketig';
                break;
            case 20 :
                return 'Planilha Cliente';
                break;

            default:
                return $this->id_origem.'-';
                break;
        }
    }

    public static function lista_origem()
    {
        return [
            '1'   => 'Telemarketing',
            '2'   => 'Consultor Externo',
            '3'   => 'Panfletos',
            '4'   => 'Mala Direta',
            '5'   => 'TV',
            '6'   => 'Indicação',
            '7'   => 'Link do Site',
            '8'   => 'Outros',
            '9'   => 'Rádio',
            '10'  => 'Facebook',
            '11'  => 'Google',
            '12'  => 'SMS',
            '13'  => 'Instagram',
            '14'  => 'Outlook',
            '15'  => 'Vendas Online',
            '16'  => 'Revista',
            '17'  => 'Workshop',
            '18'  => 'BusDoor',
            '19'  => 'E-Mail Marketing',
            '20'  => 'Planilha Cliente',
        ];
    }

    public function scopeMeus($query)
    {
        $query->where('id_consultor', '=', auth()->user()->id);
    }

}
