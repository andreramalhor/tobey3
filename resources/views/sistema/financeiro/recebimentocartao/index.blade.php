@extends('layouts.app')

@section('content')
<form id="form-recCartoes-geral">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="overlay" id="overlay-cartoes">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Valores de cartões a receber</h3>
          @can('Recebimento de Cartões.Criar')
          <div class="card-tools">
            <div class="btn-toolbar">
              <div class="btn-group">
                <a class="btn btn-sm btn-default" href="{{ route('fin.rec_cartoes.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          @endcan
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">Data </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text form-control-sm" onclick="subtrair_data()"><i class="fas fa-chevron-left"></i></span>
                  </div>
                  <input type="date" class="form-control form-control-sm text-center" id="dt_consulta" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" onchange="recCartoes_tabelar()">
                  <div class="input-group-append">
                    <div class="input-group-text form-control-sm" onclick="somar_data()"><i class="fas fa-chevron-right"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">

            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">Lançamento Avulso</label>
                <div class="input-group">
                  <a class="btn btn-success btn-sm btn-block">Lançar</a>
                </div>
              </div>
            </div>
            <!-- <div class="col-4">
              <label class="col-form-label">Apelido<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm" name="apelido" onchange="validar(this)">
            </div> -->
          </div>
        </div>
        
        <div class="card-body table-responsive p-0" id="tabela-cartoes">
          <table class="table table-sm table-striped no-padding table-valign-middle projects">
            <thead>
              <tr>
                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">Carregando...</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">Data de recebimento</label>
                <input type="date" class="form-control form-control-sm text-center" name="dt_recebimento" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                <input type="hidden" name="status" value="Confirmado">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">Local de recebimento</label>
                <select class='form-control form-control-sm' name="id_banco" onchange='calcular_valores("bandeira")'>
                  <option value='6'>Sicoob CredCooper</option>
                  <option value='4'>Sicoob Credileste</option>
                  <option value='3'>Caixa Econômica Federal</option>
                  <option value='2'>Caixa (Gaveta)</option>
                  <option value='1'>Cofre</option>
                  <option value='5'>Caixa (Modelos)</option>
              </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">Valor Total Selecionado</label>
                <div class="input-group">
                <input type="text" class="form-control form-control-sm text-right" id="vlr_total" value="0,00" readonly='true'>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">&nbsp;</label>
                <div class="input-group">
                  <a class="btn btn-success btn-sm btn-block" onclick="recCartoes_confirmar()">Confirmar Cartões Selecionados</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    recCartoes_tabelar()
  });

  function recCartoes_tabelar()
  {
    $('#overlay-cartoes').show();
    
    url = "{{ route('fin.rec_cartoes.tabelar', ':dia') }}";
    url = url.replace(':dia', 'dt_consulta='+$('#dt_consulta').val() );

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-cartoes').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '6865816a' ] )
    .then( function(response)
    {
      $('#overlay-cartoes').hide();
    })
  }

  function subtrair_data()
  {
    dt_consulta = moment($('#dt_consulta').val())
    $('#dt_consulta').val( moment(dt_consulta).subtract(1, 'days').format('YYYY-MM-DD') )
    recCartoes_tabelar()
  }

  function somar_data()
  {
    dt_consulta = moment($('#dt_consulta').val())
    $('#dt_consulta').val( moment(dt_consulta).add(1, 'days').format('YYYY-MM-DD') )
    recCartoes_tabelar()
  }

  function somar_selecionados()
  {

    dt_consulta = moment($('#dt_consulta').val())
    $('#dt_consulta').val( moment(dt_consulta).add(1, 'days').format('YYYY-MM-DD') )
    recCartoes_tabelar()
  }

  function recCartoes_editar(id)
  {
    $('#overlay-cartoes').show();

    var url = "{{ route('fin.rec_cartoes.editar', ':id') }}";
    var url = url.replace(':id', id);

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#modal-geral-1').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '7082664a' ] )
    .then( function()
    {
      $('#modal-geral-1').modal('show')
    })
    .then( function(response)
    {
      $('#overlay-cartoes').hide();
    })
  }

  function recCartoes_confirmar()
  {
    $('#overlay-cartoes').show();

    var url   = "{{ route('fin.rec_cartoes.confirmar_sel') }}";
    var dados = $('#form-recCartoes-geral').serialize()

    axios.post(url, dados)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '3761294a' ] )
    .then( function(response)
    {
      recCartoes_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-cartoes').hide();
    })
  }

  function recCartoes_excluir(id)
  {
    $('#overlay-cartoes').show();

    var url = "{{ route('fin.rec_cartoes.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '461996a' ] )
    .then( function(response)
    {
      recCartoes_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-cartoes').hide();
    })
  }


// ------------------------------------------------------------------------------------------------------------------------------------------------------------ COPIAR DEPOIS EXCLUIR
  // function recCartoes_restaurar(id)
  // {
  //   $('#overlay-cartoes').show();

  //   {{-- var url = "{{ route('fin.rec_cartoes.restaurar', ':id') }}"; --}}
  //   var url = url.replace(':id', id);

  //   axios.post(url)
  //   .then(function(response)
  //   {
  //     console.log(response.data)
  //     toastrjs(response.data.type, response.data.message)
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '064930a' ] ) --}}
  //   .then( function(response)
  //   {
  //     recCartoes_tabelar()
  //   })
  //   .then( function(response)
  //   {
  //     $('#overlay-cartoes').hide();
  //   })
  // }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
