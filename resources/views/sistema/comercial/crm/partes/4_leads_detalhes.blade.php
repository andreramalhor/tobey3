<div class="card" style="height: 42.2vh; position: relative;">
  <div class="card-header py-2
    @if(isset($lead) && $lead->interesse == 'frio')
      bg-info
    @elseif(isset($lead) && $lead->interesse == 'morno')
      bg-orange
    @elseif(isset($lead) && $lead->interesse == 'quente')
      bg-red
    @endif
    ">
    <h3 class="card-title">{{ $lead->nome ?? '(Escolha um lead)' }}</h3>
    <div class="card-tools">
      <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="lead_favoritar({{ $lead->id ?? '' }}, {{ $lead->favorito ?? '' }})" data-bs-tooltip="tooltip" data-bs-title="Favorito"><i class="fa-solid fa-star" style="color: {{ isset($lead->favorito) && $lead->favorito ? 'gold' : 'lightgrey' }}"></i></a>
      @if(isset($lead) && $lead->interesse == 'frio')
        <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="lead_interesse({{ $lead->id ?? '' }}, 'morno')" data-bs-tooltip="tooltip" data-bs-title="Frio"><i class="fa-solid fa-snowflake" style="color: blue"></i></a>
      @elseif(isset($lead) && $lead->interesse == 'morno')
        <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="lead_interesse({{ $lead->id ?? '' }}, 'quente')" data-bs-tooltip="tooltip" data-bs-title="Morno"><i class="fa-solid fa-mitten" style="color: orange"></i></a>
      @elseif(isset($lead) && $lead->interesse == 'quente')
        <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;" onClick="lead_interesse({{ $lead->id ?? '' }}, 'frio')" data-bs-tooltip="tooltip" data-bs-title="Quente"><i class="fa-solid fa-fire" style="color: red"></i></a>
      @else
        <a class="btn btn-default btn-sm" style="width:35px; text-decoration: none !important;"><i class="fa-solid fa-temperature-half" data-bs-tooltip="tooltip" data-bs-title="Interesse"></i></a>
      @endif
    </div>
  </div>
  <div class="card-body p-1">        
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label>Status</label>
          <select class="form-control form-control-sm">
            <option>Nível 1</option>
            <option>Nível 2</option>
            <option>Nível 3</option>
            <option>Nível 4</option>
            <option>Nível 5</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="form-group mb-3">
          <label class="m-0">Registrar Conversa</label>
          <div class="input-group">
            <textarea class="form-control form-control-sm" id="lead_nova_conversa" rows="2"></textarea>
            <span class="input-group-append">
              <a class="input-group-text bg-primary {{ isset($lead) ? '' : 'disabled' }}" href="" data-bs-tooltip="tooltip" data-bs-title="Adicionar" aria-label="Adicionar" onclick="lead_gravar_conversa({{ $lead->id ?? '' }})">
                <i class="fa-solid fa-check"></i>
              </a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
function lead_favoritar( id, status )
{
  $('#overlay_lead').show()

  var dados = {
    favorito : status,
  }

  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', id)

  axios.put(url, dados)
  .then( function(response)
  {
    console.log(response)
    lead_selecionado( response.data.id )
  })
  @include('includes.catch', [ 'codigo_erro' => '7945518a' ] )
  .then( function()
  {
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_interesse( id, interesse )
{
  $('#overlay_lead').show()

  var dados = {
    interesse : interesse,
  }
  
  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', id)

  axios.put(url, dados)
  .then( function(response)
  {
    console.log(response)
    lead_selecionado( response.data.id )
  })
  @include('includes.catch', [ 'codigo_erro' => '7945518a' ] )
  .then( function()
  {
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}

function lead_gravar_conversa( id )
{
  $('#overlay_lead').show()
  
  var dados = {
    conversa : $('#lead_nova_conversa').val(),
  }
  
  var url  = "{{ route('com.leads.atualizar', ':idd') }}"
  var url  = url.replace(':idd', id)
  
  axios.put(url, dados)
  .then( function(response)
  {
    console.log(response)
    $("#lead_updated_at").empty().text(moment(response.data.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h')
    $("#lead_updated_at_d").empty().text(moment().diff(response.data.updated_at, 'days')+' dia'+(moment().diff(response.data.updated_at, 'days') != 1 ? 's' : ''))
  })
  @include('includes.catch', [ 'codigo_erro' => '5097345a' ] )
  .then( function()
  {
    $("#lead_nova_conversa").val('')
    setTimeout(() => {
      $('#overlay_lead').hide()
    }, 500 )
  })
}


  var tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]');
  var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

</script>