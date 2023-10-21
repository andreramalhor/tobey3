<div>
    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal-{{ $this->formId }}" wire:click="openModalToUpdateCategoria">Editar</button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editStudentModal-{{ $this->formId }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true" wire:modal.live="openModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    @php
                        $disabled = $errors->any() || empty($this->categoria->nome) || empty($this->categoria->tipo);
                    @endphp

                    <h5 class="modal-title">Editar categoria {{ $this->formId }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" id="updateForm-{{ $this->formId }}">
                        <div class="form-group row">
                            <label class="col-3">Nome</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model.live="categoria.nome">
                                @error('categoria.nome')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3">Tipo</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model.live="categoria.tipo">
                                @error('categoria.tipo')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3">Descrição</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model.live="categoria.descricao">
                                @error('categoria.descricao')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary @if($disabled) disabled @endif" wire:target='update' wire:loading.attr='disabled' form="updateForm-{{ $this->formId }}">Editar</button>
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
            $('#editStudentModal-{{ $this->formId }}').modal('hide');
        });
    </script>
@endpush
