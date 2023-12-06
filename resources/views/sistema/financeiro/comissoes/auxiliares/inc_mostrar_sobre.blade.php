<div class="row">
  <h3 class="card-title pl-0 pb-3"><strong>Sobre o Produto</strong></h3>
</div>
<div class="row">
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted"># ID</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->id }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Nome</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->nome }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Marca</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->marca ?? '-' }}
      </div>
    </div>
  </div>
  
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Tipo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->tipo }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Categoria</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->ecgklyqfdcoguyj->nome ?? $produto->id_categoria ?? '-' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Unidade</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->unidade ?? ' - '}}
      </div>
    </div>
  </div>
</div>

<hr>

@if($produto->tipo == 'Produto')
<div class="row">
  <h3 class="card-title pl-0 pb-3"><strong>Estoque</strong></h3>
</div>
<div class="row">
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Total Comprado</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->ProdutoNoDetalheDaComanda->sum('qtd') ?? ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Total Vendido</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ isset($produto->ServicoOuProdutoNoDetalheDaComanda) ? $produto->ServicoOuProdutoNoDetalheDaComanda->count() : ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Atual</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_atual ?? ' - ' }}
      </div>
    </div>
  </div>
  
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Máximo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_max ?? ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Mínimo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_min ?? ' - ' }}
      </div>
      
    </div>
  </div>
</div>
@else

<div class="row">
  <h3 class="card-title pl-0 pb-3"><strong>Duração</strong></h3>
</div>
<div class="row">
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Duração</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->duracao ?? ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Total Vendido</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ isset($produto->ServicoOuProdutoNoDetalheDaComanda) ? $produto->ServicoOuProdutoNoDetalheDaComanda->count() : ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Atual</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_atual ?? ' - ' }}
      </div>
    </div>
  </div>
  
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Máximo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_max ?? ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Mínimo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_min ?? ' - ' }}
      </div>
      
    </div>
  </div>
</div>
@endif
<hr>

<div class="row">
  <h3 class="card-title pl-0 pb-3"><strong>Custos e Valores</strong></h3>
</div>
<div class="row">
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Valor de Venda Atual</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        R$ {{ number_format($produto->vlr_venda ?? 0, 2, ',', '.') }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Valor Médio Vendido</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        R$ {{ isset($produto->ServicoOuProdutoNoDetalheDaComanda) ? number_format($produto->ServicoOuProdutoNoDetalheDaComanda->where('vlr_final', '>' ,0)->avg('vlr_final') ?? 0, 2, ',', '.') : ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Atual</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_atual ?? ' - ' }}
      </div>
    </div>
  </div>
  
  <div class="col-6">
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Máximo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_max ?? ' - ' }}
      </div>
      
      <div class="col-sm-4 invoice-col pb-3">
        <strong class="text-muted">Estoque Mínimo</strong><br>
      </div>
      <div class="col-sm-8 invoice-col pb-3">
        {{ $produto->estoque_min ?? ' - ' }}
      </div>
      
    </div>
  </div>
</div>
  