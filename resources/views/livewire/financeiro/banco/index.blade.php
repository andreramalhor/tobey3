<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-header">
                <h3 class="card-title">Bancos</h3>
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
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="criar"><i class="fa fa-plus"></i> Cadastrar banco</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Nome</th>
                            <th class="text-center">Nº Banco</th>
                            <th class="text-center">Nº Agência</th>
                            <th class="text-center">Nº Conta</th>
                            <th class="text-right">Saldo Atual</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bancos as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            <td class="p-1 text-center">{{ $ciclo->id }}</td>
                            <td class="p-1 text-left">{{ $ciclo->nome }}</td>
                            <td class="p-1 text-center">{{ $ciclo->num_banco }}</td>
                            <td class="p-1 text-center">{{ $ciclo->num_agencia }}</td>
                            <td class="p-1 text-center">{{ $ciclo->num_conta }}</td>
                            <td class="p-1 text-right">{{ number_format($ciclo->saldo($ciclo->id), 2, ',', '.') }}</td>
                            <td class="p-1 text-right">
                                <x-icon.extrato click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.view click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.edit click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.delete click="{{ $ciclo->id }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"><small>Não há bancos cadastradas</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $bancos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.financeiro.banco.criar')
    @include('livewire.financeiro.banco.editar')
    @include('livewire.financeiro.banco.mostrar')
    @include('livewire.financeiro.banco.remover')
    @include('livewire.financeiro.banco.extrato')
</div>
