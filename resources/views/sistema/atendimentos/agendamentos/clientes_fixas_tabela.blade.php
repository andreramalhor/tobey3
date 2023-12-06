@forelse ($grupos_fixas as $fixas)
<div class="col-md-3">
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">{{ optional($fixas->first()->xhooqvzhbgojbtg)->apelido }}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="row invoice-info">
        <div class="col-12 invoice-col pb-3">
          <strong class="text-muted"># Fixo: </strong> {{ $fixas->first()->grupo }}
        </div>
        
        <div class="col-12 invoice-col pb-3">
          <strong class="text-muted">Serviço: </strong> {{ $fixas->first()->zlpekczgsltqgwg->nome }}
        </div>
        
        <div class="col-12 invoice-col pb-3">
          <strong class="text-muted">Qtd dos fixos futuros: </strong> {{ $fixas->where('start', '>', now() )->count() }}
        </div>
        
        <div class="col-12 invoice-col pb-3">
          <strong class="text-muted">Data do agendamento Fixo: </strong> {{ \Carbon\Carbon::createFromTimestamp( $fixas->first()->grupo / 1000)->format('d/m/Y H:i') }}
        </div>
        
        <div class="col-12 invoice-col pb-3">
          <strong class="text-muted">Primeiro: </strong> {{ \Carbon\Carbon::parse( $fixas->first()->start )->format('d/m/Y H:i') }} {{ \Carbon\Carbon::parse( $fixas->first()->start )->localeDayOfWeek }}
        </div>
        
        <div class="col-12 invoice-col pb-3">
          <strong class="text-muted">Último: </strong> {{ \Carbon\Carbon::parse( $fixas->last()->start )->format('d/m/Y H:i') }} {{ \Carbon\Carbon::parse( $fixas->last()->start )->localeDayOfWeek }}
        </div>
      </div>
      
    </div>
    <div class="card-footer">
      <a onClick="fixas_excluir( {{ $fixas->first()->grupo }} )" style="cursor: pointer;" class="text-muted float-end" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
    </div>
  </div>
</div>
@empty
  Não há agendamentos fixos cadastrados.
@endforelse