<div class="card" style="height: 90vh; position: relative;">
  <div class="card-header">
    <h3 class="card-title">Leads</h3>
    <div class="card-tools">
      <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="leads_filtro( 'favorito')" data-bs-tooltip="tooltip" data-bs-title="Favorito"><i class="fa-solid fa-star" style="color: {{ isset($lead->favorito) && $lead->favorito ? 'gold' : 'lightgrey' }}"></i></a>
      <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="leads_filtro( 'morno')" data-bs-tooltip="tooltip" data-bs-title="Frio"><i class="fa-solid fa-snowflake" style="color: blue"></i></a>
      <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="leads_filtro( 'quente')" data-bs-tooltip="tooltip" data-bs-title="Morno"><i class="fa-solid fa-mitten" style="color: orange"></i></a>
      <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="leads_filtro( 'frio')" data-bs-tooltip="tooltip" data-bs-title="Quente"><i class="fa-solid fa-fire" style="color: red"></i></a>
    </div>
  </div>
  <div class="card-body p-1 overflow-auto">
    <ul class="products-list product-list-in-card">
    @if(isset($leads) && $leads->count() > 0)
      @foreach($leads->sortByDesc('favorito') as $lead)
      <div class="callout p-2" style="{{ $lead->color_interesse }}">
        <div class="d-flex bd-highlight">
          <span class="w-100">
            <a class="bd-highlight" style="text-decoration: none !important;">
              <i class="fa-solid fa-star" style="color: {{ $lead->favorito ? 'gold' : 'lightgrey' }}"></i>
            </a>
            <a class="bd-highlight" style="cursor: pointer;" onClick="lead_selecionado({{ $lead->id }})">
              <strong>{{ $lead->nome }}</strong>
            </a>
          </span>
          <span class="flex-shrink-1 bd-highlight collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $lead->id }}" aria-expanded="false" aria-controls="collapse_{{ $lead->id }}">
            <i class="fa-solid fa-caret-down"></i>
            <!-- <i class="fa-solid fa-caret-up"></i> -->
          </span>
        </div>
        <div>
          <p class="p-0 m-0">
            <span>{{ $lead->updated_at }}</span>
            <a 
              href="{{ $lead->link_whatsapp }}"
              target="_blank"
              data-tt="tooltip"
              data-bs-original-title="Whatsapp"
              aria-label="Whatsapp"
              >
              <i class="fa-brands fa-whatsapp"></i>
            </a>
            <span" class="float-end" style="color: color;">{{ \Carbon\Carbon::parse($lead->updated_at)->diffForHumans() }}</span>
          </p>
        </div>
        <div id="collapse_{{ $lead->id }}" class="collapse" data-bs-parent="#accordion" style="border-top: 1px solid lightgray">
          <div class="card-body" style="padding: 10px 5px;">
            <small><strong>Nome:</strong> {{ $lead->nome }}</small></br>
              <!-- <small><strong>Cursos:</strong> curso+</small></br> -->
              <!-- <small><strong>Turma:</strong> turma+</small></br></br> -->
              <small><strong>Último Contato: </strong>{{ \Carbon\Carbon::parse($lead->updated_at)->format('d/m/Y [às] H:i') }} h</small></br></br>
              <small><strong>Convesas:</strong></small></br>
              <small>
                @foreach($lead->fghtvxswwryiiil as $conversa)
                {{ $conversa->conversa }}
                <li>
                  @endforeach
                </li>
              </small></br>
              <small><strong>Data de Cadastro: </strong>{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y [às] H:i') }} h</small></br>
            </div>
          </div>
        </div>
      

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
