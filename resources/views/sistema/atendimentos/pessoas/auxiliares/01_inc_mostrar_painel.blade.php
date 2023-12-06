<div class="row">
  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="info-box bg-success">
      <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Data do cadastro</span>
        <span class="info-box-number">{{ \Carbon\Carbon::parse($pessoa->created_at)->format('d/m/Y') }}</span>
        <span class="progress-description">
          {{ \Carbon\Carbon::parse($pessoa->created_at)->diffForHumans(['parts' => 3,  'join' => true]) }}
        </span>
      </div>
    </div>
  </div>
  
  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="info-box bg-info">
      <span class="info-box-icon"><i class="fas fa-id-card"></i></span>
      <div class="info-box-content">
        <span class="info-box-text text-center">Quantidade de agendamentos</span>
        <span class="info-box-number text-center">{{ $pessoa->iemzmwadhadlask->count() > 0 ? optional($pessoa->iemzmwadhadlask)->where('start', '<', \Carbon\Carbon::today()->addDays(1))->count() : 0 }}</span>
        <span class="progress-description text-center">
          {!! $pessoa->iemzmwadhadlask->count() > 0 ? 'desde '.$pessoa->dia_desde_ultimo_agendamento.' até hoje' : '<small>(ainda não houve agendamentos)</small>' !!}
        </span>
      </div>
    </div>
  </div>
  
  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="info-box bg-warning">
      <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Último agendamento</span>
        <span class="info-box-number">{!! $pessoa->iemzmwadhadlask->count() > 0 ? \Carbon\Carbon::parse(optional($pessoa->iemzmwadhadlask)->sortBy('start')->where('start', '<', \Carbon\Carbon::today()->addDays(1))->last()->start)->format('d/m/Y H:i') : '<small>(ainda não houve agendamentos)</small>' !!}</span>
        <span class="progress-description">
        {{ $pessoa->iemzmwadhadlask->count() > 0 ? \Carbon\Carbon::parse(optional($pessoa->iemzmwadhadlask)->sortBy('start')->where('start', '<', \Carbon\Carbon::today()->addDays(1))->last()->start)->diffForHumans(['parts' => 3,  'join' => true]) : '' }}
        </span>
      </div>
    </div>
  </div>

  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="info-box bg-default">
      <div class="info-box-content">
        <span class="info-box-text float-start">Tempo desde a última comanda
          <span class="info-box-text float-end"><small class="text-muted" data-bs-tooltip="tooltip" data-bs-html="true" data-bs-title="Calcula a quantidade de tempo que se passou desde a última comanda realizada pelo cliente:</br></br>Até 30 dias (verde)</br>Até 60 dias (amarelo)</br>Acima de 60 dias (vermelho)"><i class="fas fa-circle-info"></i></small></span>
        </span>
        <div class="project_progress">
          <div class="progress" style="height: 10px;margin-bottom: 0px;margin-top: 0px;">
            <div class="progress-bar bg-{{ $pessoa->dia_desde_ultima_venda_color }} h-100" role="progressbar" style="width: {{ $pessoa->dia_desde_ultima_venda / 90 * 100 }}%"></div>
          </div>
          <div class="d-flex justify-content-between">
            <small class="float-start">0</small>
            <strong class="text-center">{{ $pessoa->iemzmwadhadlask->count() > 0 ? $pessoa->dia_desde_ultima_venda . ' dias' : 'Nao há comandas' }}</strong>
            <small class="float-end">90 dias</small>
          </div>
          <small class="float-end">90 dias</small>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="info-box bg-default">
      <div class="info-box-content">
        <span class="info-box-text float-start">Frequência de agendamento
          <span class="info-box-text float-end"><small class="text-muted" data-bs-tooltip="tooltip" data-bs-html="true" data-bs-title="Calcula a frequência com que o cliente costuma fazer agendamentos:</br></br>Até 15 dias (verde)</br>Até 29 dias (amarelo)</br>Acima de 30 dias (vermelho)"><i class="fas fa-circle-info"></i></small></span>
        </span>
        <div class="project_progress">
          <div class="progress" style="height: 10px;margin-bottom: 0px;margin-top: 0px;">
            <div class="progress-bar bg-{{ $pessoa->frequencia_agendamentos['color'] }} h-100" role="progressbar" style="width: {{ $pessoa->frequencia_agendamentos['frequencia'] / 30 * 100 }}%"></div>
          </div>
          <div class="d-flex justify-content-between">
            <small class="float-start">{{ \Carbon\Carbon::parse($pessoa->frequencia_agendamentos['data_primeiro'])->format('d/m/Y') }}</small>
            <strong class="text-center">{{ number_format($pessoa->frequencia_agendamentos['frequencia'], 1, ',', '.') . ' dias' }}</strong>
            <small class="float-end">{{ \Carbon\Carbon::parse($pessoa->frequencia_agendamentos['data_ultimo'])->format('d/m/Y') }}</small>
          </div>
          <span>
            <small>*
              @if($pessoa->frequencia_agendamentos['quantidade'] == 1)
              Houve somente {{ $pessoa->frequencia_agendamentos['quantidade'] }} até hoje.
              @else
              Houve {{ $pessoa->frequencia_agendamentos['quantidade'] }} agendamentos em um intervalo de {{ $pessoa->frequencia_agendamentos['tempo_entre'] }} dias.
              @endif
            </small>
          </span>
        </div>
      </div>
    </div>
  </div>

	<div class="col-4">
		<div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ number_format($pessoa->eidwuedoeduzdsd->sum('vlr_final'), 2, ',', '.') }}</h3>
				<p>Faturamento</p>
			</div>
			<div class="icon">
        <i class="fas fa-dollar-sign"></i>
			</div>
      
		</div>
	</div>
</div>

<div class="row">
  <div class="col-4">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="fas fa-strikethrough"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Taxa de Cancelamento</span>
        <span class="info-box-number">1,410</span>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-undo-alt"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Taxa de Retorno</span>
        <span class="info-box-number">410</span>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-cubes"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pacotes em Aberto</span>
        <span class="info-box-number">13,648</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-4">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-clock"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Tempo como Cliente</span>
        <span class="info-box-number">1,410</span>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-wallet"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Débitos</span>
        <span class="info-box-number">13,648</span>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-trophy"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pontos de Fidelidade</span>
        <span class="info-box-number">410</span>
      </div>
    </div>
  </div>
</div>

@push('js')
<script>
  var tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]');
  var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
@endpush