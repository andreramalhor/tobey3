<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Últimos Serviços</h3>
			</div>
			<div class="card-body p-0">
				<table class="table table-sm">
					<thead>
						<tr>
							<th class="text-center">Comanda</th>
							<th class="text-center">Data</th>
							<th class="text-center">Serviço</th>
							<th class="text-center">Valor</th>
						</tr>
					</thead>
					<tbody>
						@forelse($pessoa->eidwuedoeduzdsd as $vendas_detalhes)
						<tr>
              <td class='text-nowrap text-left'>
								<a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $vendas_detalhes->id_venda }})"><span class="badge bg-pink">{{ $vendas_detalhes->id_venda }}</span>
							</td>
							<td class="text-nowrap text-left">{{ \Carbon\Carbon::parse($vendas_detalhes->created_at)->format('d/m/Y') }}</td>
							<td class="text-nowrap text-left">{{ $vendas_detalhes->kcvkongmlqeklsl->nome ?? 'Erro SHOW.PESSOA 4' }}</td>
							<td class="text-nowrap text-right">{{ number_format($vendas_detalhes->vlr_final, 2, ',', '.') }}</td>
						</tr>
						@empty
						<tr>
							<td colspan="4">Não há serviços realizados.</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Últimos Produtos</h3>
			</div>
			<div class="card-body p-0">
				<table class="table table-sm">
					<thead>
						<tr>
							<th class="text-center">Data</th>
							<th class="text-center">Comanda</th>
							<th class="text-center">Produto</th>
							<th class="text-center">Valor</th>
						</tr>
					</thead>
					<tbody>
					@forelse($pessoa->eidwuedoeduzdsd as $vendas_detalhes)
						<tr>
							<td class='text-nowrap text-left'>
								<a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $vendas_detalhes->id_venda }})"><span class="badge bg-pink">{{ $vendas_detalhes->id_venda }}</span>
							</td>
							<td class="text-nowrap text-left">{{ \Carbon\Carbon::parse($vendas_detalhes->created_at)->format('d/m/Y') }}</td>
							<td class="text-nowrap text-left">{{ $vendas_detalhes->kcvkongmlqeklsl->nome ?? 'Erro SHOW.PESSOA 4' }}</td>
							<td class="text-nowrap text-right">{{ number_format($vendas_detalhes->vlr_final, 2, ',', '.') }}</td>
						</tr>
						@empty
						<tr>
							<td colspan="4">Não há serviços realizados.</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-4">
		<div class="small-box bg-warning">
			<div class="inner">
				<h3>99999</h3>
				<p>Dias sem vir</p>
			</div>
			<div class="icon">
				<i class="far fa-calendar-alt"></i>
			</div>

		</div>
	</div>
	<div class="col-4">
		<div class="small-box bg-info">
			<div class="inner">
				{{-- <h3>{{ $pessoa->iemzmwadhadlask->where('status', '=', 'Agendado')->groupBy(function($date) { return \Carbon\Carbon::parse($date->start)->format('d'); })->count() }}</h3> --}}
				<p>Agendamentos <sup>Desde jan/2021</sup></p>
			</div>
			<div class="icon">
				<i class="fas fa-hourglass-end"></i>
			</div>

		</div>
	</div>
	<div class="col-4">
		<div class="small-box bg-success">
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