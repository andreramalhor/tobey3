<div class="row">
    
    <x-slot name="title">
        {{ __('Condomínios') }}
    </x-slot>

    <div class="col-md-12">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-header">
                <h3 class="card-title">Condomínios {{ $modal_type }}</h3>
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
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="criar"><i class="fa fa-plus"></i> Cadastrar novo condomínio</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            {{-- <th class="text-center"></th> --}}
                            <th class="text-left">Condomínio</th>
                            <th class="text-left">Endereço</th>
                            <th class="text-left">Telefone</th>
                            <th class="text-left">CNPJ</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($condominios as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            {{-- <td class="p-1 text-center">
                                <img class="direct-chat-img" src="{{ $ciclo->src_foto  }}">
                            </td> --}}
                            <td class="p-1 text-left">{{ $ciclo->nome }}</td>
                            <td class="p-1 text-left">{{ $ciclo->endereco }}</td>
                            <td class="p-1 text-left">{{ $ciclo->fone }}</td>
                            <td class="p-1 text-left">{{ $ciclo->cnpj }}</td>
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
                            <td colspan="6" class="text-center"><small>Não há condomínios cadastrados</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $condominios->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.condominio.criar')
    @include('livewire.condominio.editar')
    @include('livewire.condominio.mostrar')
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
