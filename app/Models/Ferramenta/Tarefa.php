<?php

namespace App\Models\Ferramenta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Atendimento\Pessoa;

class Tarefa extends Model
{
    use SoftDeletes;
    public $timestamps   = true;

    protected $table      = 'fer_tarefas';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'id_criador',
        'id_responsavel',
        'titulo',
        'descricao',
        'status',
        'prazo',
        'arquivado',
    ];

    protected $appends = [
    ];

    // =====================================================================================================================================
    public function oifuwernduaosdu()
    {
        return $this->belongsTo(Pessoa::class, 'id_criador', 'id');
    }

    // =====================================================================================================================================
    public function opcoes_status()
    {
        switch($this->status)
        {
            case 'Urgente':
                return [
                    'cor' => '#000',
                    'status' => 'Urgente',
                ];
                break;

            case 'Aguardando':
                return [
                    'cor' => '#ff851b',
                    'status' => 'Aguardando',
                ];
                break;

                case 'Atrasado':
                    return [
                        'cor' => '#dc3545',
                        'status' => 'Atrasado',
                    ];
                    break;

            case 'Concluído':
                return [
                    'cor' => '#3c8dbc',
                    'status' => 'Concluído',
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
}
