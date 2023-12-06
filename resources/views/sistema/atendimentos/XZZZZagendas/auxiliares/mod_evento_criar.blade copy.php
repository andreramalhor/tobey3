<form autocomplete='off' id='form-agendamentos-criar'>
  <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
      <div class='modal-header bg-navy' style='padding: 8px 16px'>
        <h5 class='modal-title'>Agendar Serviço</h5>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class='form-group'>
              <label>Cliente</label>
              <select class='form-control form-control-sm select2' name='id_cliente'>
                <option value=''>Selecione o cliente . . .</option>
                @foreach($clientes as $id => $cliente)
                <option value='{{ $id }}'>{{ $cliente }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class='form-group'>
              <label>Serviço</label>
              <select class='form-control form-control-sm select2' id='id_servprod' name='id_servprod'>
                <option value=''>Selecione primeiro a origem . . .</option>
                @foreach($servicos as $id => $servico)
                <option value='{{ $servico->id }}'>{{ $servico->nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Profissional</label>
              <input type='hidden' name='id_profexec' value='{{ $informacoes["resource"]["id"] }}'>
              <input type='text' class='form-control form-control-sm' value='{{ $informacoes["resource"]["title"] }}' readonly='readonly'>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Início</label>
              <input type='datetime-local' class='form-control form-control-sm' name='start' id='start' value='{{ \Carbon\Carbon::parse($informacoes["startStr"])->format("Y-m-d H:i:s") }}'  readonly='readonly'>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Final</label>
              <input type='datetime-local' class='form-control form-control-sm' name='end' id='end' value='{{ \Carbon\Carbon::parse($informacoes["endStr"])->format("Y-m-d H:i:s") }}'  readonly='readonly'>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Duração</label>
              <input type='time' class='form-control form-control-sm' id='duracao' readonly='readonly'>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label>Observação</label>
            <input type='text' class='form-control form-control-sm' name='obs'>
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        <a class='btn btn-primary' id='submit-criar'>Criar</a>
      </div>
    </div>
  </div>
  
  <input type="hidden" name="valor"      id="valor"      value="">
  <input type="hidden" name="id_criador" id="id_criador" value="{{ Auth::User()->id }}">
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
  
  url = "{{ route('cat.servicos.pesquisar', ':id') }}"
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
@include('includes.catch', [ 'codigo_erro' => '8422286a' ] )
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
  
  axios.post("{{ route('atd.agendamentos.gravar') }}", dados)
  .then(function(response)
  {
    console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '7364604a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    agendamentos_recarregar()
  })
})

</script>
