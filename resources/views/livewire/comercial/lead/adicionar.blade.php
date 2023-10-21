@if ($isOpen && $leadType == 'criarEditar')
<div class="modal show" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $leadId ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $leadId ? 'Editar Lead' : 'Criar novo lead' }}
                    </h5>
                    <svg wire:click="closeModal" role="button" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <div class="modal-body">
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
                                    <input type="text" class="form-control form-control-sm @error('nome') is-invalid @enderror" wire:model='nome'>
                                </div>
                                @error('nome')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                            </div>

                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label">Telefone<strong class='text-danger'>*</strong></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm @error('telefone') is-invalid @enderror" wire:model='telefone'>
                                </div>
                                @error('telefone')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                            </div>

                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" wire:model='email'>
                                </div>
                                @error('email')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                            </div>

                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label">Cidade</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm @error('cidade') is-invalid @enderror" wire:model='cidade'>
                                </div>
                                @error('cidade')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                            </div>

                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label">Endereço</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm @error('endereco') is-invalid @enderror" wire:model='endereco'>
                                </div>
                                @error('endereco')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                            </div>

                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label">Origem</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm @error('id_origem') is-invalid @enderror" wire:model="id_origem">
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
                                    <select class="form-control form-control-sm @error('status') is-invalid @enderror" wire:model="status">
                                        <option value="Oportunidade">Oportunidade</option>
                                        <option value="Apresentação">Apresentação</option>
                                        <option value="Negociação">Negociação</option>
                                        <option value="Contrato">LContrato</option>
                                    </select>
                                </div>
                                @error('status')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                            </div>

                            <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label">Observação</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm @error('obs') is-invalid @enderror" wire:model='obs'>
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
                                        <select class="form-control form-control-sm" wire:model="resultado" wire:change="atualizarResultado()">
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
                                            <textarea class="form-control form-control-sm" wire:model="conversa" rows="2" placeholder="Resumo da conversa" {{ $conversaDisable ?? '' }}>as</textarea>
                                            <span class="text-danger">@error('conversa') {{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="m-0">Nível de interesse</label>
                                        <select class="form-control form-control-sm" wire:model="nivel_interesse">
                                            <option value="Frio">Frio</option>
                                            <option value="Morno">Morno</option>
                                            <option value="Quente">Quente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="m-0">Próximo contato</label>
                                        <input type="datetime-local" class="form-control form-control-sm" wire:model="proximo_atendimento">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">{{ $leadId ? 'Atualizar' : 'Cadastrar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
