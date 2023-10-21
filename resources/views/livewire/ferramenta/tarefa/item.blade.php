<li class="{{ $tarefa->feito ? 'done' : '' }}">

<div class="d-inline ml-2">
    <input type="checkbox" value="" name="tarefa" id="tarefa_{{ $tarefa->id }}" {{ $tarefa->feito ? 'checked' : '' }} wire:model.live="tarefa.feito">
    <label for="tarefa_{{ $tarefa->id }}2"></label>
</div>

    <span class="text">{{ $tarefa->titulo }}</span>{{ $tarefa->feito }}
    <small class="badge badge-info"><i class="far fa-clock"></i>Em andamento</small>

    <div class="tools">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
    </div>
</li>
