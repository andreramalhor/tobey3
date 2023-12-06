<div class="card bg-success" style="height: 58vh; position: relative;">
  <div class="card-header">
    <h3 class="card-title">Portfolio</h3>
  </div>
  <div class="card-body p-0 overflow-auto">
    <ul class="products-list product-list-in-card">
    @if(isset($produtos) && $produtos->count() > 0)
      @foreach($produtos as $produto)
      <li class="item pl-1 pr-1" onclick="produto_selecionar({{ $produto->id }})" style="cursor: pointer;" id="produto_{{ $produto->id }}">
        <div class="product-info">
          <a class="product-title">{{ $produto->titulo ?? '' }}
            <span class="badge badge-warning float-right">{{ $produto->observacao ?? '' }}</span>
          </a>
          <span class="product-description">{{ $produto->slug ?? '' }}</span>
        </div>
      </li>
      @endforeach
    @endif
    </ul>
  </div>
</div>


<script>
function produto_selecionar(id)
{
  $('#2_produtos li').each(function()
  {
    item = $(this).attr('id');

    if (item != 'produto_'+id)
    {
      $(this).removeClass("bg-{{ env('APP_COLOR') }}")
    }
    else
    {
      $(this).addClass("bg-{{ env('APP_COLOR') }}")
      produto_selecionado(id)
    }
  });
}

function produto_selecionado(id)
{
  alert('produto_selecionado')
}
</script>
