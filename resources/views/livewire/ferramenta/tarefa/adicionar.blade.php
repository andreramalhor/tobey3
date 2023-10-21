@if ($isOpen)
<div class="modal show" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $tarefaId ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $tarefaId ? 'Editar tarefa' : 'Criar nova tarefa' }}
                    </h5>
                    <svg wire:click="closeModal" role="button" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">

                            <div class="form-group mb-3">
                                <label class="m-0">Responsável</label>
                                <div class="input-group">
                                    <x-atendimento.pessoa.colaboradores-select col="12" name="id_responsavel" selecionado="{{ auth()->user()->id }}" />
                                    <span class="text-danger">@error('conversa') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="m-0">Título<strong class='text-danger'>*</strong></label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('titulo') is-invalid @enderror" wire:model='titulo'>
                                    <span class="text-danger">@error('titulo') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="m-0">Descrição</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('descricao') is-invalid @enderror" wire:model='descricao'>
                                    <span class="text-danger">@error('descricao') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="m-0">Status</label>
                                <div class="input-group">
                                    <select class="form-control form-control-sm @error('status') is-invalid @enderror" wire:model="status">
                                        <option value="Aguardando">Aguardando</option>
                                        <option value="Urgente">Urgente</option>
                                        <option value="Concluído">Concluído</option>
                                        <option value="Atrasado">Atrasado</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                    <span class="text-danger">@error('status') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="m-0">Prazo</label>
                                <div class="input-group">
                                    <input type="datetime-local" class="form-control form-control-sm @error('prazo') is-invalid @enderror" wire:model='prazo'>
                                    <span class="text-danger">@error('prazo') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="m-0">Arquivado</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('arquivado') is-invalid @enderror" wire:model='arquivado'>
                                    <span class="text-danger">@error('arquivado') {{ $message }} @enderror</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">{{ $tarefaId ? 'Atualizar' : 'Cadastrar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
