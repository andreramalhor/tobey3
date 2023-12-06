<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body table-responsive p-0">
  			<table class="table table-sm table-striped no-padding table-valign-middle projects">
    			<thead class="table-dark">	
						<tr>
							<th class="text-left" width="5%">#</th>
							<th class="text-left" width="">Categoria</th>
							<th class="text-center" width="10%">Foto</th>
							<th class="text-left" width="">Nome</th>
							<th class="text-center" width="15%">Executa?</th>
							<th class="text-center" width="15%">Percentual</th>
						</tr>
					</thead>
					<tbody id="produtosMostrarProdutos">
					</tbody>
					<tfoot id="produtosMostrarProdutosFoot">
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

@push('js')
<script type="text/javascript">
// # PAINEL COMISSOES ================================================================================================
$(document).ready(function()
{  
  $(document).on('click', '#proximaPaginaProdutos', function(event)
  {
    event.preventDefault()
    var page = $(this)[0].dataset.page
    mostrarProdutos(page)
  })
})

function mostrarProdutos(page=1)
{
  $('#produto_overlay').show()
  $('#proximaPaginaProdutos').remove()
  $('#produtosMostrarProdutos').append('<tr id="carregandoPaginaProdutos"><td class="text-center" colspan="6"> Carregando ...</td></tr>')
  
  var url = "{{ route('cat.servprod.paginar', ':page') }}"
  var url = url.replace(':page', '?page='+page+'&per_page='+9999);

  axios.get(url)
  .then(function(response)
  {
    console.log(response)
    collect(response.data.data).sortBy('nome').sortBy('id_categoria').each((value) =>
    {
      tcdp = collect(value.smenhgskqwmdjwe).filter((comissao, key) => comissao.id_profexec == {{ $pessoa->id }}).count() > 0
      valor_percentual = tcdp ? collect(value.smenhgskqwmdjwe).filter((comissao, key) => comissao.id_profexec == {{ $pessoa->id }}).items[0].prc_comissao * 100 : value.prc_comissao

      $("#produtosMostrarProdutos").append(
        '<tr class="'+(value.deleted_at != null ? 'bg-danger' : '' )+'">'+
          '<td class="text-left" width="5%">'+value.id+'</td>'+
          '<td class="text-left" width="">'+value.ecgklyqfdcoguyj.nome+'</td>'+
          '<td class="text-center" width="10%">'+value.imagem_servprod+'</td>'+
          '<td class="text-left" width="">'+value.nome+'</td>'+
          '<td class="text-center" width="10%">'+
            '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">'+
              '<input type="checkbox" class="custom-control-input" id="'+value.id+'" onchange="liberar_input_comissao(this)" '+(tcdp ? 'checked' : '')+'>'+ 
              '<label class="custom-control-label" for="'+value.id+'"></label>'+
            '</div>'+
          '</td>'+
          '<td class="text-center" width="10%">'+
            '<div class="form-group m-0">'+
              '<input '+
                'type="number" '+
                'class="form-control form-control-sm text-center" '+
                'id="input_comissao_'+value.id+'" '+
                'value="'+valor_percentual+'" '+
                'step="1" '+
                'min="0" '+
                'max="100" '+
                'onchange="comissoes_produtos_editar('+value.id+', \'on\')" '+
                (tcdp ? "" : "disabled")+'>'+
            '</div>'+
            // '<input class="text-right" type="number" step="1" min="0" max="100" value="'+value.prc_comissao*100+'">'+
          '</td>'+
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      // console.log('=============================')
      // console.log(response.data)
      $("#produtosMostrarProdutosFoot").append('<tr id="proximaPaginaProdutos" data-page="'+( response.data.current_page + 1 )+'"><td class="text-left" colspan="3">Total de Itens: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td><td class="text-center" colspan="2"><a class="pe-auto" href="#">Mostrar mais produtos...</a></td></tr>')
    }
    else
    {
      $("#produtosMostrarProdutosFoot").append('<tr><td class="text-left" colspan="6">Total de Itens: '+(response.data.total)+' / '+response.data.total+'</td></tr>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '5108836a' ] )
  .then(function(response)
  {
    $('#carregandoPaginaProdutos').remove()
    $('#produto_overlay').hide()
  })
}

function liberar_input_comissao(item)
{
  // $('#input_comissao_'+item.id+'').attr( 'disabled', true )
  let produto = item.id;

  if ($(item).is(':checked'))
  {
    $('#input_comissao_'+item.id+'').attr( 'disabled', false )
    $(item).attr( 'checked', true )
    comissoes_produtos_editar(produto, 'on')
  }
  else
  {
    $(item).attr( 'checked', false )
    $('#input_comissao_'+item.id+'').attr( 'disabled', true )
    comissoes_produtos_editar(produto, 'off')
  }
}

function comissoes_produtos_editar(produto, status)
{
  var url = "{{ route('atd.pessoas.produto_comissao') }}";

  axios.put(url, [{
    produto  : produto,
    pessoa   : {{ $pessoa->id }},
    comissao : $('#input_comissao_'+produto+'').val(),
    status   : status
  }])
  .then( function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '7437726a' ] )
}


@if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
@endif

</script>
@endpush