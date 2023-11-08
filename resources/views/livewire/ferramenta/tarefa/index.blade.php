<div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>Lista de Tarefas
                </h3>
            </div>
            <div class="card-body p-0">
                <ul class="todo-list ui-sortable" data-bs-widget="todo-list">
                    @forelse ($tarefas as $ciclo)
                    {{-- <x-livewire.ferramenta.tarefa.index item="{{ $ciclo }}" wire:key="{{ $ciclo->id }}"/> --}}
                    <li wire:key="{{ $ciclo->id }}" class="{{ $ciclo->status == 'Concluído' ? 'done' : '' }}">
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" id="tarefaCheck{{ $ciclo->id }}" wire:click="marcar({{ $ciclo->id }}, '{{ $ciclo->status }}')" {{ $ciclo->status == 'Concluído' ? 'checked' : '' }}>
                            <label for="tarefaCheck{{ $ciclo->id }}"></label>
                        </div>

                        <span class="text">{{ $ciclo->titulo }} <br><small><i class="far fa-clock"></i> {{ $ciclo->created_at->diffForHumans() }}</small></span>

                        <small class="float-end badge badge-{{ $ciclo->status == 'Concluído' ? 'success' : 'warning' }}">{{ $ciclo->status }}</small>

                        <div class="tools">
                            <i class="fas fa-edit" wire:click="edit({{ $ciclo->id }})"></i>
                            <i class="fas fa-trash-o" wire:click="delete({{ $ciclo->id }})"></i>
                        </div>
                    </li>
                    @empty
                    <li class="text-center">
                        Não há tarefas cadastradas
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer clearfix">
                <a class="btn btn-primary float-right btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Nova tarefa</a>
            </div>
        </div>
    </div>
    @include('livewire.ferramenta.tarefa.adicionar')
</div>
