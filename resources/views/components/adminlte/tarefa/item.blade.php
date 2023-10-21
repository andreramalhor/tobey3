<li wire:key="{{ $item->id }}" class="{{ $item->status == 'Concluído' ? 'done' : '' }}">
    <div class="icheck-primary d-inline ml-2">
        <input type="checkbox" value="" id="tarefaCheck{{ $item->id }}" wire:click="marcar({{ $item->id }}, '{{ $item->status }}')" {{ $item->status == 'Concluído' ? 'checked' : '' }}>
        <label for="tarefaCheck{{ $item->id }}"></label>
    </div>

    <span class="text">{{ $item->titulo }} <br><small><i class="far fa-clock"></i> {{ $item->created_at->diffForHumans() }}</small></span>

    <small class="float-end badge badge-{{ $item->status == 'Concluído' ? 'success' : 'warning' }}">{{ $item->status }}</small>

    <div class="tools">
        <i class="fas fa-edit" wire:click="edit({{ $item->id }})"></i>
        <i class="fas fa-trash-o" wire:click="delete({{ $item->id }})"></i>
    </div>
</li>
