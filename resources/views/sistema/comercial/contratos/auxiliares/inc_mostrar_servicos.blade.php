<div class="row">
	<div class="col-12">
		<div class="card-tools float-end">
			<div class="btn-toolbar">
				<div class="input-group input-group-sm mb-2">
					<div class="btn-group">
						@can('Serviços.Editar')
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_servico_adicionar"><i class="fa-solid fa-plus"></i></a>
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_servico_adicionar_lote"><i class="fa-solid fa-folder-plus"></i></a>
						@endcan
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body table-responsive p-0">
  			<table class="table table-sm table-striped no-padding table-valign-middle projects">
    			<thead class="table-dark">				
						<tr>
							<th class="text-center" width="5%">#</th>
							<th class="text-center" width="7%"></th>
							<th class="text-left" width="">Nome</th>
							<th class="text-center" width="10%">Tipo</th>
							<th class="text-center" width="5%">Duração</th>
							<th class="text-right" width="10%">Valor<br>Venda</th>
							<th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
						</tr>
					</thead>
					<tbody id="servicosMostrarServicos">
					</tbody>
					<tfoot id="servicosMostrarServicosFoot">
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

@include('sistema.catalogo.categorias.auxiliares.mod_servico_adicionar')
@include('sistema.catalogo.categorias.auxiliares.mod_servico_adicionar_lote')