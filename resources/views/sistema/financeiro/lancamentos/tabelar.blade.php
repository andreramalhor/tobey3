<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-lancamentos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap text-center">#</th>
        <th class="text-nowrap text-center">Tipo</th>
        <th class="text-nowrap text-left">Conta</th>
        <th class="text-nowrap text-left">Dt Pagamento<br><small>Dt. Vencimento</small></th>
        <th class="text-nowrap text-left">Descrição<br><small>Pessoa(Cliente ou Fornecedor)</small></th>
        <th class="text-nowrap text-center">Forma de Pagamento</th>
        <th class="text-nowrap text-right">Valor</th>
        <th class="text-nowrap text-center">Banco<br><small>Caixa</small></th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>

{{-- id_banco
id_conta
num_documento
id_cliente
informacao
vlr_bruto
vlr_dsc_acr
vlr_final
parcela
dt_vencimento
dt_recebimento
dt_confirmacao
dt_pagamento
id_usuario_lancamento
id_usuario_confirmacao
id_caixa
id_lancamento_origem
origem
status --}}
{{-- UPDATE `db_geral`.`fin_lancamentos` SET `dt_pagamento`=dt_recebimento WHERE  `id`>0; --}}
{{-- ALTER TABLE `fin_lancamentos` DROP COLUMN `dt_confirmacao`; --}}

    <tbody>
    @forelse($lancamentos as $lancamento)
      @if( isset($lancamento->deleted_at) )
        <tr class="table-danger" style="line-height: 14px">
      @else
        <tr style="line-height: 14px">
      @endif
          <td class="text-center text-center"><small>{{ $lancamento->id }}</small></td>
          <td class="text-nowrap text-center" style="color: {{ $lancamento->color }};"><b>{{ $lancamento->tipo }}</b></td>
          <td class="text-nowrap text-left"><small>{{ optional($lancamento->qlwiqwuheqlefkd)->titulo }}</small></td>
          <td class="text-nowrap text-left">
            {{ isset($lancamento->dt_pagamento) ? \Carbon\Carbon::parse($lancamento->dt_pagamento)->format('d/m/Y') : '' }}<br>
            <small class="text-muted">{{ isset($lancamento->dt_vencimento) ? \Carbon\Carbon::parse($lancamento->dt_vencimento)->format('d/m/Y') : '' }}</small>  
          </td>
          <td class="text-nowrap text-left">
            <small>{{ $lancamento->informacao }}</small><br>
            <small>{{ optional($lancamento->qexgzmnndqxmyks)->nome ?? $lancamento->id_cliente }}</small>
          </td>
          <td class="text-nowrap text-center"><small>{{ optional($lancamento->ueifnsjfwefnskd)->forma ?? $lancamento->id_forma_pagamento }}</small></td>
          <td class="text-nowrap text-right" style="color: {{ $lancamento->color }};">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>

          <td class="text-nowrap text-center">
            <small>{{ $lancamento->yaapdycfbplzkeg->nome ?? '' }}</small><br>
            <small>{{ $lancamento->id_caixa }}</small>  
          </td>
          <td class="text-nowrap text-center"><small>{{ $lancamento->status }}</small></td>
          


          <td class="text-nowrap text-center">
              @can('Financeiro.Excluir')
                <!-- <a href="{{ route('fin.lancamentos.mostrar', $lancamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp; -->
              @endcan

              @can('Financeiro.Excluir')
                <!-- <a href="{{ route('fin.lancamentos.editar', $lancamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp; -->
              @endcan
              
                <!-- @if($lancamento->deleted_at == null) -->
                <a href="{{ route('fin.lancamentos.mostrar', $lancamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
                <a href="" class="text-muted" data-bs-tt="tooltip" title="Excluir" data-bs-original-title="Excluir" onclick="lancamentos_deletar( event, {{ $lancamento->id }} ) "><i class="fas fa-trash"></i></a>
                <!-- @else -->
                  <!-- <a onClick="lancamentos_restaurar({{ $lancamento->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a> -->
                <!-- @endif -->
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="11">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <td class="text-nowrap text-center">{{ $lancamento->count() }}</td>
        <td class="text-nowrap text-center"></td>
        <td class="text-nowrap text-left"></td>
        <td class="text-nowrap text-left"></td>
        <td class="text-nowrap text-left"></td>
        <td class="text-nowrap text-center"></td>
        <td class="text-nowrap text-right">{{ number_format($lancamento->sum('vlr_final'), 2, ',', '.') }}</td>
        <td class="text-nowrap text-center"></td>
        <td class="text-nowrap text-center"></td>
        <td class="text-nowrap text-center"></td>
        </tr>
    </tfoot>
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

<script>
  function lancamentos_deletar( e, id )
  {
    alert("O lançamento "+id+" será apagada.")
    e.preventDefault();

    var url = "{{ route('fin.lancamentos.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '8727535a' ] )
    .then( function(response)
    {
      lancamentos_tabelar();
    })
  }
</script>