<div class="card-body table-responsive p-0" id="tabela-extrato">
  <table class="table table-sm table-striped no-padding table-valign-middle projects">
    <thead class="table-dark">
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Data</th>
        <th class="text-center">Tipo</th>
        <th class="text-left">Descrição</th>
        <th class="text-right">Valor</th>
        <th class="text-right">Saldo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">0</td>
        <td class="text-center">{{ \Carbon\Carbon::today()->format('d/m/Y') }}</td>
        <td class="text-center">
          {{-- @if($lancamento->tipo == 'E') --}}
            {{-- <small class="badge badge-success"> --}}
          {{-- @elseif($lancamento->tipo == 'S') --}}
            {{-- <small class="badge badge-danger"> --}}
          {{-- @elseif($lancamento->tipo == 'T') --}}
            {{-- <small class="badge badge-warning"> --}}
          {{-- @endif --}}
          {{-- {{ $lancamento->tipo }}</small> --}}
        </td>
        <td class="text-left">Saldo Anterior</td>
        <td class="text-right"><span style="color: black">{{ number_format($saldo_anterior, 2, ',', '.') }}</span></td>
        <td class="text-right"><strong style="color:
        @if($saldo_anterior < 0)
          red
        @endif
        ">{{ number_format($saldo_anterior, 2, ',', '.') }}</strong></td>
      </tr>        
      @php $saldo = $saldo_anterior; @endphp
      @forelse($lancamentos as $lancamento)
      @php
        if($lancamento->tipo == 'E')
        {
          $saldo = $saldo + $lancamento->vlr_final;
        }
        elseif($lancamento->tipo == 'S')
        {
          $saldo = $saldo - $lancamento->vlr_final;
        }
        elseif($lancamento->tipo == 'T')
        {
          $saldo = $saldo + $lancamento->vlr_final;
        }
      @endphp
        <tr>
          <td class="text-center">{{ $lancamento->id }}</td>
          <td class="text-center">{{ \Carbon\Carbon::parse($lancamento->dt_pagamento)->format('d/m/Y') }}</td>

          <td class="text-center">
            @if($lancamento->tipo == 'E')
              <small class="badge badge-success">
            @elseif($lancamento->tipo == 'S')
              <small class="badge badge-danger">
            @elseif($lancamento->tipo == 'T')
              <small class="badge badge-warning">
            @endif
            {{ $lancamento->tipo }}</small>
          </td>
          <td class="text-left">{{ $lancamento->descricao }}</td>
          <td class="text-right"><span style="color:
            @if($lancamento->tipo == 'E')
              blue
            @elseif($lancamento->tipo == 'S')
              red
            @elseif($lancamento->tipo == 'T')
              black
            @endif
            ">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
          </span>
          <td class="text-right"><strong style="color:
          @if(round($saldo, 2) < 0)
            red
          @endif
          ">{{ number_format($saldo, 2, ',', '.') }}</strong></td>
        </tr>
      @empty
        <tr>
          <td class="text-center" colspan="6">Não há resultados para essa tabela.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{-- {{ $lancamentos->appends($dataForm)->links() }} --}}
    @else
    {{-- {{ $lancamentos->links() }} --}}
    @endif
  </div>
</div>
