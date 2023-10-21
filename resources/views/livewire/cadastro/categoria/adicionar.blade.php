@if ($isOpen)
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{$categoriaId ? 'Editar categoria' : 'Criar nova categoria' }}
                </h5>
                <svg wire:click="closeModal" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="{{ $categoriaId ? 'update' : 'store' }}">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" wire:model="nome" class="form-control">
                        <span class="text-danger">@error('nome') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" wire:model="tipo" class="form-control">
                        <span class="text-danger">@error('tipo') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea wire:model="descricao" class="form-control" rows="4"></textarea>
                        <span class="text-danger">@error('descricao') {{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">
                        {{ $categoriaId ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
