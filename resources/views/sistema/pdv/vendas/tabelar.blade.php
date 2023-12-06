<div class="row">
  @forelse($vendas->sortBy('status') as $venda)
  <div class="col-4">
    <div class="card card-{{ $venda->status == 'Finalizada' ? 'success collapsed-card' : 'warning' }}">
      <div class="card-header">
        <h3 class="card-title">{{ $venda->id }} - {{ isset($venda->id_cliente) ? $venda->lufqzahwwexkxli->apelido ?? '(Sem Cadastro)' : 'ERROR' }}</h3>
        <div class="card-tools">
          @if($venda->id_caixa == Auth::User()->abcde->first()->id )
          <a href="" class="btn btn-default btn-sm" data-bs-tt="tooltip" title="" data-bs-original-title="Excluir" style="color: black;" onclick="venda_deletar( event, {{ $venda->id }} ) "><i class="fas fa-trash"></i></a>
          @endif
          @if($venda->status == 'Aberta')
            <a href="{{ route('pdv.vendas.pagar', $venda->id) }}" class="btn btn-default btn-sm" data-bs-tt="tooltip" title="" data-bs-original-title="Pagar"><i class="fas fa-money-bill-wave-alt"></i></a>
            {{--
              <a href="{{ route('vendas.adicionarItens', $venda->id) }}" class="btn btn-default btn-sm" data-bs-tt="tooltip" title="" data-bs-original-title="Adicionar Itens"><i class="glyphicon glyphicon-edit"></i></a>
            --}}
          @else
            <a class="btn btn-default btn-sm" href="{{ route('pdv.vendas.imprimir', $venda->id) }}" target="_blank" style="color: black;"><i class="fas fa-print"></i></a>
          @endif
          @if($venda->status == 'Aberta')
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          @else
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
          @endif
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-striped no-padding table-valign-middle table-hover table-condensed">
          <thead class="table-dark">
            <tr>
              <th class='text-center p-2'><strong>Profissional</strong></th>
              <th class='text-left p-2'><strong>Comissão</strong></th>
              <th class='text-left p-2'><strong>Qtd</strong></th>
              <th class='text-left p-2'><strong>Descrição</br><small>(Serviço / Produto)</strong></small></th>
              <th class='text-right p-2'><strong>Valor</strong></th>
            </tr>
          </thead>
          <tbody id="campos_contatos">
            @forelse($venda->dfyejmfcrkolqjh as $key => $item)
            <tr>
              <td class="text-center p-2"><small>{!! $item->hgihnjekboyabez->xeypqgkmimzvknq->foto_tabela ?? ' - ' !!}</small></td>
              <td class="text-center p-2"><small>{{ number_format($item->hgihnjekboyabez->valor ?? 0 , 2, ',', '.') ?? ' - ' }}</small></td>
              <td class="text-center p-2"><small>{{ $item->quantidade ?? ' - ' }}</small></td>
              <td class="text-left p-2">{{ $item->kcvkongmlqeklsl->nome ?? 'Sem Nome' }}</td>
              <td class="text-right p-2">{{ number_format($item->vlr_final, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="5">Nenhum serviço / Produto lançado</td>
            </tr>
            @endforelse
          </tbody>  
          <tfoot>
            @if (count($venda->dfyejmfcrkolqjh) > 0)
            <tr>
              <th class='text-center' colspan="4"></th>
              <th class='text-right'>{{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'), 2, ',', '.') }}</th>
            </tr>
            @endif
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  @empty
  <div>
    <h3 class="card-title">Não há vendas realizadas nesse caixa ou não há caixa aberto no seu usuário.</h3>
  </div>
  @endforelse
</div>

<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $vendas->appends($dataForm)->links() }}
    @else
    {{ $vendas->links() }}
    @endif
  </div>
</div>

<script>
  function venda_deletar( e, id )
  {
    alert("A comanda "+id+" será apagada.")
    e.preventDefault();

    var url = "{{ route('pdv.vendas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '9377249a' ] )
    .then( function(response)
    {
      vendas_tabelar();
    })
  }
</script>