<div class="col-md-4">
  <div class="card card-default">
    {{-- <div class="ribbon-wrapper ribbon-xl"> --}}
      {{-- <div class="ribbon bg-success">Confirmada</div> --}}
    {{-- </div> --}}
    <div class="card-header">
      <h3 class="card-title">Faturas</h3>
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('fin.bancos.adicionar') }}"><i class="fa-solid fa-angle-left" onclick="alert('s')"></i></a>
            <a class="btn btn-sm btn-default" href="{{ route('fin.bancos.adicionar') }}"><i class="fa-solid fa-angle-right" onclick="alert('s')"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <44>Maio / 2022</44>
      <p class="d-flex flex-column text-right">
        <span class="text-left h2">R$ 450,00</span>
        <span class="text-left text-muted">Vencimento: 01/05/2022</span>
        <span class="text-right">Botão</span>
      </p>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">
function atualizar_faturas(id, mes)
{
  var url = "{{ route('fin.lancamentos.faturas', ':id' ) }}";
  var url = url.replace(':id',  $('#id_cliente').val() );

  axios.get(url)
  .then( function(response)
  {
    console.log(response.data)
    alert('sasas')
  })
}
</script>
@endpush