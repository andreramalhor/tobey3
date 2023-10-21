<div class="card-header">
  <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>{{ $titulo ?? 'Título' }}</h3>
  <div class="card-tools">
    @if(1==2)
    <ul class="nav nav-pills ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="#revenue-chart" data-bs-toggle="tab">{{ $botao1 ?? 'Botão 1' }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#sales-chart" data-bs-toggle="tab">{{ $botao2 ?? 'Botão 2' }}</a>
      </li>
    </ul>
    @endif
  </div>
</div>

