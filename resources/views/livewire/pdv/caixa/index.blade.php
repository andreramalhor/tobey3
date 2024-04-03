<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-header">
                <h3 class="card-title">Caixas</h3>
            </div>
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right" placeholder="Pesquisar" wire:model.live="pesquisar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="criar"><i class="fa fa-plus"></i> Abrir caixa</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Local</th>
                            <th class="text-left">Usuário</th>
                            <th class="text-left">Abertura</th>
                            <th class="text-left">Fechamento</th>
                            <th class="text-left">Validação</th>
                            <th class="text-right">Saldo Abertura</th>
                            <th class="text-right">Saldo Fechamento</th>
                            <th class="text-center">Status</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($caixas as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            <td class="p-1 text-center">{{ $ciclo->id }}</td>
                            <td class="p-1 text-left">
                                {{ $ciclo->rybeyykhpcgwkgr->nome ?? $ciclo->id_banco }}
                            </td>
                            <td class="p-1 text-left">
                                {{ $ciclo->kpakdkhqowIqzik->apelido ?? $ciclo->id_usuario_abertura }}
                            </td>
                            <td class="p-1 text-left">
                                {{ isset($ciclo->dt_abertura) ? \Carbon\Carbon::parse($ciclo->dt_abertura)->format('d/m/Y H:i:s') : '' }}
                            </td>
                            <td class="p-1 text-left">
                                {{ isset($ciclo->dt_fechamento) ? \Carbon\Carbon::parse($ciclo->dt_fechamento)->format('d/m/Y H:i:s') : '' }}
                            </td>
                            <td class="p-1 text-left">
                                {{ isset($ciclo->dt_validação) ? \Carbon\Carbon::parse($ciclo->dt_validação)->format('d/m/Y H:i:s') : '' }}
                            </td>
                            <td class="p-1 text-right">
                                {{ number_format($ciclo->vlr_abertura, 2, ',', '.') }}
                            </td>
                            <td class="p-1 text-right">
                                {{ number_format($ciclo->vlr_fechamento, 2, ',', '.') }}
                            </td>
                            <td class="p-1 text-center">
                                <small class="badge bg-{{ $ciclo->cor_status ?? 'default' }}">{{ $ciclo->status }}</small>
                            </td>
                            <td class="p-1 text-right">
                                <x-icon.view click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.edit click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.delete click="{{ $ciclo->id }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"><small>Não há caixas cadastrados</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $caixas->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.pdv.caixa.criar')
    @include('livewire.pdv.caixa.editar')
    @include('livewire.pdv.caixa.mostrar')
</div>

{{--

    CRUD

create    criar
read      mostrar
update    atualizar
delete    deletar


# create (criar)
store (armazenar ou salvar)
# edit (editar)
update (atualizar)
# show (mostrar ou exibir)
destroy (destruir, remover ou deletar)

 --}}
