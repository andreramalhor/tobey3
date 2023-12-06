
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Clientes Fixas</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row" id="boxes_fixas">
        ...
      </div>
    </div>
    <div class="card-footer clearfix">
      
    </div>
  </div>
</div>

@push('js')
<script>

agendamentos_fixos()

function agendamentos_fixos()
{
  url = "{{ route('atd.agendamentos.fixas') }}";

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#boxes_fixas').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '3652485a' ] )
}

function fixas_excluir( id_grupo )
{
  url = "{{ route('atd.agendamentos.fixas_deletar') }}";
  
  axios.post(url, [id_grupo])
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '6131351a' ] )
  .then(function ()
  {
    agendamentos_fixos()
  })
}
</script>
@endpush