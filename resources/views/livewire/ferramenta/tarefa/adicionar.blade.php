@if ($isOpen)
<div class="modal show" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $tarefaId ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $tarefaId ? 'Editar tarefa' : 'Criar nova tarefa' }}
                    </h5>
                    <x-icon.close />
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

                            @can('Sócios')
                            <div class="form-group mb-3">
                                <label class="m-0">Arquivado</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('arquivado') is-invalid @enderror" wire:model='arquivado'>
                                    <span class="text-danger">@error('arquivado') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            @endcan

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
