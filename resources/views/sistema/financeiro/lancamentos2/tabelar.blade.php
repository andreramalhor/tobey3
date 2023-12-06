<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-lancamentos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap text-center">Tipo</th>
        <th class="text-nowrap text-center">Venciemnto</th>
        <th class="text-nowrap text-center">Data</th>
        <th class="text-nowrap text-center">Local</th>
        <th class="text-nowrap text-center">Tipo</th>
        <th class="text-nowrap text-center">Cliente</th>
        <th class="text-nowrap">Descrição</th>
        <th class="text-nowrap">Valor</th>
        <th class="text-nowrap"></th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($lancamentos as $lancamento)
        @if( isset($lancamento->deleted_at) )
          <tr class="table-danger" style="line-height: 14px">
        @else
          <tr style="line-height: 14px">
        @endif
          <td class="text-nowrap text-center">
            <a href="#" onclick="modal_lancamento_confirnar({{ $lancamento->id }})">
              <i class="fa-solid {{ $lancamento->status == 'Confirmado' ? 'fa-circle' : 'fa-circle-dot' }}" style="color:{{ $lancamento->tipo == 'E' ? 'green' : 'red' }};"></i>
            </a>
          </td>
          <td class="text-nowrap text-center">{{ isset($lancamento->dt_vencimento) ? \Carbon\Carbon::parse($lancamento->dt_vencimento)->format('d/m/Y') : '' }}</td>
          <td class="text-nowrap text-center">{{ isset($lancamento->dt_pagamento) ? \Carbon\Carbon::parse($lancamento->dt_pagamento)->format('d/m/Y') : '' }}</td>
          {{-- <td class="text-nowrap text-center">{{ isset($lancamento->dt_vencimento) ? \Carbon\Carbon::parse($lancamento->dt_vencimento)->format('d/m/Y') : 'Venc.: '.\Carbon\Carbon::parse($lancamento->dt_vencimento)->format('d/m/Y') }}</td> --}}
          <td class="text-nowrap text-center">{{ $lancamento->yaapdycfbplzkeg->nome ?? '' }}</td>
          <td class="text-nowrap">{{ $lancamento->tipo_cobranca }}</td>
          <td class="text-nowrap">{{ $lancamento->qexgzmnndqxmyks->apelido ?? $lancamento->id_cliente }}</td>
          <td class="text-nowrap">{{ $lancamento->descricao }}</td>

          @if($lancamento->tipo == 'S')
            <td class="text-nowrap text-right" style="color: red;">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
          @elseif($lancamento->tipo == 'E')
            <td class="text-nowrap text-right" style="color: blue;">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
          @elseif($lancamento->tipo == 'T')
            <td class="text-nowrap text-right" style="color: black;">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
          @endif
            {{-- @if(isset($lancamento->dt_nascimento)) --}}
            {{-- {{ \Carbon\Carbon::parse($lancamento->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($lancamento->dt_nascimento)->age }} anos) --}}
            {{-- @endif --}}
          {{-- <td class="text-nowrap">{{ $lancamento->email }}</td> --}}

          <td class="text-nowrap text-center">
            <div class="btn-group">
{{--               @if($lancamento->instagram != null)
                <a href="{{ url('//www.instagram.com/'.$lancamento->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              @endif --}}
              
{{--               @if($lancamento->facebook != null)
                <a href="{{ url('//www.facebook.com/'.$lancamento->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              @else
                <a href="{{ url('//www.facebook.com/search/top?q='.$lancamento->nome) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              @endif --}}
{{--               @if($lancamento->ginthgfwxbdhwtu->where('whatsapp', 1)->first() != null)
              <a href='{{ url("//api.whatsapp.com/send?phone=55".$lancamento->whatsapp  ) }}' class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsApp" data-original-title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a>
              @endif --}}
            </div>
          </td>

          <td class="text-nowrap text-center">

              @can('Permissões.Detalhes')
                <a href="{{ route('fin.lancamentos.mostrar', $lancamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
              @endcan

              @can('Permissões.Editar')
                <a href="{{ route('fin.lancamentos.editar', $lancamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan
              
              @can('Permissões.Excluir')
                @if($lancamento->deleted_at == null)
                  <a onClick="lancamentos_excluir({{ $lancamento->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                @else
                  <a onClick="lancamentos_restaurar({{ $lancamento->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
                @endif
              @endcan
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="8">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $lancamentos->appends($dataForm)->links() }}
    @else
    {{ $lancamentos->links() }}
    @endif
  </div>
</div>
