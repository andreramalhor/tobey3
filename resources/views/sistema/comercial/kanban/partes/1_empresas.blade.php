<div class="card" style="height: 100vh; position: relative;">
  <div class="card-header">
    <h3 class="card-title">Empresas</h3>
  </div>
  <div class="card-body p-0 overflow-auto">
    <ul class="products-list product-list-in-card">
    @if(isset($empresas) && $empresas->count() > 0)
      @foreach($empresas as $empresa)
      <li class="item pl-1 pr-1" onclick="cliente_selecionar({{ $empresa->id }})" style="cursor: pointer;" id="pessoa_{{ $empresa->id }}">
        <div class="product-img">
          <img src="{{ $empresa->foto_perfil ?? '' }}" alt="{{ $empresa->apelido ?? '' }}" class="img-circle">
        </div>
        <div class="product-info">
          <a class="product-title">{{ $empresa->apelido ?? '' }}
            <span class="badge badge-warning float-right">{{ $empresa->sakljqekliwuwef->count() ?? '' }}</span>
          </a>
          <span class="product-description">{{ $empresa->nome ?? '' }}</span>
        </div>
      </li>
      @endforeach
    @endif
    </ul>
  </div>
</div>

<script>
function cliente_selecionar(id)
{
  $('#1_empresas li').each(function()
  {
    item = $(this).attr('id');

    if (item != 'pessoa_'+id)
    {
      $(this).removeClass("bg-{{ env('APP_COLOR') }}")
    }
    else
    {
      $(this).addClass("bg-{{ env('APP_COLOR') }}")
      produtos_listar(id)
      leads_listar(id)
    }
  });
}

function produtos_listar(id)
{
  $('#overlay-leads').show();
  
  var url = "{{ route('com.leads.2_produtos', ':id') }}";
  var url = url.replace(':id', id);

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#2_produtos').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '3513842a' ] )
  .then( function(response)
  {
    $('#overlay-leads').hide();
  })
}

function leads_listar(id)
{
  $('#overlay-leads').show();
  
  var url = "{{ route('com.leads.3_leads', ':id') }}";
  var url = url.replace(':id', id);

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#3_leads').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '31684323a' ] )
  .then( function(response)
  {
    $('#overlay-leads').hide();
  })
}
</script>
