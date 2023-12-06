<form autocomplete='off' id='form-agendamentos-criar'>
  <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content" style="height: 95%;">
      <div class="overlay" id="agendamento_criar_overlay"></div>
      <div class="modal-header" style="padding: 8px 16px;">
        <h4 class="modal-title">Criar Agendamento</span></h4>
        <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-4 order-1">
            <div class="post">
              <div class="user-block pb-2">
                <span class="username">
                  <div class='form-group'>
                    <label>Cliente</label>
                    <select class='form-control form-control-sm select2' name='id_cliente' onchange="cliente_selecionado(this)">
                      <option value=''>Selecione o cliente . . .</option>
                      @foreach($clientes as $id => $cliente)
                      <option value='{{ $id }}'>{{ $cliente }}</option>
                      @endforeach
                    </select>
                  </div>
                </span>
                <img class="img-circle img-bordered-sm" src="{{ asset('/img/atendimentos/pessoas/44.png') }}" alt="user image" id="cliente_image" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
                <span class="description"><span id="cliente_nome">{{ $agendamento->xhooqvzhbgojbtg->nome ?? 'Cliente'}}</span> - <span id="cliente_nascimento">{{ $agendamento->xhooqvzhbgojbtg->nascimento ?? 'Data de Nascimento'}}</span></span>
              </div>
              </br>
              
              <div class="clearfix p-1">
                <h7 class="d-block">Serviço
                  </br>
                  <select class='form-control form-control-sm select2' name='id_servico' onchange="servico_selecionado(this)">
                    <option value=''>Selecione o serviço . . .</option>
                    @foreach($servicos as $id => $servico)
                    <option value='{{ $id }}'>{{ $servico }}</option>
                    @endforeach
                  </select>
{{--                  <b>{{ $agendamento->zlpekczgsltqgwg->nome ?? 'Serviço'}}</b> (<span class="text-sm description">Duração: {{ \Carbon\Carbon::parse($agendamento->start)->diff($agendamento->end)->format('%H:%I') }}</span>)
                </h7>
              </div>
              
              <div class="clearfix p-1">
                <h7 class="d-block">Horário
                  </br>
{{--                  <b>{{ \Carbon\Carbon::parse($agendamento->start)->format("d/M") }} - {{ \Carbon\Carbon::parse($agendamento->start)->format("H:i") }} às {{ \Carbon\Carbon::parse($agendamento->end)->format("H:i") }}</b>--}}
                </h7>
              </div>
              
              <div class="clearfix p-1">
                <h7 class="d-block">Profissional
                  </br>
{{--                  {!! $agendamento->hhmaqpijffgfhmj->foto_tabela ?? 'foto' !!} &nbsp; <b>{{ $agendamento->hhmaqpijffgfhmj->apelido ?? 'Profissional' }}</b>--}}
                </h7>
              </div>
              
              <div class="clearfix p-1">
                <h7 class="d-block">Observação
                  </br>
{{--                  <b>{{ $agendamento->obs ?? '-' }}</b>--}}
                </h7>
              </div>
              
              <div class="clearfix p-1">
                <h7 class="d-block">Status
                  </br>
{{--                  <span class="badge badge-primary" style="background-color: {{ $agendamento->color }}; color: black;"><b>{{ $agendamento->status }}</b></span></b>--}}
                </h7>
              </div>
              
              <div class="text-center pt-4">
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
                
                @if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
                <a href="#" class="btn btn-sm" style="background-color: black; color: white; width: 35px;" title="Excluir" onclick="agendamento_editar_status('EXCLUIR')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
                @endif
              </div>
            </div>
          </div>
          </br> 
        </div>
      </div>
      <div class="modal-footer p-2">
        @if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Editar</button>
        @endif
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  $('.select2').select2({
    dropdownParent: $('#modal-geral-1'),
  });

  $('#agendamento_criar_overlay').hide();
})

function cliente_selecionado( campo )
{
  url = "{{ route('atd.pessoas.procurar', ':id') }}";
  url = url.replace(':id', campo.value );

  axios.get(url)
  .then(function(response)
  {
    console.log(response)
    asset = "{{ asset('/img/atendimentos/pessoas/:id.png') }}";
    asset = asset.replace(':id', response.data.id );

    $('#cliente_image').attr('src', asset)
    $('#cliente_image').attr('alt', 'asasasasasasas')
    $('#cliente_nome').text(response.data.nome)
    $('#cliente_nascimento').text(response.data.nascimento)

  })
@include('includes.catch', [ 'codigo_erro' => '3482037a' ] )
  .then(function ()
  {
    // $('#modal-geral-1').modal('hide')

    setTimeout(function() {
      agendamentos_recarregar()
    }, 1000);
  })
}

function agendamento_editar_status( status )
{
  if(status != 'EXCLUIR')
  {
{{--    url = "{{ route('atd.agendamentos.atualizar', ':id') }}";--}}
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
@include('includes.catch', [ 'codigo_erro' => '3917011a' ] )
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
{{--      url = "{{ route('atd.agendamentos.excluir', ':id') }}";--}}
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
  @include('includes.catch', [ 'codigo_erro' => '1279278a' ] )
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
</script>
