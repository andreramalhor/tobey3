<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pessoas</h3>
            </div>
            <div class="card-body p-0">
                <div class="row p-3">
                    <div class="offset-md-9 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right"  placeholder="Buscar pessoa" wire:model.live="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-primary btn-block btn-sm float-right" data-bs-toggle="modal" data-bs-target="#modal-pessoa-adicionar"><i class="fa fa-plus"></i> Cadastrar</a>
                    </div>
                </div>
                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th  class="text-center">#</th>
                            <th class="">Nome</th>
                            <th class="">E-mail</th>
                            <th class="">Endereço</th>
                            <th class="">Telefone</th>
                            <th class="">Tipos</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($pessoas))
                            @forelse($pessoas as $pessoa)
                            <tr>
                                <td class="text-center">{{ $pessoa->id }}</td>
                                <td class="text-left">{{ $pessoa->nome }}</td>
                                <td>{{ $pessoa->email }}</td>
                                <td>{{ $pessoa->endereco }}</td>
                                <td>{{ $pessoa->fone }}</td>
                                <td>
                                    @foreach($pessoa->kjahdkwkbewtoip as $tipo)
                                    <small class="badge bg-{{ $tipo->color }}">{{ $tipo->nome }}</small>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary" href="#"><i class="fas fa-folder"></i>View</a>
                                    <a class="btn btn-xs btn-info" href="#"><i class="fas fa-pencil-alt"></i>Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#"><i class="fas fa-trash"></i>Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="4">Não há pessoas cadastradas.</td>
                            </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $pessoas->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.atendimento.pessoa-adicionar')
</div>
