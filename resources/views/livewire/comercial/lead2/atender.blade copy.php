<div wire:ignore.self class="modal fade" id="modal-atender" aria-hidden="true">
  <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content">
      <div class="overlay" id="overlay-lead-mostrar"></div>
      <div class="modal-header border-0 p-2 
        @if(isset($lead) && $lead->interesse == 'frio')
          bg-info
        @elseif(isset($lead) && $lead->interesse == 'morno')
          bg-orange
        @elseif(isset($lead) && $lead->interesse == 'quente')
          bg-red
        @endif
        ">
        <h4 class="modal-title">Adicionar lead</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
      </div>
      <form wire:submit.prevent="save">
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
              <dl class="row">
                <dt class="col-sm-4">Consultor</dt>
                <dd class="col-sm-8">
                  {{ $lead->lskdfjweklwejrq->apelido ?? 'sem consultor definido' }}
                </dd>
                
                <dt class="col-sm-4">Empresa</dt>
                <dd class="col-sm-8">
                  {{ $lead->rfsdkfjwenfcbew->apelido ?? $lead->id_empresa }}
                </dd>
                
                <dt class="col-sm-4">Nome</dt>
                <dd class="col-sm-8">
                  {{ $lead->nome ?? $lead->id_empresa ?? 'Nome não informado' }}
                </dd>
                
                <dt class="col-sm-4">Telefone &nbsp;<a href="{{ $lead->link_whatsapp }}" target="_blank" data-bs-tooltip="tooltip" data-bs-title="Whatsapp" aria-label="Whatsapp"><i class="fa-brands fa-whatsapp"></i></a></dt>
                <dd class="col-sm-8">              
                  {{ $lead->telefone ?? 'sem telefone cadastrado' }}
                </dd>
                
                <dt class="col-sm-4">E-mail</dt>
                <dd class="col-sm-8">
                  <a href="mailto:{{ $lead->email }}" target="_blank">{{ $lead->email ?? '(sem e-mail cadastrado)' }}</a>
                </dd>
                
                <dt class="col-sm-4">Cidade</dt>
                <dd class="col-sm-8">
                  {{ $lead->cidade ?? 'sem cidade cadastrado' }}
                </dd>
                
                <dt class="col-sm-4">Origem do Lead</dt>
                <dd class="col-sm-8">
                  {{ $lead->origem ?? 'sem origem cadastrado' }}
                </dd>
                
                <dt class="col-sm-4">Interesse</dt>
                <dd class="col-sm-8">
                  <select class="form-control form-control-sm form-control-border" name="interesse">
                    <option {{ $lead->interesse == 'frio' ? 'selected' : '' }} value="frio">Frio</option>
                    <option {{ $lead->interesse == 'morno' ? 'selected' : '' }} value="morno">Morno</option>
                    <option {{ $lead->interesse == 'quente' ? 'selected' : '' }} value="quente">Quente</option>
                  </select>
                </dd>
                
                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                  <select class="form-control form-control-sm form-control-border" name="status">
                    <option value="....">....</option>
                    <option {{ $lead->status == 'possibilidades' ? 'selected' : '' }} value="possibilidades">Possibilidades</option>
                  </select>
                </dd>
              </dl>
              
            </div>
            <div class="col-5 border-left overflow-auto">
              <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Conversas</h6>
              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-3">
                    <label class="m-0">Registrar Conversa</label>
                    <div class="input-group">
                      <textarea class="form-control form-control-sm" name="fghtvxswwryiiil[conversa]" rows="2"></textarea>
                      <span class="input-group-append">
                        <a class="input-group-text bg-primary" href="#" data-bs-tooltip="tooltip" data-bs-title="Adicionar" aria-label="Adicionar" onclick="lead_novaConversa()">
                          <i class="fa-solid fa-check"></i>
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row overflow-auto" style="height: auto; max-height: 250px;" id="lead_create_conversas">
                @forelse($lead->fghtvxswwryiiil->sortByDesc('created_at') as $conversa)
                <li class="mb-1">{{ $conversa->conversa }}
                  <br>
                  <small>
                    <strong>
                      ({{ \Carbon\Carbon::parse($conversa->created_at)->format('d/m/Y H:i') }})
                    </strong>
                  </small>
                </li>
                @empty
                <li class="mb-1">
                  <small>
                    Não há registro de conversas
                  </small>
                </li>
                @endforelse
              </div>
            </div>
            <div class="col-3 border-left overflow-auto">
              <form id="form_atendimento">
                <h6 class="text-center m-0 mb-3" style="border-bottom: 1px solid lightgray;">Atendimento</h6>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-12">
                          <a href="#" class="btn btn-primary" id="tipo_atendimento_ligacao_telefonica" onclick="lead_tipo_atendimento('ligacao_telefonica')"><i class="fas fa-headset"></i></a>
                          <!-- <a href="#" class="btn btn-default" id="tipo_atendimento_email"              onclick="lead_tipo_atendimento('email')"><i class="fas fa-at"></i></a> -->
                          <!-- <a href="#" class="btn btn-default" id="tipo_atendimento_pessoalmente"       onclick="lead_tipo_atendimento('pessoalmente')"><i class="fas fa-bell-concierge"></i></a> -->
                          <!-- <a href="#" class="btn btn-default" id="tipo_atendimento_sms"                onclick="lead_tipo_atendimento('sms')"><i class="fas fa-comment-sms"></i></a> -->
                          <!-- <a href="#" class="btn btn-default" id="tipo_atendimento_whatsapp"           onclick="lead_tipo_atendimento('whatsapp')"><i class="fab fa-whatsapp"></i></a> -->
                        </div>
                      </div>
                      <span id="div_lead_tipo_atendimento_ligacao_telefonica">
                        </span>
                        
                        <span id="div_lead_tipo_atendimento_email" class="d-none">
                          </span>
                          
                          <span id="div_lead_tipo_atendimento_pessoalmente" class="d-none">
                            </span>
                            
                            <span id="div_lead_tipo_atendimento_sms" class="d-none">
                              </span>
                              
                              <span id="div_lead_tipo_atendimento_whatsapp" class="d-none">
                                </span>
                                
                              </div>
                            </div>
                          </div>
                        </form>
                        <div class="row">
                          <div class="form-group mt-3">
                            <small class="float-end">Finalize o agendamento para ir para o próximo</small>
                            <br>
                            <button type="button" id="btn-proximo" class="btn btn-primary disabled float-end" onclick="lead_proximo({{ $lead->id }})">Próximo lead</button>
                          </div>
                        </div>
                      </div>
                    </br>
                    <div class="row">
                      <div class="col-4 text-left">
                        <small>
                          <strong>Cadastrado: </strong><span>{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y H:i') }}</span>
                        </small>
                      </div>
                      <div class="col-4 text-center">
                        <small>
                          <span>0</span> dias sem atualização
                        </small>
                      </div>
                      <div class="col-4 text-right">
                        <small>
                          <strong>Última atualização: </strong><span>{{ \Carbon\Carbon::parse($lead->updated_at)->format('d/m/Y H:i') }}</span>
                        </small>
                      </div>
                    </div>
                  </div>
                  {{--
                    <div class="modal-footer p-2">
                      <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                    </div>
                    --}}
                  </div>
                </div>
                        
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- 
                <script type="text/javascript">
                  
                  function lead_tipo_atendimento( item )
                  {
                    switch (item)
                    {
              case 'ligacao_telefonica':
                $('#div_lead_tipo_atendimento_ligacao_telefonica').empty().append(
                '<dl class="row">'+
                  '</dt>'+
                  '<dt class="col-sm-12">'+
                    '<div class="form-check">'+
                      '<input class="form-check-input" type="radio" name="agendamento" onclick="lead_verifica_proximo()" value="nao_tem_interesse" id="nao_tem_interesse">'+
                      '<label class="form-check-label" for="nao_tem_interesse">Não tem interesse</label>'+
                    '</div>'+
                  '</dt>'+
                  '<dt class="col-sm-12">'+
                    '<div class="form-check">'+
                      '<input class="form-check-input" type="radio" name="agendamento" onclick="lead_verifica_proximo()" value="retornar_ligacao_dia" id="retornar_ligacao_dia">'+
                      '<label class="form-check-label" for="retornar_ligacao_dia">Retornar ligação dia</label>'+
                    '</div>'+
                  '</dt>'+
                  '<dt class="col-sm-12">'+
                    '<div class="form-check">'+
                      '<input class="form-check-input" type="radio" name="agendamento" onclick="lead_verifica_proximo()" value="chama_nao_atende" id="chama_nao_atende">'+
                      '<label class="form-check-label" for="chama_nao_atende">Chama e não atende</label>'+
                    '</div>'+
                  '</dt>'+
                  '<dt class="col-sm-12">'+
                    '<div class="form-check">'+
                      '<input class="form-check-input" type="radio" name="agendamento" onclick="lead_verifica_proximo()" value="numero_inexistente" id="numero_inexistente">'+
                      '<label class="form-check-label" for="numero_inexistente">Número inexistente</label>'+
                    '</div>'+
                  '</dt>'+
                  '</hr>'+
                  '<dt class="col-sm-6">'+
                    '<div class="form-check">'+
                      '<label class="form-check-label">Data de retorno</label>'+
                    '</div>'+
                  '</dt>'+
                  '<dd class="col-sm-6">'+
                    '<input type="datetime-local" class="form-control form-control-sm form-control-border" name="dt_retorno" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">'+
                  '</dd>'+
                  '<dt class="col-sm-6">'+
                    '<div class="form-check">'+
                      '<label class="form-check-label">Motivo do não interesse</label>'+
                    '</div>'+
                  '</dt>'+
                  '<dd class="col-sm-6">'+
                    '<select class="form-control form-control-sm form-control-border" name="motivo">'+
                      '<option>Dados de contato informados incorretos</option>'+
                      '<option>Duração do curso muito longo</option>'+
                      '<option>Fechou matricula com um concorrente</option>'+
                      '<option>Lead não atende</option>'+
                      '<option>Outro</option>'+
                      '<option>Preço do curso muito alto</option>'+
                      '<option>Unidade incorreta (transferido para outra franquia)</option>'+
                      '<option>Unidade muito longe</option>'+
                      '<option>Unidade não tem o curso de interesse</option>'+
                    '</select>'+
                  '</dd>'+
                '</dl>');

                $('#div_lead_tipo_atendimento_email').empty()
                $('#div_lead_tipo_atendimento_pessoalmente').empty()
                $('#div_lead_tipo_atendimento_sms').empty()
                $('#div_lead_tipo_atendimento_whatsapp').empty()
                
                $('#tipo_atendimento_ligacao_telefonica')                 .removeClass('btn-default').addClass('btn-primary')
                $('#tipo_atendimento_email')                              .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_pessoalmente')                       .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_sms')                                .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_whatsapp')                           .removeClass('btn-primary').addClass('btn-default')
                break;

              case 'email':
                $('#div_lead_tipo_atendimento_ligacao_telefonica').empty()
                $('#div_lead_tipo_atendimento_email')                     .removeClass('d-none').addClass('d-block')
                $('#div_lead_tipo_atendimento_pessoalmente')              .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_sms')                       .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_whatsapp')                  .removeClass('d-block').addClass('d-none')

                $('#tipo_atendimento_ligacao_telefonica')                 .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_email')                              .removeClass('btn-dafault').addClass('btn-primary')
                $('#tipo_atendimento_pessoalmente')                       .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_sms')                                .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_whatsapp')                           .removeClass('btn-primary').addClass('btn-default')
                break;

              case 'pessoalmente':
                $('#div_lead_tipo_atendimento_ligacao_telefonica').empty()
                $('#div_lead_tipo_atendimento_email')                     .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_pessoalmente')              .removeClass('d-none').addClass('d-block')
                $('#div_lead_tipo_atendimento_sms')                       .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_whatsapp')                  .removeClass('d-block').addClass('d-none')

                $('#tipo_atendimento_ligacao_telefonica')                 .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_email')                              .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_pessoalmente')                       .removeClass('btn-dafault').addClass('btn-primary')
                $('#tipo_atendimento_sms')                                .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_whatsapp')                           .removeClass('btn-primary').addClass('btn-default')
                break;
                
              case 'sms':
                $('#div_lead_tipo_atendimento_ligacao_telefonica').empty()
                $('#div_lead_tipo_atendimento_email')                     .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_pessoalmente')              .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_sms')                       .removeClass('d-none').addClass('d-block')
                $('#div_lead_tipo_atendimento_whatsapp')                  .removeClass('d-block').addClass('d-none')

                $('#tipo_atendimento_ligacao_telefonica')                 .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_email')                              .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_pessoalmente')                       .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_sms')                                .removeClass('btn-dafault').addClass('btn-primary')
                $('#tipo_atendimento_whatsapp')                           .removeClass('btn-primary').addClass('btn-default')
                break;
                
              case 'whastapp':
                $('#div_lead_tipo_atendimento_ligacao_telefonica').empty()
                $('#div_lead_tipo_atendimento_email')                     .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_pessoalmente')              .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_sms')                       .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_whatsapp')                  .removeClass('d-none').addClass('d-block')

                $('#tipo_atendimento_ligacao_telefonica')                 .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_email')                              .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_pessoalmente')                       .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_sms')                                .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_whatsapp')                           .removeClass('btn-dafault').addClass('btn-primary')
                break;
                
              default:
                $('#div_lead_tipo_atendimento_ligacao_telefonica')        .removeClass('d-none').addClass('d-block')
                $('#div_lead_tipo_atendimento_email')                     .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_pessoalmente')              .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_sms')                       .removeClass('d-block').addClass('d-none')
                $('#div_lead_tipo_atendimento_whatsapp')                  .removeClass('d-block').addClass('d-none')

                $('#tipo_atendimento_ligacao_telefonica')                 .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_email')                              .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_pessoalmente')                       .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_sms')                                .removeClass('btn-primary').addClass('btn-default')
                $('#tipo_atendimento_whatsapp')                           .removeClass('btn-primary').addClass('btn-default')
                break;
            }
}

function lead_verifica_proximo()
{
  $('#btn-proximo').removeClass('disabled')
}

async function lead_proximo()
{
  $('#overlay-lead-mostrar-{{ $lead->id }}').show();
  
  try
  {
    var teste = await lead_gravar_atendimento();
    
    if (teste)
    {
      if ("{{ $proximo }}" == 'undefined')
      {
        window.location.href = "{{ route('com.leads') }}";
      }
      else
      {
        $('#modal-geral-' + (id_mdl - 1)).modal('hide');
        $('#lead_linha_{{ $proximo }}').click();
      }
    }
    else
    {
      toastrjs('warning', 'Preencha todos os campos');
      alert('erros');
    }
  }
  catch (error)
  {
    console.error(error);
  }
}

async function lead_gravar_atendimento()
{
  return new Promise((resolve, reject) => {
    dados = $('#form_atendimento').serialize();
    
    if ($('#form_atendimento').serializeArray().length < 3)
    {
      $('#btn-proximo').addClass('disabled');
      reject(false);
    }
    
    var url = "{{ route('com.leads.d_atendimento', ':id') }}";
    var url = url.replace(':id', "{{ $lead->id }}");
    
    axios.post(url, dados)
    .then(function(response)
    {
      toastrjs(response.data.type, response.data.message);
      resolve(true);
    })
    .catch(function(error)
    {
      console.error(error);
      reject(false);
    })
    .then(function()
    {
      // Lógica adicional após a resolução da promessa
    });
  });
}

</script>
 -->
