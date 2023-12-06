<div class="modal fade" id="modal_lead_create" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content" style="height: 95%;">
      {{-- <div class="overlay" id="overlay_lead"></div> --}}
      <div class="modal-header border-0 p-2">
        <h4 class="modal-title">Cadastrar novo Lead</span></h4>
        <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="row">
          <div class="col-3">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Nome</label>
                <input type="hidden" id="lead_create_status" value="entrada_lead">
                <input type="hidden" id="lead_create_id_consultor" value="{{ Auth::User()->id }}">
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
                      </div>
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
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="lead_create()">Cadastrar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">
lead_definirStatus( 'entrada_lead' )
lead_turmas()
turmas_interesse = [];

function lead_turmas()
{
  var url = "{{ route('ped.turmas.pegar') }}"

  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    $("#lead_create_turmas_disponiveis").empty()
    collect(response.data).groupBy('id_curso').each((curso) =>
    {
    //   console.log('curso')
      $('#lead_create_turmas_disponiveis').append('<small><strong>'+curso.items[0].cbntdakklaoyfih.nome+'</strong></small>')
      collect(curso).sortBy('sigla').each((turma) =>
      {
        // console.log(turma)
        $("#lead_create_turmas_disponiveis").append(
        '<div class="form-check">'+
            '<input class="form-check-input" type="checkbox" id="'+turma.cod+'" value="'+turma.cod+'" onchange="lead_turmas_interesse(this)">'+
            '<label class="form-check-label "for="'+turma.cod+'">'+turma.sigla+ '<small>('+moment(turma.dt_inicio).format('DD/MM/YYYY')+' - '+turma.horario+')</small></label>'+
        '</div>')


        // '<div class="custom-control custom-checkbox">'+
        //   '<input class="custom-control-input" type="checkbox" id="'+turma.cod+'" value="'+turma.cod+'">'+
        //   '<label for="'+turma.cod+'" class="custom-control-label" style="font-weight: 400;">'+turma.sigla+ '<small>('+moment(turma.dt_inicio).format('DD/MM/YYYY')+' - '+turma.horario+')</small></label>'+
        // '</div>')
      })
    });
  })
@include('includes.catch', [ 'codigo_erro' => '2849499a' ] )
  .then( function()
  {
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_create( )
{
  $('#overlay_lead').show()
  $('#modal_lead').modal('show')

  var dados = {
    nome:             $('#lead_create_nome').val(),
    telefone:         $('#lead_create_telefone').val(),
    cidade:           $('#lead_create_cidade').val(),
    interesse:        $("#lead_create_interesse").val(),
    id_origem:        $("#lead_create_id_origem").val(),
    status:           $("#lead_create_status").val(),
    id_consultor:     $("#lead_create_id_consultor").val(),
    obs:              $("#lead_create_obs").val(),
    nova_conversa:    $('#lead_create_nova_conversa').val(),
    nova_conversa:    $('#lead_create_nova_conversa').val(),
    turmas_interesse: turmas_interesse
}

  var url = "{{ route('com.leads.create') }}"

  axios.post(url, dados)
  .then( function(response)
  {
    // console.log(response)
    // $("#lead_create_id2").empty().text(response.data.id)
//     $("#lead_create_nome2").empty().text(response.data.nome)

//     $("#lead_create_id").empty().val(response.data.id)


//     $("#lead_create_status").empty().text(response.data.status)
//     $("#lead_create_created_at").empty().text(moment(response.data.created_at).format('DD/MM/YYYY [às] HH:mm')+'h')
//     $("#lead_create_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
//     $("#lead_create_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))

//     $("#lead_create_nova_conversa").val('')

//     lead_mostrarConversas( response.data.fghtvxswwryiiil )

//     var tipos_status = ['entrada_lead', 'apresentacao_curso', 'proposta_enviada', 'negociando_venda' ]
//     collect(tipos_status).each((tipo_status) =>
//     {
//       if (response.data.status == tipo_status )
//       {
//         $('#label_create_'+tipo_status+'').css({'cursor': 'auto', 'opacity' : '10%', 'color' : 'black' })
//         $('#label_create_'+tipo_status+'').removeAttr("onclick")
//       }
//       else
//       {
//         $('#label_create_'+tipo_status+'').css({'cursor': 'pointer', 'opacity' : '100%', 'color' : 'white' })
//         $('#label_create_'+tipo_status+'').attr('onclick', "lead_definirStatus('" + tipo_status + "')")
//       }
//     })

//     if (response.data.status) {}
//     $("#lead_create_status").empty().text(response.data.status)

  })
@include('includes.catch', [ 'codigo_erro' => '3311884a' ] )
  .then( function()
  {
    lead_fichas()
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_mostrarConversas( conversas )
{
  $("#lead_create_conversas").empty()
  collect( conversas ).sortByDesc('created_at').each((conversa) =>
  {
    // console.log(conversa)
    $("#lead_create_conversas").append(
    '<li class="mb-1">'+conversa.conversa+' <small><strong>('+moment(conversa.created_at).format('DD/MM/YYYY [às] HH:mm')+'h'+')</strong></small></li>'
    )
  })
}

function lead_mudarInteresse( )
{
  $('#overlay_lead').show()

  var dados = {
    interesse : $('#lead_create_interesse').val(),
  }

  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', $("#lead_create_id").val())

  axios.put(url, dados)
  .then( function(response)
  {
    console.log(response)
    $("#lead_create_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_create_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))
  })
@include('includes.catch', [ 'codigo_erro' => '4608162a' ] )
  .then( function()
  {
    lead_fichas()
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_novaConversa( )
{
  $('#overlay_lead').show()

  var dados = {
    conversa : $('#lead_create_nova_conversa').val(),
  }

  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', $("#lead_create_id").val())

  axios.put(url, dados)
  .then( function(response)
  {
    // console.log(response)
    lead_mostrarConversas( response.data.fghtvxswwryiiil )
    $("#lead_create_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_create_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))
  })
@include('includes.catch', [ 'codigo_erro' => '7046692a' ] )
  .then( function()
  {
    $("#lead_create_nova_conversa").val('')
    lead_fichas()
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_definirStatus( item )
{
  var status = $("#lead_create_status").val(item)

  var tipos_status = ['entrada_lead', 'apresentacao_curso', 'proposta_enviada', 'negociando_venda' ]
  collect(tipos_status).each((tipo_status) =>
  {
    if (status.val() == tipo_status )
    {
      $('#label_create_'+tipo_status+'').addClass('disabled')
      switch (tipo_status)
      {
        case 'entrada_lead':
          $('#label_create_'+tipo_status+'').addClass('btn-info').removeClass('btn-outline-info')
          break
        case 'apresentacao_curso':
          $('#label_create_'+tipo_status+'').addClass('btn-primary').removeClass('btn-outline-primary')
          break
        case 'proposta_enviada':
          $('#label_create_'+tipo_status+'').addClass('btn-secondary').removeClass('btn-outline-secondary')
          break
        case 'negociando_venda':
          $('#label_create_'+tipo_status+'').addClass('btn-dark').removeClass('btn-outline-dark')
          break
      }
    }
    else
    {
      $('#label_create_'+tipo_status+'').removeClass('disabled')
      switch (tipo_status)
      {
        case 'entrada_lead':
          $('#label_create_'+tipo_status+'').removeClass('btn-info').addClass('btn-outline-info')
          break
        case 'apresentacao_curso':
          $('#label_create_'+tipo_status+'').removeClass('btn-primary').addClass('btn-outline-primary')
          break
        case 'proposta_enviada':
          $('#label_create_'+tipo_status+'').removeClass('btn-secondary').addClass('btn-outline-secondary')
          break
        case 'negociando_venda':
          $('#label_create_'+tipo_status+'').removeClass('btn-dark').addClass('btn-outline-dark')
          break
      }
    }
  })
}

function lead_turmas_interesse(item)
{
    if ($(item).is(':checked'))
    {
        turmas_interesse.push(item.value)
        $('#lead_create_turmas_interesse').val(turmas_interesse)
    }
    else
    {
        turmas_interesse.splice( $.inArray((item.value),turmas_interesse) ,1 )
        $('#lead_create_turmas_interesse').val(turmas_interesse)
    }
}

</script>
@endpush
