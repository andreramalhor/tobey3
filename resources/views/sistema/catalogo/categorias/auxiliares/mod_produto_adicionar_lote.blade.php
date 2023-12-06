<div class="modal fade" id="modal_produto_adicionar_lote" aria-hidden="true" style="display: none; color: black;" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content" style="height: 95%;">
      <div class="modal-header bg-navy" style="padding: 8px 16px">
        <h4 class="modal-title">Adicionar Produto em Lote</h4>
      </div>
      <div class="modal-body p-2">
        <div class="row"> {{-- style="min-height: 100px" --}}
          <div class="col-12" id="produtos_add_lote">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Produtos</h6>
            <div class="row">
              <div class="col-3" id="categoria_produtos_disponiveis_1">
                <div class="form-group mb-3">
                  <div class="form-group" >
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                      <label for="customCheckbox1" class="custom-control-label">Carregando . . .</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3 border-left" id="categoria_produtos_disponiveis_2">
                <div class="form-group mb-3">
                  <div class="form-group" >
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                      <label for="customCheckbox1" class="custom-control-label">Carregando . . .</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3 border-left" id="categoria_produtos_disponiveis_3">
                <div class="form-group mb-3">
                  <div class="form-group" >
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                      <label for="customCheckbox1" class="custom-control-label">Carregando . . .</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3 border-left" id="categoria_produtos_disponiveis_4">
                <div class="form-group mb-3">
                  <div class="form-group" >
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                      <label for="customCheckbox1" class="custom-control-label">Carregando . . .</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal" onClick="$('#produtosMostrarServicos').empty();mostrarServicos(0)">Fechar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">
$('#modal_produto_adicionar_lote').on('shown.bs.modal', categoria_produto_mostrar)
$("#categoria_produtos_disponiveis_1").empty()
$("#categoria_produtos_disponiveis_2").empty()
$("#categoria_produtos_disponiveis_3").empty()
$("#categoria_produtos_disponiveis_4").empty()
index = 0
pagina = 0

function categoria_produto_mostrar(page=1)
{
  $("#categoria_produtos_disponiveis_1").append('<spam id="carregando_1">Carregando . . .</spam>')
  $("#categoria_produtos_disponiveis_2").append('<spam id="carregando_2">Carregando . . .</spam>')
  $("#categoria_produtos_disponiveis_3").append('<spam id="carregando_3">Carregando . . .</spam>')
  $("#categoria_produtos_disponiveis_4").append('<spam id="carregando_4">Carregando . . .</spam>')
  // $('#overlay-pessoas').show()
  var url = "{{ route('cat.produtos.paginar') }}"
  var url = url.replace(':params', '?params='+params)

  var params = url+'?ordenar_por=marca'
  var params = params+'&page='+page
  
  axios.get(params)
  .then(function(response)
  {
    // console.log(response.data)
    qtd_total = response.data.total
    coluna    = qtd_total / 4
    pagina    = response.data.current_page
   
    $.each( response.data.data, function(key, value)
    {
      if (index <= coluna)
      { 
        $("#categoria_produtos_disponiveis_1").append(
          '<div class="form-check">'+
            '<input class="form-check-input" type="checkbox" id="produto_disponivel_'+value.id+'" value="'+value.id+'" onchange="listar_produtos_outras_categorias(this)" '+((value.id_categoria == {{ $categoria->id }}) ? "checked" : "") +'>'+
            '<label class="form-check-label "for="'+value.id+'"><small>'+value.mnome+'</small></label>'+
          '</div>')
      }
      
      if(index > coluna && index <= (coluna * 2) )
      { 
        $("#categoria_produtos_disponiveis_2").append(
          '<div class="form-check">'+
            '<input class="form-check-input" type="checkbox" id="produto_disponivel_'+value.id+'" value="'+value.id+'" onchange="listar_produtos_outras_categorias(this)" '+((value.id_categoria == {{ $categoria->id }}) ? "checked" : "") +'>'+
            '<label class="form-check-label "for="'+value.id+'"><small>'+value.mnome+'</small></label>'+
          '</div>')
      }
      
      if(index > (coluna * 2) && index <= (coluna * 3) )
      { 
        $("#categoria_produtos_disponiveis_3").append(
          '<div class="form-check">'+
            '<input class="form-check-input" type="checkbox" id="produto_disponivel_'+value.id+'" value="'+value.id+'" onchange="listar_produtos_outras_categorias(this)" '+((value.id_categoria == {{ $categoria->id }}) ? "checked" : "") +'>'+
            '<label class="form-check-label "for="'+value.id+'"><small>'+value.mnome+'</small></label>'+
          '</div>')
      }
      
      if(index > (coluna * 3) && index <= (coluna * 4) )
      { 
        $("#categoria_produtos_disponiveis_4").append(
          '<div class="form-check">'+
            '<input class="form-check-input" type="checkbox" id="produto_disponivel_'+value.id+'" value="'+value.id+'" onchange="listar_produtos_outras_categorias(this)" '+((value.id_categoria == {{ $categoria->id }}) ? "checked" : "") +'>'+
            '<label class="form-check-label "for="'+value.id+'"><small>'+value.mnome+'</small></label>'+
          '</div>')
      }
      index = index + 1
    })

    if (pagina <= response.data.last_page)
    {
      categoria_produto_mostrar(pagina + 1)
    }
  })
@include('includes.catch', [ 'codigo_erro' => '8366372a' ] )
  .then( function()
  {
    $("#carregando_1").remove()
    $("#carregando_2").remove()
    $("#carregando_3").remove()
    $("#carregando_4").remove()

    console.log('fim')
  })
}

function listar_produtos_outras_categorias(item)
{
  if ($(item).is(':checked'))
  {
    var url = "{{ route('cat.produtos.atualizar', ':idd') }}"
    var url = url.replace(':idd', item.value)

    var dados = {
      id_categoria: {{ $categoria->id }},
    }

    axios.put(url, dados)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '6326233a' ] )
  }
  else
  {
    var url = "{{ route('cat.produtos.atualizar', ':idd') }}"
    var url = url.replace(':idd', item.value)

    var dados = {
      id_categoria: 0,
    }

    axios.put(url, dados)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '5241634a' ] )
  }
}
</script>
@endpush
