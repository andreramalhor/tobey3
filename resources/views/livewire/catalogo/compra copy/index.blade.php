<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Compras - modaltype {{$modalType }}</h3>
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
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Nova compra</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Tipo</th>
                            <th class="text-left">Fornecedor</th>
                            <th class="text-center">Qtd Produtos</th>
                            <th class="text-right">Valor da compra</th>
                            <th class="text-center">Status</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($compras as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            <td class="p-1 text-center">{{ $ciclo->id }}</td>
                            <td class="p-1 text-left">{{ $ciclo->tipo }}</td>
                            <td class="p-1 text-left">{!! $ciclo->ysfyhzfsfarfdha->apelido ?? '<small>(sem fornecedor)</small>' !!}</td>
                            <td class="p-1 text-center">{{ $ciclo->qtd_produtos }}</td>
                            <td class="p-1 text-right">{{ number_format($ciclo->vlr_final, 2, ',', '.') }}</td>
                            <td class="p-1 text-center"><small><span class="badge bg-secondary">{{ $ciclo->status }}</span></small></td>
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
                            <td colspan="5" class="text-center"><small>Não há compras cadastradas</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $compras->appends([
                        'pesquisar' => request()->get('pesquisar', '')
                    ])->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.catalogo.compra.criar.1-passo')
    @include('livewire.catalogo.compra.criar.2-passo')

    {{-- @include('livewire.catalogo.compra.criar') --}}
    {{-- @include('livewire.catalogo.compra.editar') --}}
    {{-- @include('livewire.catalogo.compra.mostrar') --}}
</div>
