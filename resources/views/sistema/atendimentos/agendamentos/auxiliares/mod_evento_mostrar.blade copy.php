<form autocomplete='off' id='form-agendamentos-criar'>
<!-- <div class="modal fade" id="modal_lead_create" tabindex="-1" style="display: none;" aria-hidden="true"> -->
  <div class="modal-dialog">
    {{-- <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;"> --}}
      <div class="modal-content" style="height: 95%;">
      {{-- <div class="overlay" id="overlay_lead"></div> --}}
      <div class="modal-header" style="padding: 8px 16px; background-color: {{ $agendamento->color }}">
        <h4 class="modal-title">{{ $agendamento->xhooqvzhbgojbtg->apelido ?? 'Cliente'}}</h4>
        <div class="card-tools">
          <span class="badge badge-primary">({{ $agendamento->id ?? '#id'}})</span>
          <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
          <input type='hidden' id='id' value='{{ $agendamento->id }}'>
        </div>
      </div>
      <div class="modal-body p-2">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 order-1">
          {{-- <div class="col-12 col-md-12 col-lg-4 order-1"> --}}
            <div class="post">
              <div class="user-block pb-2">
                <img class="img-circle img-bordered-sm" src="{{ $agendamento->xhooqvzhbgojbtg->foto_perfil ?? asset('/img/atendimentos/pessoas/0.png') }}" alt="user image">
                <span class="username">
                  <a>{{ $agendamento->xhooqvzhbgojbtg->apelido ?? 'Cliente'}} ({{ $agendamento->id_cliente ?? '#id'}})</a>
                </span>
                <span class="description">{{ $agendamento->xhooqvzhbgojbtg->nome ?? 'Cliente'}} - {{ $agendamento->xhooqvzhbgojbtg->nascimento ?? 'Data de Nascimento'}}</span>
              </div>

              </br>
            
              <div class="clearfix p-1">
                <h7 class="d-block">Serviço</br>
                  <b>{{ $agendamento->zlpekczgsltqgwg->nome ?? 'Serviço'}}</b> (<span class="text-sm description">Duração: {{ \Carbon\Carbon::parse($agendamento->start)->diff($agendamento->end)->format('%H:%I') }}</span>)
                </h7>
              </div>

              <div class="clearfix p-1">
                <h7 class="d-block">Horário</br>
                  <b>{{ \Carbon\Carbon::parse($agendamento->start)->format("d/M") }} - {{ \Carbon\Carbon::parse($agendamento->start)->format("H:i") }} às {{ \Carbon\Carbon::parse($agendamento->end)->format("H:i") }}</b>
                </h7>
              </div>

              <div class="clearfix p-1">
                <h7 class="d-block">Profissional</br>
                  {!! $agendamento->hhmaqpijffgfhmj->foto_tabela ?? 'foto' !!} &nbsp; <b>{{ $agendamento->hhmaqpijffgfhmj->apelido ?? 'Profissional' }}</b>
                </h7>
              </div>

              <div class="clearfix p-1">
                <h7 class="d-block">Observação</br>
                <b>{{ $agendamento->obs ?? '-' }}</b>
                </h7>
              </div>

              <div class="clearfix p-1">
                <h7 class="d-block">Status</br>
                  <span class="badge badge-primary" style="background-color: {{ $agendamento->color }}; color: black;"><b>{{ $agendamento->status }}</b></span></b>
                </h7>
              </div>
              
              <div class="text-center pt-4">
                <!-- <a href="#" class="btn btn-sm" style="background-color: #FFFF66; width: 35px;" title="Agendado" >
                  <i class="fa-solid fa-calendar"></i>
                </a> -->
                <a href="#" class="btn btn-sm" style="background-color: lightsalmon; width: 35px;" title="Atrasado" onclick="agendamento_editar_status('Atrasado')">
                  <i class="fa-solid fa-plane-circle-xmark"></i>
                </a>
                <a href="#" class="btn btn-sm" style="background-color: lightgreen; width: 35px;" title="Chegou" onclick="agendamento_editar_status('Confirmado')">
                  <i class="fa-regular fa-calendar-check"></i>
                </a>
                <a href="#" class="btn btn-sm" style="background-color: lightblue; width: 35px;" title="Lançado" onclick="agendamento_editar_status('Finalizado')">
                  <i class="fa-solid fa-square-check"></i>
                </a>
                <a href="#" class="btn btn-sm" style="background-color: lightcoral; width: 35px;" title="Faltou" onclick="agendamento_editar_status('Faltou')">
                  <i class="fa-solid fa-person-circle-xmark"></i>
                </a>
                <!-- <a href="#" class="btn btn-sm" style="background-color: goldenrod; width: 35px;" title="Fixa" >
                  <i class="fa-regular fa-calendar-days"></i>
                </a> -->

                @if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
                <a href="#" class="btn btn-sm" style="background-color: black; color: white; width: 35px;" title="Excluir" onclick="agendamento_editar_status('EXCLUIR')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
                @endif
              </div>
            </div>
          </div>
          
          </br>

<!-- 

            <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamctcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
            <br>

            <h5 class="mt-5 text-muted">Project files</h5>
            <ul class="list-unstyled">
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
              </li>
            </ul>
            

            
          </div>
          <div class="col-12 col-md-12 col-lg-8 order-2">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Estimated budget</span>
                    <span class="info-box-number text-center text-muted mb-0">2300</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Total amount spent</span>
                    <span class="info-box-number text-center text-muted mb-0">2000</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Estimated project duration</span>
                    <span class="info-box-number text-center text-muted mb-0">20</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h4>Recent Activity</h4>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ $agendamento->xhooqvzhbgojbtg->foto_perfil ?? 'foto'}}" alt="user image">
                    <span class="username">
                      <a>Jonathan Burke Jr.</a>
                    </span>
                    <span class="description">Shared publicly - 7:45 PM today</span>
                  </div>
                  
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore.
                  </p>
                  <p>
                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                  </p>
                </div>
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ $agendamento->xhooqvzhbgojbtg->foto_perfil ?? 'foto'}}" alt="User Image">
                    <span class="username">
                      <a>Sarah Ross</a>
                    </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore.
                  </p>
                  <p>
                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                  </p>
                </div>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ $agendamento->xhooqvzhbgojbtg->foto_perfil ?? 'foto'}}" alt="user image">
                    <span class="username">
                      <a>Jonathan Burke Jr.</a>
                    </span>
                    <span class="description">Shared publicly - 5 days ago</span>
                  </div>
                  
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore.
                  </p>
                  <p>
                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v1</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
                   -->

        </div>
        

        
        


        

<!-- 
        <div class="row">
          <div class="col-3">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Nome</label>
                <input type="hidden" id="lead_create_status" value="entrada_lead">
                <input type="hidden" id="lead_create_id_consultor" value="{ Auth::User()->id }}">
                <input type="hidden" id="lead_create_turmas_interesse" value="">
                <input type="text" class="form-control form-control-sm" id="lead_create_nome" placeholder="Nome">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Telefone</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm text-right" id="lead_create_telefone" placeholder="Telefone">
                  <div class="input-group-append">
                    <a class="input-group-text" id="lead_create_link_whatsapp" target="_blank" data-bs-tooltip="tooltip" data-bs-title="Whatsapp" aria-label="Whatsapp">
                      <i class="fa-brands fa-whatsapp"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Cidade</label>
                <input type="text" class="form-control form-control-sm" id="lead_create_cidade" placeholder="Cidade" value="Caratinga">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Origem do Lead</label>
                <select class="form-control form-control-sm" id="lead_create_id_origem">
                  <option value="1"  >Assistente</option>
                  <option value="29" >Bing</option>
                  <option value="6"  >Book Fotográfico</option>
                  <option value="41" >BusDoor</option>
                  <option value="7"  >Campanha de Indicação</option>
                  <option value="18" >Carro de Som</option>
                  <option value="15" >Cartaz</option>
                  <option value="11" >Compre e Aplique</option>
                  <option value="3"  >Consultor Externo</option>
                  <option value="9"  >Corporativo</option>
                  <option value="42" >E-Mail Marketing</option>
                  <option value="25" >Facebook</option>
                  <option value="987">Facebook Lucas</option>
                  <option value="20" >Fachada</option>
                  <option value="16" >Faixa</option>
                  <option value="26" >Google</option>
                  <option value="104">Indicação de Ex-Aluno</option>
                  <option value="19" >Indicação Espontânea</option>
                  <option value="30" >Instagram</option>
                  <option value="21" >Internet/Site</option>
                  <option value="13" >Jornal</option>
                  <option value="22" >Lista Telefônica</option>
                  <option value="5"  >Mala Direta</option>
                  <option value="38" >Modelo</option>
                  <option value="17" >Muro</option>
                  <option value="14" >Outdoor</option>
                  <option value="33" >Outlook</option>
                  <option value="23" >Outros</option>
                  <option value="4"  >Panfletos</option>
                  <option value="43" >Parceria Prefeitura</option>
                  <option value="24" >Rádio</option>
                  <option value="35" >Recebimento de Transferência</option>
                  <option value="8"  >Renovações</option>
                  <option value="39" >Revista</option>
                  <option value="27" >Site da Franquia</option>
                  <option value="28" >SMS</option>
                  <option value="2"  >Telemarketing</option>
                  <option value="12" >TV</option>
                  <option value="32" >Twitter</option>
                  <option value="34" >Vendas Online</option>
                  <option value="10" >Visitas Antigas</option>
                  <option value="36" >WhatsApp</option>
                  <option value="40" >Workshop</option>
                  <option value="31" >Yahoo</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Interesse</label>
                <select class="form-control form-control-sm" id="lead_create_interesse">
                  <option value="frio" selected>Frio</option>
                  <option value="morno">Morno</option>
                  <option value="quente">Quente</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Observação</label>
                <textarea class="form-control form-control-sm" id="lead_create_obs" rows="2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-3 border-left">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Cursos/Turmas de Interesse</h6>
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <label class="m-0">Cursos Disponíveis</label>
                  <div class="col-sm-12">
                    <div class="form-group" id="lead_create_turmas_disponiveis">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                        <label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
                      </div> -->
                      <!-- <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked="">
                        <label for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled="">
                        <label for="customCheckbox3" class="custom-control-label">Custom Checkbox disabled</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" checked="">
                        <label for="customCheckbox4" class="custom-control-label">Custom Checkbox with custom color</label>
                      </div> -->
<!-- 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 border-left overflow-auto">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Conversas</h6>
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <label class="m-0">Registrar Conversa</label>
                  <div class="input-group">
                    <textarea class="form-control form-control-sm" id="lead_create_nova_conversa" rows="2"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row overflow-auto" id="lead_create_conversas" style="height: auto; max-height: 250px;">
            </div>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-info btn-block" id="label_create_entrada_lead" onclick="lead_definirStatus( 'entrada_lead' )"><strong>Entrada do Lead</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-primary btn-block" id="label_create_apresentacao_curso" onclick="lead_definirStatus( 'apresentacao_curso' )"><strong>Apresentação do Curso</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-secondary btn-block" id="label_create_proposta_enviada" onclick="lead_definirStatus( 'proposta_enviada' )"><strong>Proposta Enviada</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-dark btn-block" id="label_create_negociando_venda" onclick="lead_definirStatus( 'negociando_venda' )"><strong>Negociando</strong></button>
          </div> -->
          <!-- </div> -->
          <div class="row">
            <div class="col-12 col-md-4 col-lg-4 text-left text-sm-left text-md-left text-lg-left">
              <small>
                <strong>Cadastrado: </strong>{{ \Carbon\Carbon::parse($agendamento->created_at)->format("d/n/Y") }} às {{ \Carbon\Carbon::parse($agendamento->created_at)->format("H:i:s") }}
              </small>
            </div>
            <div class="col-12 col-md-4 col-lg-4 text-left text-sm-left text-md-center text-lg-center">
              <small>
              <strong>Por: </strong>{{ $agendamento->eiuroereuwnofiw->apelido }}
              </small>
            </div>
            <div class="col-12 col-md-4 col-lg-4 text-left text-sm-left text-md-right text-lg-right">
              <small>
                <strong>Última edição: </strong>{{ \Carbon\Carbon::parse($agendamento->updated_at)->format("d/n/Y") }} às {{ \Carbon\Carbon::parse($agendamento->updated_at)->format("H:i:s") }}
              </small>
            </div>
          </div>
        </div>
        <div class="modal-footer p-2">
          @if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
          <button type="button" class="btn btn-primary" onclick="agendamento_editar_dados('{{ $agendamento->id }}')">Editar</button>
          @endif
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  function agendamento_editar_status( status )
  {
    if(status != 'EXCLUIR')
    {
      url = "{{ route('atd.agendamentos.atualizar', ':id') }}";
      url = url.replace(':id', $('#id').val() );
      
      var dados = {
        status  : status,
      }

      axios.put( url, dados)
      .then(function(response)
      {
        // console.log(response)
        toastrjs(response.data.type, response.data.message);
      })
      @include('includes.catch', [ 'codigo_erro' => '6335621a' ] )
      .then(function ()
      {
        $('#modal-geral-1').modal('hide')

        setTimeout(function() {
          agendamentos_recarregar()
        }, 1000);
      })  
    }
    else
    {
      if(confirm("Confirmar a EXCLUSÃO do agendamento?"))
      {
        url = "{{ route('atd.agendamentos.excluir', ':id') }}";
        url = url.replace(':id', $('#id').val() );
      
        var dados = {
          status  : 'Excluído',
          _method : 'DELETE'
        }
    
        axios.post( url, dados)
        .then(function(response)
        {
          // console.log(response)
          toastrjs(response.data.type, response.data.message);
        })
        @include('includes.catch', [ 'codigo_erro' => '7830974a' ] )
        .then(function ()
        {
          $('#modal-geral-1').modal('hide')

          setTimeout(function() {
            agendamentos_recarregar()
          }, 1000);
        })  
      }
    }
  }

  function agendamento_editar_dados( id )
  {

    url = "{{ route('atd.agendamentos.editar', ':id') }}";
    url = url.replace(':id', $('#id').val() );
    
    axios.get( url)
    .then(function(response)
    {
      // console.log(response)
      setTimeout(function() {
        $('#modal-geral-1').empty().append(response.data)
      }, 1000);

    })
    @include('includes.catch', [ 'codigo_erro' => '1355618a' ] )
    .then(function ()
    {
      setTimeout(function() {
        agendamentos_recarregar()
      }, 1000);
    })  
  }
  </script>


<!-- 
<form autocomplete='off' id='form-agendamentos-criar'>
  <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
      <div class='modal-header' style='padding: 8px 16px; background-color: { $agendamento->color }}'>
        <h5 class='modal-title'>Agendamento: { $agendamento->id }}</h5>
        <input type='hidden' id='id' value='{ $agendamento->id }}'>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class='form-group'>
              <label>Cliente</label>
              <select class='form-control form-control-sm select2' name='id_cliente' readonly="true">
                <option value=''>Selecione o cliente . . .</option>
                foreach($clientes as $id => $cliente)
                <option value='{ $id }}' { $id == $agendamento->id_cliente ? 'selected' : 'x' }}>{ $cliente }}</option>
                endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class='form-group'>
              <label>Serviço</label>
              <select class='form-control form-control-sm select2' id='id_servprod' name='id_servprod' readonly="true">
                <option value=''>Selecione primeiro a origem . . .</option>
                foreach($servicos as $servico)
                <option value='{ $servico->id }}' { $servico->id == $agendamento->id_servprod ? 'selected' : '' }}>{ $servico->nome }}</option>
                endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Profissional</label>
              <input type='hidden' name='id_profexec' value='{ $agendamento->id_profexec }}'>
              <input type='text' class='form-control form-control-sm' value='{ $agendamento->hhmaqpijffgfhmj->nome }}' readonly="true">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Início</label>
              <input type='datetime-local' class='form-control form-control-sm' name='start' id='start' value='{ \Carbon\Carbon::parse($agendamento->start)->format("Y-m-d H:i:s") }}'  readonly="true">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Final</label>
              <input type='datetime-local' class='form-control form-control-sm' name='end' id='end' value='{ \Carbon\Carbon::parse($agendamento->end)->format("Y-m-d H:i:s") }}'  readonly="true">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Duração</label>
              <input type='time' class='form-control form-control-sm' id='duracao' readonly="true">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label>Observação</label>
            <input type='text' class='form-control form-control-sm' name='obs' value='{ $agendamento->obs }}' readonly="true">
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        
        <a class="btn btn-sm bg-orange"   onclick="agendamento_editar_status('Atrasado')"   style="color:white !important;">Atrasado</a>
        <a class="btn btn-sm btn-success" onclick="agendamento_editar_status('Confirmado')" >Chegou</a>
        <a class="btn btn-sm btn-primary" onclick="agendamento_editar_status('Finalizado')" >Lançado</a>
        <a class="btn btn-sm btn-danger"  onclick="agendamento_editar_status('Faltou')"     >Faltou</a>
        if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
          <a class="btn btn-sm bg-black"    onclick="agendamento_editar_status('EXCLUIR')"    style="color:white !important;">EXCLUIR</a>
        endif
      </div>
    </div>
  </div>
  
  <input type="hidden" name="valor"      id="valor"      value="">
  <input type="hidden" name="id_criador" id="id_criador" value="{ Auth::User()->id }}">
  <input type="hidden" name="status"     id="status"     value="Agendado">
  
</form>


<script type='text/javascript'>
//
$(document).ready(function()
{
  $('#submit-criar').hide()

  $('#duracao').val(
    moment({ 
      hour   : moment.duration(moment($('#end').val()).diff(moment($('#start').val())))._data.hours,
      minute : moment.duration(moment($('#end').val()).diff(moment($('#start').val())))._data.minutes
    }).format('HH:mm')
  )
})

$('#id_servprod').change(function()
{
  $('#submit-criar').hide()
  
  url = "{ route('cat.servicos.pesquisar', ':id') }}"
  url = url.replace(':id',  $('#id_servprod').val())

  axios.get(url)
  .then(function(response)
  {
    // console.log(response)
    $('#duracao').val(response.data.duracao)
        
    let duracao  = (response.data.duracao).split(':')
    let horas    = duracao[0]
    let minutos  = duracao[1]

    $('#end').val(moment($('#start').val()).add(horas, 'hours').add(minutos, 'minutes').format('YYYY-MM-DD HH:mm:ss'))
    $('#valor').val(response.data.vlr_venda)

  })
  @include('includes.catch', [ 'codigo_erro' => '4725464a' ] )
  .then()
  {
    setTimeout(() => 
    {
      $('#submit-criar').show()
    }, 2500)
  }
})

$('#submit-criar').click(function(event)
{
  event.preventDefault()

  dados = $('#form-agendamentos-criar').serialize()
  
  axios.post("{ route('atd.agendamentos.gravar') }}", dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
  @include('includes.catch', [ 'codigo_erro' => '6721469a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    agendamentos_recarregar()
  })
})


</script> -->
