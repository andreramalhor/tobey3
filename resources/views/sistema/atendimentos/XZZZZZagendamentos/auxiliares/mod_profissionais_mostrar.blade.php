<div class="modal fade" id="modal_profissionais_mostrar" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Profissionais Parceiros:</h5>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class='form-group' id='listagem_parceiras'></div>
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        <a class='btn btn-default' data-bs-dismiss='modal'>OK</a>
      </div>
    </div>
  </div>  
</div>

@push('js')
<script type='text/javascript'>
//
$(document).on('show.bs.modal','#modal_profissionais_mostrar', function ()
{
  alert("I want this to appear after the modal has opened!");
});



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
@include('includes.catch', [ 'codigo_erro' => '7185632a' ] )
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
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '4486284a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    agendamentos_recarregar()
  })
})

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
@include('includes.catch', [ 'codigo_erro' => '5054580a' ] )
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
  @include('includes.catch', [ 'codigo_erro' => '7657882a' ] )
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
@endpush
