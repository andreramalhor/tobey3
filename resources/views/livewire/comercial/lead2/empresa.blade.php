<div>
    <div class="row mt-2">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Empresas</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($empresas as $empresa)
                        <li class="item disabled">
                            <div class="product-img">
                                <img src="{{ $empresa->src_foto }}" alt="Product Image" class="img-size-50 rounded">
                            </div>
                            <div class="product-info">
                                <span class="product-title">{{ $empresa->apelido }}
                                    <div class="float-end">
                                        <span class="badge badge-success" data-bs-toggle="modal" data-bs-target="#modal-criar-atender-lead" style="cursor: pointer;">Cadastrar novo</span>
                                        @if($empresa->ksdjflsksdjkdjs->count() > 0)
                                        <span class="badge badge-warning"
                                            @if(\Carbon\Carbon::now()->between(\Carbon\Carbon::today()->toDateString().' '.$empresa->ktykrtasd1lrfdf->where('id_pessoa', '=', auth()->user()->id)->first()->horario_inicial, \Carbon\Carbon::today()->toDateString().' '.$empresa->ktykrtasd1lrfdf->where('id_pessoa', '=', auth()->user()->id)->first()->horario_final))
                                            wire:click="trazer_leads({{ $empresa->id }})"
                                            style="cursor: pointer;"
                                            @else
                                            style="cursor: default; background-color: lightgrey;"
                                            @endif
                                        >Atender</span>
                                        @endif
                                    </div>
                                </span>
                                <span class="product-description">
                                    <small>
                                        {{ \Carbon\Carbon::parse($empresa->ktykrtasd1lrfdf->where('id_pessoa', '=', auth()->user()->id)->first()->horario_inicial)->format('H:i') }} às
                                        {{ \Carbon\Carbon::parse($empresa->ktykrtasd1lrfdf->where('id_pessoa', '=', auth()->user()->id)->first()->horario_final)->format('H:i') }}
                                    </small>
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <livewire:comercial.lead.criar_Atender>
        </div>

        @if(isset($lead))
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $lead->nome ?? 'Nome do lead' }}</h3>
                </div>
                <div class="card-body">
                    <form wire:submit="atendido">
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
                                <dl class="row">

                                    <dt class="col-sm-4">Consultor</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->lskdfjweklwejrq->apelido ?? '-' }}
                                    </dd>

                                    <dt class="col-sm-4">Empresa</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->rfsdkfjwenfcbew->apelido ?? $lead->id_pessoa ?? '-' }}
                                    </dd>

                                    <dt class="col-sm-4">#</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->id ?? '#' }}
                                    </dd>

                                    <dt class="col-sm-4">Nome</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->nome ?? '-' }}
                                    </dd>

                                    <dt class="col-sm-4">Telefone &nbsp;<a href="{{ $lead->link_whatsapp ?? '-' }}" target="_blank" data-bs-tooltip="tooltip" data-bs-title="Whatsapp" aria-label="Whatsapp"><i class="fa-brands fa-whatsapp"></i></a></dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->telefone ?? '-' }}
                                    </dd>

                                    <dt class="col-sm-4">E-mail</dt>
                                    <dd class="col-sm-8">
                                        <a href="mailto:{{ $lead->email ?? '-' }}" target="_blank">{{ $lead->email ?? '-' }}</a>
                                    </dd>

                                    <dt class="col-sm-4">Cidade</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->cidade ?? '-' }}
                                    </dd>

                                    <dt class="col-sm-4">Origem</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->origem ?? '-' }}
                                    </dd>

                                    <dt class="col-sm-4">Interesse</dt>
                                    <dd class="col-sm-8">
                                        {{ ucfirst($lead->interesse ?? '-') }}
                                    </dd>

                                    <dt class="col-sm-4">Status</dt>
                                    <dd class="col-sm-8">
                                        {{ ucfirst($lead->status ?? '-') }}
                                    </dd>

                                    <dt class="col-sm-4">Endereço</dt>
                                    <dd class="col-sm-8">
                                        {{ $lead->endereco ?? '-' }}
                                    </dd>
                                </dl>
                            </div>

                            <div class="col-4 border-left overflow-auto">
                                <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Conversas anteriores</h6>
                                <div class="row overflow-auto" style="height: auto; width: inherit;">
                                    <div class="direct-chat-messages" style="height: auto;width: inherit;max-height: 20rem;">
                                        <div class="col-12">
                                            @forelse($lead->fghtvxswwryiiil->sortByDesc('created_at') as $conversa)
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($conversa->created_at)->format('d/m/Y H:i') }}</span>
                                                </div>
                                                <div class="direct-chat-text ml-0">{{ $conversa->conversa }}</div>
                                            </div>
                                            @empty
                                            <div class="direct-chat-msg text-center">Não há registro de conversas</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 border-left overflow-auto">
                                <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Atendimento</h6>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Resultado</label>
                                            <select class="form-control form-control-sm" wire:model="resultado" id="resultado" onchange="caminho(this)">
                                                <option value="Manter continputato">Manter contato</option>
                                                <option value="Aguardando contrato">Aguardando contrato</option>
                                                <option value="Venda concluída">Venda concluída</option>
                                                <option value="Fazer contato futuro">Fazer contato futuro</option>
                                                <option value="Não tem interesse">Não tem interesse</option>
                                                <option value="Chamada não atendida">Chamada não atendida</option>
                                                <option value="Número inexistente">Número inexistente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Conversa</label>
                                            <div class="input-group">
                                                <textarea class="form-control form-control-sm" wire:model.debouce.500ms="conversa" id="conversa" rows="2" onchange="formulario_atendimento()"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Nível de interesse</label>
                                            <select class="form-control form-control-sm" wire:model="nivel_interesse" onchange="formulario_atendimento()">
                                                <option value="Frio">Frio</option>
                                                <option value="Morno">Morno</option>
                                                <option value="Quente">Quente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label class="m-0">Próximo contato</label>
                                            <input type="datetime-local" class="form-control form-control-sm" wire:model="proximo_atendimento" id="proximo_atendimento" onchange="formulario_atendimento()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-8 col-4">
                                <button type="submit" class="btn btn-sm btn-success d-block disabled" wire:target="atendido" wire:loading.attr="disabled" id="atender_proximo">Atender próximo</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-4 text-left">
                            <small>
                                <strong>Cadastrado: </strong><span>{{ \Carbon\Carbon::parse($lead->created_at ?? '')->format('d/m/Y H:i') }}</span>
                            </small>
                        </div>
                        <div class="col-4 text-center">
                            <small>
                                <span>0</span> dias sem atualização
                            </small>
                        </div>
                        <div class="col-4 text-right">
                            <small>
                                <strong>Última atualização: </strong><span>{{ \Carbon\Carbon::parse($lead->updated_at ?? '')->format('d/m/Y H:i') }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('js')
<script>
    function formulario_atendimento()
    {
        if( $('#conversa').val() == '' || $('#proximo_atendimento').val() == '' )
        {
            $('#atender_proximo').addClass('disabled')
        }
        else
        {
            $('#atender_proximo').removeClass('disabled')
        }
    }

    function caminho(campo)
    {
        switch (campo.value)
        {
            case 'Não tem interesse':
            case 'Chamada não atendida':
            case 'Número inexistente':
                $('#conversa').val(campo.value).prop('disabled', true);
                break;

            default:
                $('#conversa').val('').prop('disabled', false);
                break;
        }

        formulario_atendimento()
    }
</script>
@endpush
