<div class="card bg-gradient-primary" style="height: 40vh; position: relative;">
  <div class="card-header">
    <h3 class="card-title">Observação registradas do Número selecionado/discando acima</h3>
  </div>
  <div class="card-body">        
    @if(isset($lead) && $lead->count() > 0)
      <li class="item pl-1 pr-1" onclick="lead_selecionar({{ $lead->id }})" style="cursor: pointer;" id="lead_{{ $lead->id }}">
        <div class="product-info">
          <a class="product-title">{{ $lead->nome ?? '' }}
            <span class="badge badge-warning float-right">{{ $lead->telefone ?? '' }}</span>
          </a>
          <span class="product-description">{{ $lead->status ?? '' }}</span>
        </div>
      </li>
    @endif
  </div>
  <div class="card-footer">
    footer  
  </div>
</div>