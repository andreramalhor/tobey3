@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label>Pagamentos</label>
          <select class="form-control" onChange="ver_comissoes( this.value )">
            <option>Selecione . . .</option>
            @foreach($comissoes->sortBy('dt_quitacao')->unique('id_destino') as $pagamento)
            <option value="{{ $pagamento->id_destino }}">{{ \Carbon\Carbon::parse($pagamento->dt_quitacao ?? now())->format('d/m/Y') }} - {{ $pagamento->id_destino ?? 'Sem data específica' }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="pagas">

</div>
@endsection


@push('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    comissoes_pagas = []
  });

  function comissoes_selecionar( campo )
  {
    if( $(campo).data('tipo') == 'comissao' )
    {
      if( $(campo)[0].dataset.status == "off" )
      {
        dados = {}
        dados.id       = $(campo).data("id");
        dados.previsao = $(campo).data("previsao");
        dados.valor    = $(campo).data("valor");
        
        collect(comissoes_pagas).push(dados)

        $(campo).attr('data-status', 'on')
        $(campo).addClass('bg-primary text-white')
      }
      else
      {
        index_item = collect(comissoes_pagas).search((value, key) =>  value.id == $(campo).data("id"));
        collect(comissoes_pagas).items.splice(index_item,1)
  
        $(campo).attr('data-status', 'off')
        $(campo).removeClass('bg-primary text-white')
      }
    }
    else if( $(campo).data('tipo') == 'previsto' )
    {
      $('tr').each(function(key, linha)
      {
        if($(linha).data('tipo') == 'comissao' && $(linha).data('previsao') == $(campo).data("previsao"))
        {
          if( $(linha)[0].dataset.status == "off" )
          {
            dados = {}
            dados.id       = $(linha).data("id");
            dados.previsao = $(linha).data("previsao");
            dados.valor    = $(linha).data("valor");

            comissoes_pagas.push(dados)
            
            $(linha).attr('data-status', 'on')
            $(linha).addClass('bg-primary text-white')
          }
          else
          {
            index_item = collect(comissoes_pagas).search((value, key) =>  value.id == $(linha).data("id"));
            collect(comissoes_pagas).items.splice(index_item,1)

            $(linha).attr('data-status', 'off')
            $(linha).removeClass('bg-primary text-white')
          }
        }
      })
    }

    $('#comissoes_soma').text( accounting.formatMoney(collect(comissoes_pagas).sum('valor'), '') )
    $('#comissoes_contagem').text( collect(comissoes_pagas).count() )
  }

  function comissoes_pagar()
  {
    $('#overlay-comissoes').show();

    var url = "{{ route('fin.comissoes.pagar', ':id') }}";
    var url = url.replace(':id', {{ $profissional->id }});
    
    axios.post(url, comissoes_pagas)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
      window.location.href = response.data.redirect;
    })
    @include('includes.catch', [ 'codigo_erro' => '6239454a' ] )
    .then( function(response)
    {
      // fomissoes_tabelar_dechd_prof()
    })
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  function ver_comissoes( id_quitado )
  {
    $('#overlay-comissoes').show();

    var url = "{{ route('fin.comissoes.prof_quitada', ':id_quitado') }}";
    var url = url.replace(':id_quitado', id_quitado);
    
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#pagas').empty().append(response.data);
    })
    @include('includes.catch', [ 'codigo_erro' => '324543546a' ] )
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }
</script>
@endpush
