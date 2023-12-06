<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_agendamento_show">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      {{-- <div class="overlay" id="overlay_show"> --}}
        {{-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> --}}
      {{-- </div> --}}
      <div class="modal-header">
        <h4 class="modal-title" id="MS_titulo_modal">Agendamento: #</h4><span id="MS_status"></span>
        <input type="hidden" id="MS_id">
        {{-- <input type="hidden" id="MS_status"> --}}
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label>Cliente</label>
              <input type="text" class="form-control form-control-sm" id="MS_id_cliente" readonly="readonly">
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
              <label>Serviço</label>
              <input type="text" class="form-control form-control-sm" id="MS_id_servprod" readonly="readonly">
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
              <label>Profissional</label>
              <select class="form-control form-control-sm" id="MS_id_profexec" readonly="readonly">
                <option value="all">Selecione . . .</option>
                @foreach($profissionais as $profissional)
                <option value="{{ $profissional->id }}">{{ $profissional->apelido }}</option>
                @endforeach
              </select>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label>Início</label>
              <input type="datetime-local" class="form-control form-control-sm" id="MS_start" readonly="readonly">
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
              <label>Duração</label>
              <input type="time" class="form-control form-control-sm" id="MS_duracao" readonly="readonly">
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
              <label>Final</label>
              <input type="datetime-local" class="form-control form-control-sm" id="MS_end" readonly="readonly">
            </div>
          </div>

        </div>
        <hr>
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label>Valor</label>
              <input type="number" class="form-control form-control-sm text-right" id="MS_valor" readonly="readonly">
            </div>
          </div>

          <div class="col-8">
            <div class="form-group">
              <label>Observação</label>
              <input type="text" class="form-control form-control-sm" id="MS_obs" readonly="readonly">
            </div>
          </div>
        </div>
      </div> 
      <div class="modal-footer">
        <div class="mr-auto">
          <a class="btn btn-sm btn-default" data-bs-dismiss="modal" id='cancel_agendamento_show'>Cancel</a>
        </div>
        <div class="pull-right">
          <a class="btn btn-sm bg-orange" style="color:white !important;" id='showBTN_atrasado'>Atrasado</a>
          <a class="btn btn-sm btn-success" id='showBTN_confirmado'>Confirmado</a>
          <a class="btn btn-sm btn-primary" id='showBTN_lancado'>Lançado</a>
          <a class="btn btn-sm btn-danger" id='showBTN_faltou'>Faltou</a>
          <a class="btn btn-sm bg-black" style="color:white !important;" id='showBTN_excluir'>EXCLUIR</a>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">

$('#showBTN_atrasado').on('click', function()
{
  var identificador = $('#MS_id').val();
  var status        = 'Atrasado';
  atualizarStatus( identificador, status )
});

$('#showBTN_confirmado').on('click', function()
{
  var identificador = $('#MS_id').val();
  var status        = 'Confirmado';
  atualizarStatus( identificador, status )
});

$('#showBTN_lancado').on('click', function()
{
  var identificador = $('#MS_id').val();
  var status        = 'Finalizado';
  atualizarStatus( identificador, status )
});

$('#showBTN_faltou').on('click', function()
{
  var identificador = $('#MS_id').val();
  var status        = 'Faltou';
  atualizarStatus( identificador, status )
});

$('#showBTN_excluir').on('click', function()
{
  var identificador = $('#MS_id').val();
  var status        = 'excluir';
  atualizarStatus( identificador, status )
});

function atualizarStatus( identificador , status )
{
  $('#overlay_show').show();

  if(status != 'excluir')
  {
    url = "{{ route('agenda.update', ':id') }}";
    url = url.replace(':id', identificador );
  
    var dados = {
      id: identificador,
      status: status
    }

    axios.put( url, dados)
    .then(function(response)
    {
      // console.log(response)
      toastrjs(response.data.type, response.data.message);
      objCalendar.refetchEvents();
    })
@include('includes.catch', [ 'codigo_erro' => '6333915a' ] )
    .then(function ()
    {
      $("#cancel_agendamento_show").click();
    })
    .then(function ()
    {
      setTimeout(function() {
        $('#overlay_show').hide();
      }, 1000);
    })  
  }
  else
  {
    if(confirm("Confirmar a EXCLUSÃO do agendamento?"))
    {
      url = "{{ route('atd.agendamentos.excluir', ':id') }}";
      url = url.replace(':id', identificador );
    
      var dados = {
        id: identificador,
        _method: 'DELETE'
      }
  
      axios.post( url, dados)
      .then(function(response)
      {
        // console.log(response)
        toastrjs(response.data.type, response.data.message);
        objCalendar.refetchEvents();
      })
  @include('includes.catch', [ 'codigo_erro' => '9711950a' ] )
      .then(function ()
      {
        $("#cancel_agendamento_show").click();
      })
      .then(function ()
      {
        setTimeout(function() {
          $('#overlay_show').hide();
        }, 1000);
      })  
    }
  }
}
</script>
@endpush
