<div>
    @php
        $colaboradores = \App\Models\Atendimento\Pessoa::whereHas('wuclsoqsdppaxmf', function(Illuminate\Database\Eloquent\Builder $query)
        {
            $query->where('nome', '=','Colaborador');
        })->get();
    @endphp

    @foreach($colaboradores as $key => $colaborador)

    @if(($key % 5) == 0 )
    <div class="row">
    @endif
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title d-inline-flex">
                        <img class="img-circle img-size-32 mr-2" src="{{ $colaborador->eoprtjweornweuq->profile_photo_url ?? null }}" alt="{{ $colaborador->apelido }}" />{{ $colaborador->apelido }}
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        @forelse($colaborador->fjowenfsiasdwqe as $tarefa)
                        <tr style="border-left: 10px solid {{ $tarefa->opcoes_status()['cor'] }}" class="pb-2">
                            <td class="py-1 pl-1" style="width: 80%;">
                                <strong>{{ $tarefa->titulo }}</strong><br><small>{{ $tarefa->descricao }}</small>
                            </td>
                            <td class="text-right py-1 pr-0" style="width: 20%;">
                                <img class="img-circle img-size-32 mr-2" src="{{ $tarefa->oifuwernduaosdu->profile_photo_url ?? null }}" alt="{{ $tarefa->oifuwernduaosdu->name }}" /></small>
                            </td>
                        </tr>
                        @empty
                        <tr class="pb-2">
                            <td class="text-center py-1 pl-1" style="width: 100%;">
                                Não há tarefas pendentes
                            </td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    @if(($key % 5) == 4)
    </div>
    @endif
    @endforeach
</div>
