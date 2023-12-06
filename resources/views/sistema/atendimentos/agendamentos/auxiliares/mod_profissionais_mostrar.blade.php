<div class="modal fade" id="modal_profissionais_mostrar">
  <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Profissionais Parceiros:</h5>
      </div>
      <div class='modal-body'>
        <ul class="todo-list" data-bs-widget="todo-list" id="listagem_parceiras" onchange="agenda_ordenar()">

        </ul>
      </div>
      <div class='modal-footer justify-content-between'>
        <a class='btn btn-default' data-bs-dismiss='modal'>OK</a>
      </div>
    </div>
  </div>  
</div>

@push('js')
<script type='text/javascript'>
//
$(document).on('show.bs.modal','#modal_profissionais_mostrar', function()
{
  agenda_parceiros_listar()
  agenda_ordenar()
});

$(document).on('hide.bs.modal','#modal_profissionais_mostrar', function()
{
  objCalendar.refetchResources();
});

function agenda_parceiros_listar()
{
  axios.get("{{ route('atd.pessoas.parceiras') }}")
  .then(function(response)
  {
    // console.log(response.data)
    $('#listagem_parceiras').empty()

    collect(response.data).sortBy('aslfenvkvuelkds.ordem').each(value =>
    {
      console.log(value)
      if(value.aslfenvkvuelkds.ordem == null)
      {
        checked = ''
      }
      else
      {
        checked = 'checked'
      }

      $('#listagem_parceiras').append(
        '<li id="'+value.id+'">'+
          '<div class="row">'+
            '<div class="col-1">'+
              '<span class="handle sortable-handle">'+
                '<i class="fas fa-ellipsis-v"></i>'+
                '<i class="fas fa-ellipsis-v"></i>'+
              '</span>'+
              '<div class="icheck-primary d-inline ml-2">'+
                '<input type="checkbox" name="todo1" id="mostrando_'+value.id+'" value="'+value.id+'" '+checked+' onclick="agenda_ocultar_mostrar( this )">'+
                '<label for="mostrando_'+value.id+'"></label>'+
              '</div>'+
            '</div>'+
            '<div class="col-1">'+
              '<span class="text">'+value.id+'</span>'+
            '</div>'+
            '<div class="col-4">'+
              '<span class="text">'+value.apelido+'</span>'+
            '</div>'+
            '<div class="col-4">'+
              '<span class="text">'+value.aslfenvkvuelkds.area+'</span>'+
            '</div>'+
          '</div>'+
        '</li>'
      )
    })
  })
  @include('includes.catch', [ 'codigo_erro' => '8244867a' ] )
  .then(function()
  {
    objCalendar.refetchResources();
  })      
}

function agenda_ordem_atualizar(dados)
{
  axios.post("{{ route('atd.pessoas.agenda_ordem_salvar') }}", dados)
  .then(function(response)
  {
    // console.log(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '3730086a' ] )
}

function agenda_ordenar()
{
  $('#listagem_parceiras').sortable(
  {
    stop: function()
    {
      $.map($(this).find('li'), function(el)
      {
        var id_pessoa = el.id;
        var ordem     = $(el).index();

        if( $('#mostrando_'+el.id).is(':checked') )
        {
          var dados = {
            id_pessoa: id_pessoa,
            ordem: ordem,
          }
          
          agenda_ordem_atualizar(dados)
        }
      })
    }
  })
}

function agenda_ocultar_mostrar( campo )
{
  if(!campo.checked)
  {
    var dados =
    {
      id_pessoa: campo.value,
      ordem: null,
    }
    
    agenda_ordem_atualizar(dados)
  }
  else
  {
    $.map($('#listagem_parceiras').find('li'), function(el)
    {
      if(el.id == campo.value)
      {
        var dados = {
          id_pessoa: campo.value,
          ordem: $(el).index(),
        }

        agenda_ordem_atualizar(dados)
      }
    })
  }
}

</script>
@endpush
