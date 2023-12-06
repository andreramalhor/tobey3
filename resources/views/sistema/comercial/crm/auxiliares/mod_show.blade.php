<div class="modal fade" id="modal_lead_show" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content" style="height: 95%;">
      <div class="overlay" id="overlay_lead"></div>
      <div class="modal-header border-0 p-2">
        <h4 class="modal-title"><span id="lead_id2">#ID</span> - <span id="lead_nome2">Nome</span></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="row"> {{-- style="min-height: 100px" --}}
          <div class="col-3"> {{-- 443px --}}
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Consultor</label>
                <input type="text" class="form-control form-control-sm" id="lead_consulor" disabled>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Nome</label>
                <input type="hidden" id="lead_id">
                <input type="text" class="form-control form-control-sm" id="lead_nome" disabled>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Telefone</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm text-right" id="lead_telefone" disabled>
                  <div class="input-group-append">
                    <a class="input-group-text" href="" id="lead_link_whatsapp" target="_blank" data-bs-tooltip="tooltip" data-bs-title="Whatsapp" aria-label="Whatsapp">
                      <i class="fa-brands fa-whatsapp"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Cidade</label>
                <input type="text" class="form-control form-control-sm" id="lead_cidade" value="Gov. Valadares" disabled>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Origem do Lead</label>
                <input type="text" class="form-control form-control-sm" id="lead_origem" disabled>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Interesse</label>
                <select class="form-control form-control-sm" id="lead_interesse" onchange="lead_mudarInteresse()">
                  <option value="frio">Frio</option>
                  <option value="morno">Morno</option>
                  <option value="quente">Quente</option>
                </select>
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
                    <div class="form-group" id="lead_turmas_disponiveis">
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
                    <textarea class="form-control form-control-sm" id="lead_nova_conversa" rows="2"></textarea>
                    <span class="input-group-append">
                      <a class="input-group-text bg-primary" href="" data-bs-tooltip="tooltip" data-bs-title="Adicionar" aria-label="Adicionar" onclick="lead_novaConversa()">
                        <i class="fa-solid fa-check"></i>
                      </a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row overflow-auto" id="lead_conversas" style="height: auto; max-height: 250px;">
            </div>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="col-4 text-left">
            <small>
              <strong>Cadastrado: </strong><span id="lead_created_at">01/01/2000 às 12:12h</span>
            </small>
          </div>
          <div class="col-4 text-center">
            <small>
              <span id="lead_updated_at_d">0</span> sem atualização
            </small>
          </div>
          <div class="col-4 text-right">
            <small>
              <strong>Última atualização: </strong><span id="lead_updated_at">01/01/2000 às 12:12h</span>
            </small>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-info btn-block" id="label_entrada_lead" onclick="lead_mudarStatus( 'entrada_lead' )"><strong>Entrada do Lead</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-primary btn-block" id="label_apresentacao_curso" onclick="lead_mudarStatus( 'apresentacao_curso' )"><strong>Apresentação do Curso</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-secondary btn-block" id="label_proposta_enviada" onclick="lead_mudarStatus( 'proposta_enviada' )"><strong>Proposta Enviada</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-dark btn-block" id="label_negociando_venda" onclick="lead_mudarStatus( 'negociando_venda' )"><strong>Negociando</strong></button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 p-1">
            <button type="button" class="btn btn-outline-danger btn-block" id="label_perdido" onclick="lead_mudarStatus( 'perdido' )"><strong>Perdido</strong></button>
          </div>
          <div class="col-md-6 p-1">
            <button type="button" class="btn btn-outline-success btn-block" id="label_ganho" onclick="lead_mudarStatus( 'ganho' )"><strong>Ganho</strong></button>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">
function lead_modal( id )
{
    var turmas_interesse = [];

    $('#overlay_lead').show()
    $('#modal_lead_show').modal('show')

  var url = "{{ route('com.leads.mostrar', ':idd') }}"
  var url = url.replace(':idd', id)

  axios.get(url)
  .then( function(response)
  {
        // console.log(response)
        collect(response.data.sfwmfkmrbeesfsd).each((turma) =>
        {
          turmas_interesse.push(turma.asjfeiemwerfewr)
        })

        lead_turmas(turmas_interesse)

    $("#lead_id2").empty().text(response.data.id)
    $("#lead_nome2").empty().text(response.data.nome)

    $("#lead_id").empty().val(response.data.id)
    $("#lead_nome").empty().val(response.data.nome)
    $("#lead_consulor").empty().val(response.data.lskdfjweklwejrq.nome)
    $("#lead_telefone").empty().val(response.data.telefone)
    $("#lead_link_whatsapp").attr('href', response.data.link_whatsapp)
    $("#lead_origem").empty().val(response.data.origem)
    $("#lead_interesse").val(response.data.interesse)


    $("#lead_status").empty().text(response.data.status)
    $("#lead_created_at").empty().text(moment(response.data.created_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))

    $("#lead_nova_conversa").val('')

    lead_mostrarConversas( response.data.fghtvxswwryiiil )

    var tipos_status = ['entrada_lead', 'apresentacao_curso', 'proposta_enviada', 'negociando_venda' ]
    collect(tipos_status).each((tipo_status) =>
    {
      if (response.data.status == tipo_status )
      {
        $('#label_'+tipo_status+'').addClass('disabled')
        switch (tipo_status)
        {
            case 'entrada_lead':
                $('#label_'+tipo_status+'').addClass('btn-info').removeClass('btn-outline-info');
                break;
            case 'apresentacao_curso':
                $('#label_'+tipo_status+'').addClass('btn-primary').removeClass('btn-outline-primary');
                break;
            case 'proposta_enviada':
                $('#label_'+tipo_status+'').addClass('btn-secondary').removeClass('btn-outline-secondary');
                break;
            case 'negociando_venda':
                $('#label_'+tipo_status+'').addClass('btn-dark').removeClass('btn-outline-dark');
                break;
        }
      }
      else
      {
        $('#label_'+tipo_status+'').removeClass('disabled')
        switch (tipo_status)
        {
          case 'entrada_lead':
            $('#label_'+tipo_status+'').removeClass('btn-info').addClass('btn-outline-info')
            break;
          case 'apresentacao_curso':
            $('#label_'+tipo_status+'').removeClass('btn-primary').addClass('btn-outline-primary')
            break;
          case 'proposta_enviada':
            $('#label_'+tipo_status+'').removeClass('btn-secondary').addClass('btn-outline-secondary')
            break;
          case 'negociando_venda':
            $('#label_'+tipo_status+'').removeClass('btn-dark').addClass('btn-outline-dark')
            break;
        }
      }
    })

    $("#lead_status").empty().text(response.data.status)

  })
@include('includes.catch', [ 'codigo_erro' => '3054435a' ] )
  .then( function()
  {
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_mostrarConversas( conversas )
{
  $("#lead_conversas").empty()
  collect( conversas ).sortByDesc('created_at').each((conversa) =>
  {
    // console.log(conversa)
    $("#lead_conversas").append(
    '<li class="mb-1">'+conversa.conversa+' <small><strong>('+moment(conversa.created_at).format('DD/MM/YYYY [às] HH:mm')+'h'+')</strong></small></li>'
    )
  })
}

function lead_mudarInteresse( )
{
  $('#overlay_lead').show()

  var dados = {
    interesse : $('#lead_interesse').val(),
  }

  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', $("#lead_id").val())

  axios.put(url, dados)
  .then( function(response)
  {
    // console.log(response)
    $("#lead_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))
  })
@include('includes.catch', [ 'codigo_erro' => '4826075a' ] )
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
    conversa : $('#lead_nova_conversa').val(),
  }

  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', $("#lead_id").val())

  axios.put(url, dados)
  .then( function(response)
  {
    // console.log(response)
    lead_mostrarConversas( response.data.fghtvxswwryiiil )
    $("#lead_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))
  })
@include('includes.catch', [ 'codigo_erro' => '8118240a' ] )
  .then( function()
  {
    $("#lead_nova_conversa").val('')
    lead_fichas()
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_mudarStatus( item )
{
  $('#overlay_lead').show()

  var id   = $("#lead_id").val()
  var dados = {
    status: item,
  }

  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', id)

  axios.put(url, dados)
  .then( function(response)
  {
    // console.log(response)
    $("#lead_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))
  })
@include('includes.catch', [ 'codigo_erro' => '2235491a' ] )
  .then( function()
  {
    lead_fichas()
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
    $('#modal_lead_show').modal('hide')
  })
}


function lead_turmas(turmas)
{
    // console.log(turmas)
    var url = "{{ route('ped.turmas.pegar') }}"

    axios.get(url)
    .then( function(response)
    {
        // console.log(response)
        turmas_inter = turmas.concat(response.data)

        $("#lead_turmas_disponiveis").empty()
        collect(turmas_inter).unique('cod').groupBy('id_curso').each((curso) =>
        {
            // console.log(curso)
            $('#lead_turmas_disponiveis').append('<small><strong>'+curso.items[0].cbntdakklaoyfih.nome+'</strong></small>')

            collect(curso).sortBy('sigla').each((turma) =>
            {
                // console.log(turmas)
                existe = turmas.filter((value, key) => value.cod == turma.cod);
                checar = collect(existe).count() > 0 ? 'checked' : ''

                $("#lead_turmas_disponiveis").append(
                    '<div class="form-check">'+
                        '<input class="form-check-input" type="checkbox" id="lead_turma_interesse_'+turma.cod+'" value="'+turma.cod+'" onchange="lead_turmas_interesse(this)" '+ checar+'>'+
                        '<label class="form-check-label "for="'+turma.cod+'">'+turma.sigla+ '<small>('+moment(turma.dt_inicio).format('DD/MM/YYYY')+' - '+turma.horario+')</small></label>'+
                    '</div>')

                //             var interesse_turma  = tem ? 'checked' : '' ;


            //             //         // '<div class="custom-control custom-checkbox">'+
            //                 //             //   '<input class="custom-control-input" type="checkbox" id="'+turma.cod+'" value="'+turma.cod+'">'+
            //                 //             //   '<label for="'+turma.cod+'" class="custom-control-label" style="font-weight: 400;">'+turma.sigla+ '<small>('+moment(turma.dt_inicio).format('DD/MM/YYYY')+' - '+turma.horario+')</small></label>'+
            //                 //         // '</div>')
            })
        });
    })
    @include('includes.catch', [ 'codigo_erro' => '6625998a' ] )
    .then( function()
    {
        setTimeout(() => {
            $('#overlay_lead').hide()
        }, 500 )
    })
}

function lead_turmas_interesse(item)
{
  if ($(item).is(':checked'))
  {
    var id   = $("#lead_id").val()
    var dados = {
        turma: item.value,
        tipo:  'on',
    }

    var url  = "{{ route('com.leads.atualizar', ':idd') }}"
    var url  = url.replace(':idd', id)

    axios.put(url, dados)
    .then( function(response)
    {
      // console.log(response)
    })
    @include('includes.catch', [ 'codigo_erro' => '1168620a' ] )
  }
  else
  {
    var id   = $("#lead_id").val()
    var dados = {
        turma: item.value,
        tipo:  'off',
    }

    var url  = "{{ route('com.leads.atualizar', ':idd') }}"
    var url  = url.replace(':idd', id)

    axios.put(url, dados)
    .then( function(response)
    {
      console.log(response)
    })
    @include('includes.catch', [ 'codigo_erro' => '7316137a' ] )
  }
}
</script>
@endpush
