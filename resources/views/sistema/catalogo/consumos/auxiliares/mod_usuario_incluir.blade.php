<div class="modal fade" id="modal_funcoes_usuarios_incluir" aria-hidden="true" style="display: none; color: black;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			{{-- <div class="overlay-modal-usuario-incluir"> --}}
				{{-- <i class="fas fa-2x fa-sync fa-spin"></i> --}}
			{{-- </div> --}}
      <div class="modal-header bg-navy" style="padding: 8px 16px">
				<h5 class="modal-title">Incluir Usuário</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label>Nome</label>
							<select class="form-control form-control-sm select2" name="id_pessoa" id="id_pessoa" onchange="pessoa_selecionar(this)">
								<option>Carregando. . . </option>
							</select>
						</div>
					</div>
				</div>
				<div class="row" id="pessoa_card">

				</div>
			</div>
      <div class="modal-footer justify-content-between" style="padding: 6px 12px">
				<a class="btn btn-default" style="color:black" data-bs-dismiss="modal" id='cancel_modal_funcoes_usuarios_incluir'>Cancel</a>
				<a class="btn btn-primary" style="color:white" id='adicionar_modal_funcoes_usuarios_incluir' onclick="funcoes_usuario_adicionar()">Adicionar</a>
			</div>
		</div>
	</div>
</div>

@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		$(window).on('shown.bs.modal', function()
		{ 
			$('#id_pessoa').select2({
				dropdownParent: $('#modal_funcoes_usuarios_incluir'),
			});
		});

		pessoas_listar()
	});

	var pessoas = [];

	function pessoas_listar()
	{
		axios.get("{{ route('pessoas.equipe.listar') }}")
		.then(function(response)
		{
			// console.log(response.data)
			(response.data).forEach((obj, i) => {
				people =
				{
					id: obj.id,
					text: obj.nome,
				}

				pessoas.push(people);

				$('#id_pessoa').select2({
					data: pessoas,
					placeholder: "Selecione uma pessoa",
				});
			});
		})
  	@include('includes.catch', [ 'codigo_erro' => '7885956a' ] )
		.then( function()
		{
			$('#overlay-modal-usuario-incluir').hide()
		})
	}

	function pessoa_selecionar(item)
	{
		url = "{{ route('pessoas.equipe.pesquisar', ':id') }}";
		url = url.replace(':id', item.value );

		axios.get(url)
		.then(function(response)
		{
			// console.log(response.data)
      $("#pessoa_card").empty().append(
        '<div class="offset-sm-1 col-10 col-offset-1 d-flex align-items-stretch flex-column ">'+
					'<div class="card bg-light d-flex flex-fill">'+
						'<div class="card-header text-muted border-bottom-0">'+response.data.username+'</div>'+
						'<div class="card-body pt-0">'+
							'<div class="row">'+
								'<div class="col-7">'+
									'<h2 class="lead"><b>'+response.data.nome+'</b></h2>'+
									'<p class="text-muted text-sm"><b>e-Mail: </b>'+response.data.email+'</p>'+
									// '<ul class="ml-4 mb-0 fa-ul text-muted">'+
										// '<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>'+
										// '<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>'+
									// '</ul>'+
								'</div>'+
								'<div class="col-5 text-center">'+
									'<img src="'+response.data.FotoPerfil+'" alt="'+response.data.nome+'" class="img-circle img-fluid" width="100" onerror="this.src=http://127.0.0.1:8000/img/atendimentos/pessoas/0.png">'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>');
		})
  	@include('includes.catch', [ 'codigo_erro' => '4476911a' ] )
		.then( function()
		{
			$('#overlay-modal-usuario-incluir').hide()
		})
	}

	function funcoes_usuario_adicionar()
	{
    var url = "{{ route('acl.funcoes.usuarios.adicionar', $funcao->id) }}";

    axios.post(url, [{
      id_pessoa: $("#id_pessoa").val(),
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
	@include('includes.catch', [ 'codigo_erro' => '3893915a' ] )
		.then(function ()
		{
			funcoes_usuarios_tabelar()
			$('#cancel_modal_funcoes_usuarios_incluir').click()
		})
	}
</script>
@endpush