<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    @php
                        $disabled = $errors->any() || empty($this->nome) || empty($this->tipo);
                    @endphp

                    <h5 class="modal-title">Adicionar categoria</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">

                        <div class="form-group row">
                            <label class="col-3">Nome</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model.live="nome">
                                @error('nome')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3">Tipo</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model.live="tipo">
                                @error('tipo')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3">Descrição</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model.live="descricao">
                                @error('descricao')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary @if($disabled) disabled @endif" wire:target='store' wire:loading.attr='disabled'>Criar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addStudentModal').modal('hide');
        });
    </script>
@endpush
