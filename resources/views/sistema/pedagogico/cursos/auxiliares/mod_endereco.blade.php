<div class="modal fade" id="modal_pessoas_endereco" aria-hidden="true" style="display: none; color: black;">
  <form autocomplete="off" id="form-endereco-adicionar">
    @csrf
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-navy" style="padding: 8px 16px">
          <h5 class="modal-title">Adicionar Endereço</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-2">
              <div class="form-group">
                <label>Tipo</label>
                <select class="form-control form-control-sm" name="tipo_endereco" id="tipo_endereco">
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
                <label>CEP</label>
                <input type="text" class="form-control form-control-sm" name="cep" id="cep">
              </div>
            </div>
            <div class="col-1">
              <div class="form-group">
                <label>Número</label>
                <input type="text" class="form-control form-control-sm" name="numero" id="numero">
              </div>
            </div>
            <div class="col-1">
              <div class="form-group">
                <label>Compl.</label>
                <input type="text" class="form-control form-control-sm" name="complemento" id="complemento">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Logradouro</label>
                <input type="text" class="form-control form-control-sm" name="logradouro" id="logradouro">
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Bairro</label>
                <input type="text" class="form-control form-control-sm" name="bairro" id="bairro">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Cidade</label>
                <input type="text" class="form-control form-control-sm" name="cidade" id="cidade">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Estado</label>
                <input type="text" class="form-control form-control-sm" name="uf" id="uf">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <a class="btn btn-default" style="color:black" data-bs-dismiss="modal" id='cancel_pessoas_endereco'>Cancelar</a>
          <a class="btn btn-primary" style="color:white" id='submit_pessoas_endereco'>Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  $("#cep").inputmask({
    mask: ["99.999-999"],
  })

  if($("#pessoas_enderecos").val() == "")
  {
    pessoas_enderecos = [];
  }
  else
  {
    pessoas_enderecos = [];
    @if (isset($pessoa))
      @foreach($pessoa->uqbchiwyagnnkip as $endereco)
      var endereco = {
        'tipo_endereco'   : "{{ $endereco->tipo_endereco }}",
        'cep'             : "{{ $endereco->cep }}",
        'logradouro'      : "{{ $endereco->logradouro }}",
        'bairro'          : "{{ $endereco->bairro }}",
        'numero'          : "{{ $endereco->numero }}",
        'complemento'     : "{{ $endereco->complemento }}",
        'cidade'          : "{{ $endereco->cidade }}",
        'uf'              : "{{ $endereco->uf }}",
        'indice'          : "{{ $loop->index + 1  }}",
        'acoes'           : '<div class="btn-group">'+
          '<a onclick="endereco_excluir('+({{ $loop->index + 1  }})+');" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-trash-alt"></i></a>'+
        '</div>',
      };

      pessoas_enderecos.push(endereco);
      @endforeach
    @endif
    enderecos_pacote();
    enderecos_atualizar_tabela();
  }
});

$("#cancel_pessoas_endereco").on('click', function (e)
{
  $('#modal_pessoas_endereco').modal('hide');
});

// =================================================== Funções ENDEREÇO (cep)
$("#cep").on('blur', function (e)
{
  let valor = e.target.value;
  
  //Nova variável "cep" somente com dígitos.
  let cep = valor.replace(/\D/g, '');
  
  //Verifica se campo cep possui valor informado.
  if (cep != "")
  {
    //Expressão regular para validar o CEP.
    let validacep = /^[0-9]{8}$/;
  
    //Valida o formato do CEP.
    if(validacep.test(cep))
    {
      //Preenche os campos com "..." enquanto consulta webservice.
      $('#logradouro').value="...";
      $('#bairro').value="...";
      $('#cidade').value="...";
      $('#uf').value="...";

      //Cria um elemento javascript.
      let script = document.createElement('script');
  
      //Sincroniza com o callback.
      script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
  
      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);
    }
    else
    {
      //cep é inválido.
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
  
    }
  }
  else
  {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
  }
});

function meu_callback(conteudo)
{
  if (!("erro" in conteudo))
  {
    //Atualiza os campos com os valores.
    $('#logradouro').val(conteudo.logradouro);
    $('#bairro').val(conteudo.bairro);
    $('#cidade').val(conteudo.localidade);
    $('#uf').val(conteudo.uf);
  }
  else
  {
    //CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
  }
}

function limpa_formulário_cep()
{
  //Limpa valores do formulário de cep.
  $('#logradouro').val("");
  $('#bairro').val("");
  $('#numero').val("");
  $('#complemento').val("");
  $('#cidade').val("");
  $('#uf').val("");
}

$("#submit_pessoas_endereco").on('click', function (e)
{
  e.preventDefault();

  var endereco = {
    'tipo_endereco'   : $('#tipo_endereco').val(),
    'cep'             : $('#cep').val(),
    'logradouro'      : $('#logradouro').val(),
    'bairro'          : $('#bairro').val(),
    'numero'          : $('#numero').val(),
    'complemento'     : $('#complemento').val(),
    'cidade'          : $('#cidade').val(),
    'uf'              : $('#uf').val(),
    'indice'          : endereco_indice() + 1,
    'acoes'           : '<div class="btn-group">'+
                          '<a onclick="endereco_excluir('+(endereco_indice() + 1)+');" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-trash-alt"></i></a>'+
                        '</div>',
  };

  if ($("#tipo_endereco option:selected").val() != "" && $('#cep').val() != "" && $('#logradouro').val() != "" && $('#bairro').val() != "" && $('#numero').val() != "" && $('#cidade').val() != "" && $('#uf').val() != "" )
  {
    pessoas_enderecos.push(endereco);
    enderecos_pacote();
    enderecos_atualizar_tabela();
    limpa_formulário_cep();
    $('#cancel_pessoas_endereco').click();
    $('#cep').val("");
    toastrjs('success', 'Endereço do adicionado com sucesso.' )
  } 
  else
  {
    toastrjs('error', 'Há campos obrigatórios que não estão preenchidos!' )
  }
});

function endereco_indice()
{
  if(pessoas_enderecos.length == 0)
  {
    return 0
  }
  else
  {
    return Math.max.apply(null, pessoas_enderecos.map(x => x.indice))
  }
}

function enderecos_pacote()
{
  var JSONString = JSON.stringify(pessoas_enderecos);
  $("#pessoas_enderecos").val(JSONString);
}

function enderecos_atualizar_tabela()
{
  $('#tabela-address').empty()

  if(pessoas_enderecos.length == 0)
  {
    $('#tabela-address').html('<tr>'+
      '<td class="text-center" colspan="5">Não há endereços cadastrados.</td>'+
      '</tr>');

    toastrjs('warning', 'Não há nenhum endereço cadastrado!' )
  }
  else
  {
    pessoas_enderecos.forEach((obj, i) => {

      if (obj.complemento != "")
      {
        var complemento = ' ('+obj.complemento+')';
      }
      else
      {
        var complemento = '';
      }

      $('#tabela-address').append('<tr>'+
        '<td class="text-left">'+obj.tipo_endereco+'</td>'+
        '<td class="text-left">'+obj.cep+'</td>'+
        '<td class="text-left">'+
          obj.logradouro+', '+obj.numero+complemento+' - '+obj.bairro+
        '</td>'+
        '<td class="text-left">'+obj.cidade+' - '+obj.uf+'</td>'+
        '<td class="text-center">'+obj.acoes+'</td>'+
      '</tr>');
     
      var complemento = '';
    });
  }
}

function endereco_excluir( index )
{
  item = pessoas_enderecos.findIndex(val => val.indice == index);

  toastrjs('warning', 'Endereço removido com sucesso.' )

  pessoas_enderecos.splice(item, 1);

  enderecos_pacote();
  enderecos_atualizar_tabela();
}

</script>
@endpush