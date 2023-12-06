<div class="row">
	<div class="col-12">
		<div class="card-tools float-end">
			<div class="btn-toolbar">
				<div class="input-group input-group-sm mb-2">
					<div class="btn-group">
						@can('Fornecedor.Editar')
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_fornecedor_adicionar"><i class="fa-solid fa-plus"></i></a>
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
							<th class="text-center" width="">CPF/CNPJ</th>
							<th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
						</tr>
					</thead>
					<tbody>
            @forelse( $produto->xcuwqubcfetnftm as $fornecedor )
            <tr>
							<td class="text-nowrap text-center" width="5%">{{ $fornecedor->id }}</td>
							<td class="text-nowrap text-center" width="7%">{!! $fornecedor->foto_tabela !!}</td>
							<td class="text-nowrap text-left" width="">{{ $fornecedor->apelido }}</td>
							<td class="text-nowrap text-center" width="10%">{{ $fornecedor->cpf }}</td>
							<td class="text-nowrap text-center">{{ $fornecedor->id }}</td>
						</tr>
            @empty
						<tr>
							<td class="text-center" colspan="5">Não há fornecedores cadastrado para esse produto</td>
						</tr>
            @endforelse
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@include('sistema.catalogo.produtos.auxiliares.mod_fornecedor_adicionar')
