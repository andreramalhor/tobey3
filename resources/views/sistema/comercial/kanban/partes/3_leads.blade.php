<div class="card bg-warning" style="height: 58vh; position: relative;">
  <div class="card-header">
    <h3 class="card-title">Leads</h3>
  </div>
  <div class="card-body p-0 overflow-auto">
    <ul class="products-list product-list-in-card">
    @if(isset($leads) && $leads->count() > 0)
      @foreach($leads as $lead)
      <li class="item pl-1 pr-1" onclick="lead_selecionar({{ $lead->id }})" style="cursor: pointer;" id="lead_{{ $lead->id }}">
        <div class="product-info">
          <a class="product-title">{{ $lead->nome ?? '' }}
            <span class="badge badge-warning float-right">{{ $lead->telefone ?? '' }}</span>
          </a>
          <span class="product-description">{{ $lead->status ?? '' }}</span>
        </div>
      </li>
      @endforeach
    @endif
    </ul>
  </div>
</div>


<script>
function lead_selecionar(id)
{
  $('#3_leads li').each(function()
  {
    item = $(this).attr('id');

    if (item != 'lead_'+id)
    {
      $(this).removeClass("bg-{{ env('APP_COLOR') }}")
    }
    else
    {
      $(this).addClass("bg-{{ env('APP_COLOR') }}")
      lead_selecionado(id)
    }
  });
}

function lead_selecionado(id)
{
  $('#overlay-leads').show();
  
  var url = "{{ route('com.leads.3_leads_procurar', ':id') }}";
  var url = url.replace(':id', id);

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#4_leads_detalhes').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '31345312a' ] )
  .then( function(response)
  {
    $('#overlay-leads').hide();
  })
}
</script>
