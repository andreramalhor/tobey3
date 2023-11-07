<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comissões</h3>
            </div>
            <div class="card-body p-0">
                @if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Sócio') )
                <div class="row p-2">

                    <div class="col-2">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><small>De:</small></span>
                                </div>
                                <input type="date" class="form-control form-control-sm" wire:model.live="inicio">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><small>à:</small></span>
                                </div>
                                <input type="date" class="form-control form-control-sm" wire:model.live="final">
                            </div>
                        </div>
                    </div>

                    <x-atendimento.pessoa.clientes-select col="2" name="filtro_empresa" wire:model.live="filtro_nome" placeholder="Todas as empresas"/>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_nome" placeholder="Pesquisar filtro_nome">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_conversa" placeholder="Pesquisar filtro_conversa">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_telefone" placeholder="Pesquisar filtro_telefone">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_nivel" placeholder="Pesquisar filtro_nivel">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_favorito" placeholder="Pesquisar filtro_favorito">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_status" placeholder="Pesquisar filtro_status">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_resultado" placeholder="Pesquisar filtro_resultado">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="filtro_dt_retorno" placeholder="Pesquisar filtro_dt_retorno">
                            </div>
                        </div>
                    </div>

                    <x-financeiro.bancos-select col="1" name="id_banco" wire:model.live="banco"/>

                    <div class="col-1">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="valor" placeholder="Valor">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" wire:model.live="conta" placeholder="Conta">
                            </div>
                        </div>
                    </div>


                   <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right"  placeholder="Pesquisar" wire:model.live="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <a class="btn btn-primary btn-block btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Novo lead</a>
                    </div>

                </div>
                @endif

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr style="border-left: 5px solid black">
                            <th class="text-center">#</th>
                            <th class="text-left">Empresa</th>
                            <th class="text-left">Nome</th>
                            <th class="text-center">Telefone</th>
                            <th class="text-center">Dt Última Conversa</th>
                            <th class="text-left">Última Conversa</th>
                            @if(  \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Sócio') )
                            <th class="text-left">Consultor</th>
                            @endif
                            <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($leads as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}" style="border-left: 5px solid {{ $ciclo->opcoes_interesse()['cor'] ?? 'gray' }}">
                            <td class="text-center">{{ $ciclo->id }}</td>
                            <td class="text-left">{{ $ciclo->rfsdkfjwenfcbew->apelido ?? '-' }}</td>
                            <td class="text-left">{{ $ciclo->nome }}</td>
                            <td class="text-center">{{ $ciclo->telefone }}</td>
                            <td class="text-center">{{ isset($ciclo->ultimo_atendimento->created_at) ? \Carbon\Carbon::parse($ciclo->ultimo_atendimento->created_at)->format('d/m/Y H:i') : '' }}</td>
                            <td class="text-left">{{ $ciclo->ultimo_atendimento->conversa ?? '' }}</td>
                            @if(  \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Sócio') )
                            <td class="text-left">{{ $ciclo->lskdfjweklwejrq->apelido ?? '' }}</td>
                            @endif
                            <td class="text-center">
                                <i class="fa-solid fa-fw fa-headset fa-xl" wire:click="atender({{ $ciclo->id }})" role="button"></i>
                                &nbsp;
                                <i class="fa-solid fa-fw fa-square-pen fa-xl" wire:click="edit({{ $ciclo->id }})" role="button"></i>
                                &nbsp;
                                <i class="fa-solid fa-fw fa-square-xmark fa-xl" wire:click="delete({{ $ciclo->id }})" role="button"></i>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"><small>Não há leads cadastradas</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.comercial.lead.adicionar')
    @include('livewire.comercial.lead.atender')
</div>
