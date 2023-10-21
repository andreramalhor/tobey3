<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categorias</h3>
            </div>
            <div class="card-body p-0">
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                <div class="row p-2">
                    <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right"  placeholder="Pesquisar" wire:model.live="pesquisar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-primary btn-block btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Nova categoria</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Descrição</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            <td class="text-center">{{ $ciclo->id }}</td>
                            <td class="text-center">{{ $ciclo->tipo }}</td>
                            <td class="text-center">{{ $ciclo->nome }}</td>
                            <td class="text-center">{{ $ciclo->descricao }}</td>
                            <td class="text-right">
                                <x-icon.edit click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.delete click="{{ $ciclo->id }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"><small>Não há categorias cadastradas</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $categorias->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.cadastro.categoria.adicionar')
</div>
