@if ($isOpen && $leadType == 'atender')
@php
$disabled = $errors->any() || empty($this->resultado) || empty($this->conversa) || empty($this->nivel_interesse) || empty($this->proximo_atendimento);
@endphp

<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    {{-- <div class="modal-dialog modal-xl"> --}}
    <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
        <div class="modal-content">
            <form wire:submit.prevent="registrarAtendimento">
                <div class="modal-header border-0 p-2
                    @if( optional($lead->fghtvxswwryiiil->last())->nivel_interesse == 'Frio')
                        bg-info
                    @elseif( optional($lead->fghtvxswwryiiil->last())->nivel_interesse == 'Morno')
                        bg-orange
                    @elseif( optional($lead->fghtvxswwryiiil->last())->nivel_interesse == 'Quente')
                        bg-red
                    @else
                        bg-secondary
                    @endif
                ">
                {{-- <div class="modal-header"> --}}
                    <h5 class="modal-title">Atender Lead</h5>
                    <svg wire:click="closeModal" role="button" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
                            <dl class="row">
                                <dt class="col-sm-4">Consultor {{ $id_consultor }}</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->lskdfjweklwejrq->apelido ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Empresa</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->rfsdkfjwenfcbew->apelido ?? $lead->id_empresa }}
                                </dd>

                                <dt class="col-sm-4">#id</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->id }}
                                </dd>

                                <dt class="col-sm-4">Nome</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->nome ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Telefone &nbsp;<a href="{{ $lead->link_whatsapp }}" target="_blank" data-bs-tooltip="tooltip" data-bs-title="Whatsapp" aria-label="Whatsapp"><i class="fa-brands fa-whatsapp"></i></a></dt>
                                <dd class="col-sm-8">
                                    {{ $lead->telefone ?? 'sem telefone cadastrado' }}
                                </dd>

                                <dt class="col-sm-4">E-mail</dt>
                                <dd class="col-sm-8">
                                    <a href="mailto:{{ $lead->email }}" target="_blank">{{ $lead->email ?? '' }}</a>
                                </dd>

                                <dt class="col-sm-4">Cidade</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->cidade ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Endereço</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->endereco ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Origem do lead</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->origem ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->status ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Observação</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->obs ?? '-' }}
                                </dd>

                                <dt class="col-sm-4">Próx. atendimento</dt>
                                <dd class="col-sm-8">
                                    {{ $lead->proximo_atendimento ? \Carbon\Carbon::parse($lead->proximo_atendimento)->format('d/m/Y H:i') : '-'}}
                                </dd>

                            </dl>
                        </div>

                        <div class="col-3 border-left overflow-auto">
                            <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Conversas anteriores</h6>
                            <div class="row overflow-auto" style="height: auto; width: inherit;">
                                <div class="direct-chat-messages" style="height: auto;width: inherit;max-height: 20rem;">
                                    <div class="col-12">
                                        @forelse($lead->fghtvxswwryiiil->sortByDesc('created_at') as $conversas)
                                        <div class="direct-chat-msg pb-1" style="border-bottom: 1px solid lightgray">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">{{ $conversas->resultado }}</span>
                                                <span class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($conversas->created_at)->format('d/m/Y H:i') }}</span>
                                            </div>
                                            <div class="direct-chat-text ml-0">{{ $conversas->conversa }}</div>
                                        </div>
                                        @empty
                                        <div class="direct-chat-msg text-center">Não há registro de conversas</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-5 border-left overflow-auto">
                            <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Atendimento</h6>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="m-0">Resultado</label>
                                        <select class="form-control form-control-sm" wire:model.live="resultado" wire:change="atualizarResultado()">
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
                                            <textarea class="form-control form-control-sm" wire:model.live="conversa" rows="2" placeholder="Resumo da conversa" {{ $conversaDisable ?? '' }}>as</textarea>
                                            <span class="text-danger">@error('conversa') {{ $message }} @enderror</span>
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
                    <div class="row">
                        <div class="col-4 text-left">
                            <small>
                                <strong>Cadastrado: </strong><span>{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y H:i') }}</span>
                            </small>
                        </div>
                        <div class="col-4 text-center">
                            <small>
                                <span>{{ \Carbon\Carbon::today()->diffInDays($lead->updated_at) }}</span> dias desde a última atualização
                            </small>
                        </div>
                        <div class="col-4 text-right">
                            <small>
                                <strong>Última atualização: </strong><span>{{ \Carbon\Carbon::parse($lead->updated_at)->format('d/m/Y H:i') }}</span>
                            </small>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                    <button type="submit" class="btn btn-primary @if($disabled) disabled @endif" wire:loading.attr='disabled'>Registrar atendimento</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
