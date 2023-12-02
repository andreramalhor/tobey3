@if ( $modalType == 'editar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="update">
                <div class="modal-header">
                    <h5 class="modal-title">Editar categoria</h5>
                    <x-icon.close />
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default mt-4" wire:click="closeModal" style="margin-top: 0px !important;">Cancelar</button>
                    <button type="submit" class="btn btn-secondary mt-4" style="margin-top: 0px !important;">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
