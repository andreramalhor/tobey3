<div wire:ignore.self class="modal fade" id="modal-cadastrar-novo-lead" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar novo lead</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        aaa
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" wire:click="close" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" wire:click="save">Salvar lead</button>
                </div>
            </div>
        </form>
    </div>
</div>
