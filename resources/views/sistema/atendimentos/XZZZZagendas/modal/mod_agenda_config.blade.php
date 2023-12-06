<div class="modal fade" id="modal_agenda_configuracao" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-navy" style="padding: 8px 16px">
        <h5 class="modal-title">Adicionar Contato</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-3">
            <div class="form-group">
              <label>Tipo</label>
              <select class="form-control form-control-sm" name="tipo_contato" id="tipo_contato">
                <option value="Celular">Celular</option> 
                <option value="Residencial">Residencial</option> 
                <option value="Comercial">Comercial</option> 
                <option value="Cobrança">Cobrança</option> 
                <option value="Recado">Recado</option> 
                <option value="Outros">Outros</option> 
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label>DDD</label>
              <input type="text" class="form-control form-control-sm" name="ddd" id="ddd">
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label>Número</label>
              <input type="text" class="form-control form-control-sm" name="telefone" id="telefone">
            </div>
          </div>
          <div class="col-3">
            <div class="form-group" style="padding-top: 10px;">
              <label></label>
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="whatsapp" name="" value="1" checked>
                <label class="custom-control-label" for="whatsapp" name="">WhatsApp</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between" style="padding: 6px 12px">
        <a class="btn btn-default" style="color:black" data-bs-dismiss="modal" id='cancel_modal_pessoas_contato'>Cancelar</a>
        <a class="btn btn-primary" style="color:white" id='submit_pessoas_contato'>Adicionar</a>
      </div>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  if($("#pessoas_contatos").val() == "")
  {
    pessoas_contatos = [];
  }
  else
  {
    pessoas_contatos = [];
    @if (isset($pessoa))
      @foreach($pessoa->ginthgfwxbdhwtu as $contato)
      var contato = {
        'whatsapp'        : "{{ $contato->whatsapp == 1 ? true : false }}",
        'tipo_contato'    : "{{ $contato->tipo_contato }}",
        'ddd'             : "{{ $contato->ddd }}",
        'telefone'        : "{{ $contato->telefone }}",
        'indice'          : "{{ $loop->index + 1 }}",
        'acoes'           : '<div class="btn-group">'+
          '<a onclick="contato_excluir('+({{ $loop->index + 1 }})+');" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-trash-alt"></i></a>'+
        '</div>',
      };

      pessoas_contatos.push(contato);
      @endforeach
    @endif
    // contatos_pacote();
    // contatos_atualizar_tabela();
  }
});

$("#cancel_modal_pessoas_contato").on('click', function (e)
{
  $('#modal_pessoas_contato').modal('hide');
});

$("#submit_pessoas_contato").on('click', function (e)
{
  e.preventDefault();

  var contato = {
    'whatsapp'        : $('#whatsapp').is(':checked'),
    'tipo_contato'    : $('#tipo_contato').val(),
    'ddd'             : $('#ddd').val(),
    'telefone'        : $('#telefone').val(),
    'indice'          : contato_indice() + 1,
    'acoes'           : '<div class="btn-group">'+
    '<a onclick="contato_excluir('+(contato_indice() + 1)+');" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-trash-alt"></i></a>'+
    '</div>',
  };

  if ($("#tipo_contato option:selected").val() != "" && $('#ddd').val() != "" && $('#telefone').val() != "" )
  {
    pessoas_contatos.push(contato);
    contatos_pacote();
    contatos_atualizar_tabela();
    contatos_limpar_campos();
    $('#cancel_modal_pessoas_contato').click();
    toastrjs('success', 'Contato adicionado com sucesso.' )
  } 
  else
  {
    toastrjs('error', 'Há campos obrigatórios que não estão preenchidos!' )
  }
});

function contato_indice()
{
  if(pessoas_contatos.length == 0)
  {
    return 0
  }
  else
  {
    return Math.max.apply(null, pessoas_contatos.map(x => x.indice))
  }
}

function contatos_pacote()
{
  var JSONString = JSON.stringify(pessoas_contatos);
  $("#pessoas_contatos").val(JSONString);
}

function contatos_atualizar_tabela()
{
  $('#tabela-contacts').empty()

  if(pessoas_contatos.length == 0)
  {
    $('#tabela-contacts').html('<tr>'+
      '<td class="text-center" colspan="2">Não há contatos cadastrados.</td>'+
      '</tr>');

    toastrjs('warning', 'Não há nenhum contato cadastrado!' )
  }
  else
  {
    pessoas_contatos.forEach((obj, i) => {

      if (obj.whatsapp)
      {
        var zap = '<a href="https://api.whatsapp.com/send?phone=55'+obj.ddd+(obj.telefone).replace(/\D/g, '')+'"  target="_black" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsaApp"><i class="fab fa-whatsapp"></i></a>';
      }
      else
      {
        var zap = '';
      }

      $('#tabela-contacts').append('<tr>'+
          '<td class="text-center">'+
            obj.tipo_contato+
          '</td>'+
          '<td class="text-center">'+
            '('+obj.ddd+') '+obj.telefone+' '+
            '<div class="btn-group">'+
              zap+
            '</div>'+
          '</td>'+
          '<td class="text-center">'+obj.acoes+'</td>'+
        '</tr>');

      var zap = '';
    });
  }
}

function contatos_limpar_campos()
{
  $("#tipo_contato").prop("selectedIndex", 0);
  $('#ddd').val("33");
  $('#telefone').val("");
}

function contato_excluir( index )
{
  item = pessoas_contatos.findIndex(val => val.indice == index);

  toastrjs('warning', 'Contato removido com sucesso.' )

  pessoas_contatos.splice(item, 1);

  contatos_pacote();
  contatos_atualizar_tabela();
}

</script>
@endpush