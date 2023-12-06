@extends('layouts.app')

@section('content')
<div class="row" id="comissoes-abert_prof">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <!-- <div class="overlay"> -->
      <!-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> -->
    <!-- </div> -->
    <div class="card-header">
      <h3 class="card-title">Comissões de <strong>{{ $profissional->apelido }}</strong></h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-sm table-striped no-padding text-nowrap">
        <thead class="table-dark">
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Tipo</th>
            <th class="text-center"># Comanda</th>
            <th class="text-center">Data da Comanda</th>
            <th class="text-left">Cliente</th>
            <th class="text-left">Serviço / Produto</th>
            <th class="text-right">Vlr Serviço</th>
            <th class="text-center">% Comissão</th>
            <th class="text-right">Valor da Comissão</th>
            <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
          </tr>
        </thead>
        <tbody>
          @forelse($comissoes->sortBy('dt_prevista')->groupby('dt_prevista') as $dt_prevista => $comissoes_previstas)
          <tr
              class="table-active"
              data-id="vazio"
              data-tipo="previsto"
              data-valor="vazio"
              data-previsao="{{ $dt_prevista != '' ? $dt_prevista : 'vazio' }}"
              data-status="off"
              onclick="comissoes_selecionar( this )"
              style="cursor: pointer;"
            >
            <td colspan="9"><strong>{{ \Carbon\Carbon::parse($dt_prevista)->format('d/m/Y') }}</strong></td>
            <td></td>
          </tr>
            @foreach($comissoes_previstas as $comissao)
              @if($comissao->fonte_origem == 'pdv_vendas_pagamentos')
                <tr 
                    {{-- class="{{ $comissao->valor == 0 ? 'table-danger' : '' }}" --}}
                    data-id="{{ $comissao->id ?? null }}"
                    data-tipo="comissao"
                    data-valor="{{ $comissao->valor ?? null }}"
                    data-previsao="{{ $comissao->dt_prevista ?? 'vazio' }}"
                    data-status="off"
                    onclick="comissoes_selecionar( this )"
                    style="cursor: pointer;"
                  >
                  <td style="color:inherit;" class="text-center">{{ $comissao->id }}</td>
                  <td style="color:inherit;" class="text-center">{{ $comissao->tipo }}</td>
                  <td style="color:inherit;" class="text-center">
                    <a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ optional($comissao->sflfmensjwleneb)->id_venda }})"><span class="badge bg-purple">{{ optional($comissao->sflfmensjwleneb)->id_venda }}</span></a>
                  </td>
                  <td style="color:inherit;" class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
                  <td style="color:inherit;" class="text-left">{{ optional(optional(optional($comissao->sflfmensjwleneb)->yshghlsawerrgvd)->lufqzahwwexkxli)->apelido ?? '(Cliente sem cadastro)' }}</td>
                  <td style="color:inherit;" class="text-left">{{ '' ?? '' }}</td>
                  <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
                  <td style="color:inherit;" class="text-center">{{ $comissao->percentual * 100 }}%</td>
                  <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
                  <td style="color:inherit;" class="text-center">
                    @can('Comissões.Editar')
                    <a href="{{ route('fin.comissoes.prof_abert', $comissao->id_pessoa ?? 0) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Consultar" data-original-title="Consultar"><i class="fa-solid fa-search"></i></a>
                    @endcan
                  </td>
                </tr>
              @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes')
                <tr 
                  {{-- class="{{ $comissao->valor == 0 ? 'table-danger' : '' }}" --}}
                  data-id="{{ $comissao->id ?? null }}"
                  data-tipo="comissao"
                  data-valor="{{ $comissao->valor ?? null }}"
                  data-previsao="{{ $comissao->dt_prevista ?? 'vazio' }}"
                  data-status="off"
                  onclick="comissoes_selecionar( this )"
                  style="cursor: pointer;"
                >
                <td style="color:inherit;" class="text-center">{{ $comissao->id }}</td>
                <td style="color:inherit;" class="text-center">{{ $comissao->tipo }}</td>
                <td style="color:inherit;" class="text-center">
                  <a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ optional($comissao->lskjasdlkdflsdj)->id_venda }})"><span class="badge bg-pink">{{ optional($comissao->lskjasdlkdflsdj)->id_venda }}</span></a>
                </td>
                <td style="color:inherit;" class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
                <td style="color:inherit;" class="text-left">{{ optional(optional($comissao->skfmwuorwmlpdlm)->lufqzahwwexkxli)->apelido ?? '(Cliente sem cadastro)' }}</td>
                <td style="color:inherit;" class="text-left">{{ optional($comissao->ygferchrtuwewhq)->nome ?? '' }}</td>
                <td style="color:inherit;" class="text-right">{{ number_format(optional($comissao->lskjasdlkdflsdj)->vlr_final ?? 0, 2, ',', '.') }}</td>
                <td style="color:inherit;" class="text-center">{{ $comissao->percentual * 100 }}%</td>
                <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
                <td style="color:inherit;" class="text-center">
                  @can('Comissões.Editar')
                  <a href="{{ route('comissao.editarComissao', $comissao->id ?? 0) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Consultar" data-original-title="Consultar"><i class="fa-solid fa-pencil"></i></a>
                  <a href="{{ route('fin.comissoes.prof_abert', $comissao->id_pessoa ?? 0) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Consultar" data-original-title="Consultar"><i class="fa-solid fa-search"></i></a>
                  @endcan
                </td>
              </tr>
              @else
              <tr 
                  {{-- class="{{ $comissao->valor == 0 ? 'table-danger' : '' }}" --}}
                  data-id="{{ $comissao->id ?? null }}"
                  data-tipo="comissao"
                  data-valor="{{ $comissao->valor ?? null }}"
                  data-previsao="{{ $comissao->dt_prevista ?? 'vazio' }}"
                  data-status="off"
                  onclick="comissoes_selecionar( this )"
                  style="cursor: pointer;"
                >
                <td style="color:inherit;" class="text-center">{{ $comissao->id }}</td>
                <td style="color:inherit;" class="text-center">{{ $comissao->tipo }}</td>
                <td style="color:inherit;" class="text-center"></td>
                <td style="color:inherit;" class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
                <td style="color:inherit;" class="text-left">{{ optional($comissao->xeypqgkmimzvknq)->apelido ?? '(Cliente sem cadastro)' }}</td>
                <td style="color:inherit;" class="text-left">{{ $comissao->tipo ?? '' }}</td>
                <td style="color:inherit;" class="text-right">{{ number_format(optional($comissao->lskjasdlkdflsdj)->vlr_final ?? 0, 2, ',', '.') }}</td>
                <td style="color:inherit;" class="text-center">{{ $comissao->percentual * 100 }}%</td>
                <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
                <td style="color:inherit;" class="text-center">
                  @can('Comissões.Editar')
                  <a href="{{ route('fin.comissoes.prof_abert', $comissao->id_pessoa ?? 0) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Consultar" data-original-title="Consultar"><i class="fa-solid fa-search"></i></a>
                  @endcan
                </td>
              </tr>
              @endif
            @endforeach
          @empty
          <tr>
            <td class="text-center" colspan="10">Não há comissões em aberto.</td>
          </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center"><spam id="comissoes_contagem">0</spam> / {{ $comissoes->count() }}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="text-right"><spam id="comissoes_soma">0</spam> / {{ number_format($comissoes->sum('valor'), 2, ',', '.') }}</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="card-footer">
      <a class="btn btn-sm btn-default" href="{{ route('fin.comissoes') }}">Cancelar</a>
      <a class="btn btn-sm btn-primary float-right" onclick="comissoes_pagar()">Confirmar pagamento</a>
    </div>
  </div>
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
      // comissoes_tabelar_abert_prof()
    })
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endpush
