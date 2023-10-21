<div wire:ignore.self class="modal fade" id="modal-criar-atender-lead" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar novo lead1</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit="atendido">
                        <div class="row">
                            @if(session('success'))
                            <div>{{ session('success') }}</div>
                            @endif
                            <div class="col-6">
                                <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Consultor</label>
                                    <x-atendimento.pessoa.vendedores-select col="9" name="id_consultor" selecionado="{{ auth()->user()->id }}" />
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Empresa<strong class='text-danger'>*</strong></label>
                                    <x-atendimento.pessoa.clientes-select col="9" name="id_pessoa" selecionado="" />
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Nome<strong class='text-danger'>*</strong></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm @error('nome') is-invalid @enderror" wire:model.live='nome'>
                                    </div>
                                    @error('nome')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Telefone<strong class='text-danger'>*</strong></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm @error('telefone') is-invalid @enderror" wire:model.live='telefone'>
                                    </div>
                                    @error('telefone')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" wire:model.live='email'>
                                    </div>
                                    @error('email')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Cidade</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm @error('cidade') is-invalid @enderror" wire:model.live='cidade'>
                                    </div>
                                    @error('cidade')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Origem</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm @error('id_origem') is-invalid @enderror" wire:model.live="id_origem">
                                            @foreach(\App\Models\Comercial\Lead::lista_origem() as $id => $origem)
                                                <option value="{{ $id }}">{{ $origem }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_origem')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm @error('status') is-invalid @enderror" wire:model.live='status'>
                                    </div>
                                    @error('status')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Endereço</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm @error('endereco') is-invalid @enderror" wire:model.live='endereco'>
                                    </div>
                                    @error('endereco')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Observação</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm @error('obs') is-invalid @enderror" wire:model.live='obs'>
                                    </div>
                                    @error('obs')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                </div>

                            </div>

                            <div class="col-6 border-left overflow-auto">
                                <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Atendimento</h6>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Resultado</label>
                                            <select class="form-control form-control-sm" wire:model.live="resultado">
                                                <option value="Manter contato">Manter contato</option>
                                                <option value="Aguardando contrato">Aguardando contrato</option>
                                                <option value="Venda concluída">Venda concluída</option>
                                                <option value="Não tem interesse">Não tem interesse</option>
                                                <option value="Chamada não atendida">Chamada não atendida</option>
                                                <option value="Número inexistente">Número inexistente</option>
                                                <option value="Lead frio">Lead frio</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Conversa</label>
                                            <div class="input-group">
                                                <textarea class="form-control form-control-sm" wire:model.live="conversa" rows="2" {{ $conversaDisable }}>{{ $conversa }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Nível de interesse</label>
                                            <select class="form-control form-control-sm" wire:model.live="nivel_interesse">
                                                <option value="Frio">Frio</option>
                                                <option value="Morno">Morno</option>
                                                <option value="Quente">Quente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Próximo contato</label>
                                            <input type="datetime-local" class="form-control form-control-sm" wire:model.live="proximo_atendimento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" wire:click="close" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" wire:click="save">Salvar lead</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('lead-created', (event) => {
            $('#modal-criar-atender-lead').modal('hide');
        });
    });
</script>
