<div class="row" id="mostrarFinanceiro">
	<div class="col-12">
		<div class="card">
			<div class="card-body table-responsive p-0">
  			<table class="table table-sm table-bordered no-padding table-valign-middle projects">
    			<thead class="table-dark">				
						<tr>
							<th class="text-center">Parcela</th>
							<th class="text-center">Turma</th>
							<th class="text-rigth">Vlr. Bruto</th>
							<th class="text-rigth">Vlr. Desc./Acr.</th>
							<th class="text-rigth">Vlr. Líquido</th>
							<th class="text-rigth">Status</th>
							<th class="text-rigth">Vlr. Pago</th>
						</tr>
					</thead>
					<tbody id="financeiro_tbody">
					</tbody>
					<tfoot id="financeiro_tbodyas">
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>



@push('js')
<script type="text/javascript">  
  function mostrarFinanceiro()
  {
    $('#financeiro-overlay').hide();

    var url = "{{ route('fin.contas_a_receber.por_aluno', ':idd') }}"
    var url = url.replace(':idd', {{ $pessoa->id_rsschool ?? '' }} )
    
    axios.get(url)
    .then( function(response)
    {
      $('#financeiro_tbody').empty()
      console.log(response.data)
      collect(response.data).each((value, key) =>
      {
        console.log(value)
        $('#financeiro_tbody').append(
          '<tr class="bg-'+value.cor_status+'">'+
          '<td class="text-center">'+value.parcela+'</td>'+
            '<td class="text-center">'+value.turma+'</td>'+
            '<td class="text-rigth">'+value.vlr_bruto+'</td>'+
            '<td class="text-rigth">'+value.vlr_desconto_acrescimo+'</td>'+
            '<td class="text-rigth">'+value.vlr_liquido+'</td>'+
            '<td class="text-rigth">'+value.status+'</td>'+
            '<td class="text-rigth">'+value.vlr_final+'</td>'+
          '</tr>');
      });
    })
@include('includes.catch', [ 'codigo_erro' => '6701998a' ] )
  }

  function liberar_input_comissao(item)
  {
    // $('#input_comissao_'+item.id+'').attr( 'disabled', true )
    let pessoa = item.id;

    if ($(item).is(':checked'))
    {
      $(item).attr( 'checked', true )
      $('#input_comissao_'+item.id+'').attr( 'disabled', false )
      comissoes_pessoas_editar(pessoa, 'on')
    }
    else
    {
      $(item).attr( 'checked', false )
      $('#input_comissao_'+item.id+'').attr( 'disabled', true )
      comissoes_pessoas_editar(pessoa, 'off')
    }
  }

  function comissoes_pessoas_editar(pessoa, status)
  {
    var url = "{{ route('atd.pessoas.produto_comissao') }}";

    axios.put(url, [{
      pessoa   : pessoa,
      produto  : 5,
      comissao : $('#input_comissao_'+pessoa+'').val(),
      status   : status
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '8882102a' ] )
  }

  
</script>
@endpush
