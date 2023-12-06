@extends('layouts.app')

@section('content')
<form id="form-aReceber-geral">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="overlay" id="overlay-contas_a_receber">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Contas à receber (Cursos)</h3>
          @can('Contas à Receber.Criar')
          <div class="card-tools">
            <div class="btn-toolbar">
              <div class="btn-group">
                <a class="btn btn-sm btn-default" href="{{ route('fin.contas_a_receber.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
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
                  <input type="date" class="form-control form-control-sm text-center" id="dt_consulta" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" onchange="aReceber_tabelar()">
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
        
        <div class="card-body table-responsive p-0" id="tabela-contas_a_receber">
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

            @include('includes.form.select_pluck', [
              'cols'   => 'col-3',
              'label'  => 'Local de recebimento',
              'name'   => 'id_banco',
              'id'     => 'id_banco',
              'value'  => $servprod->id_categoria ?? '',
              'rota'   => 'fin.bancos.plucar',
            ])

            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">Valor Total Selecionado</label>
                <div class="input-group">
                <input type="text" class="form-control form-control-sm text-right" id="vlr_total" value="0,00" readonly='true'>
                </div>
              </div>
            </div>

            <input type="hidden" name="selecionados" id="selecionados">

            <div class="col-3">
              <div class="form-group">
                <label class="col-form-label">&nbsp;</label>
                <div class="input-group">
                  <a class="btn btn-success btn-sm btn-block" onclick="aReceber_confirmar()">Confirmar Contas Selecionadas</a>
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
    aReceber_tabelar()
  });

  function aReceber_tabelar()
  {
    $('#overlay-contas_a_receber').show();
    
    url = "{{ route('fin.contas_a_receber.tabelar', ':dia') }}";
    url = url.replace(':dia', 'dt_consulta='+$('#dt_consulta').val() );

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-contas_a_receber').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '7010787a' ] )
    .then( function(response)
    {
      $('#overlay-contas_a_receber').hide();
    })
  }

  function subtrair_data()
  {
    dt_consulta = moment($('#dt_consulta').val())
    $('#dt_consulta').val( moment(dt_consulta).subtract(1, 'days').format('YYYY-MM-DD') )
    aReceber_tabelar()
  }

  function somar_data()
  {
    dt_consulta = moment($('#dt_consulta').val())
    $('#dt_consulta').val( moment(dt_consulta).add(1, 'days').format('YYYY-MM-DD') )
    aReceber_tabelar()
  }

  function somar_selecionados()
  {

    dt_consulta = moment($('#dt_consulta').val())
    $('#dt_consulta').val( moment(dt_consulta).add(1, 'days').format('YYYY-MM-DD') )
    aReceber_tabelar()
  }

  function aReceber_editar(id)
  {
    $('#overlay-contas_a_receber').show();
    
    var url = "{{ route('fin.contas_a_receber.editar', ':id') }}";
    var url = url.replace(':id', id);

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#modal-geral-1').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '5464343a' ] )
    .then( function()
    {
      $('#modal-geral-1').modal('show')
    })
    .then( function(response)
    {
      $('#overlay-contas_a_receber').hide();
    })
  }

  selecionados = [];  
  endereco = []
  function aReceber_selecionar(id)
  {
    $('#overlay-contas_a_receber').show();
    
    var url = "{{ route('fin.contas_a_receber.selecionar', ':id') }}";
    var url = url.replace(':id', id);

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
     
      endereco = response.data;

      selecionados.push(endereco);

      var JSONString = JSON.stringify(selecionados);
      $("#selecionados").val(JSONString);


      // selecionados.push(JSON.stringify(response.data));
      // $('#selecionados').val(selecionados);
    })
@include('includes.catch', [ 'codigo_erro' => '6444603a' ] )
    .then( function(response)
    {
      $('#overlay-contas_a_receber').hide();
    })
  }
  
  function aReceber_confirmar()
  {
    $('#overlay-contas_a_receber').show();
  
    var url   = "{{ route('fin.contas_a_receber.confirmar') }}";
    var dados = $('#form-aReceber-geral').serialize()

    axios.post(url, dados)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '3352884a' ] )
    .then( function(response)
    {
      aReceber_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-contas_a_receber').hide();
    })
  }

  function aReceber_excluir(id)
  {
    $('#overlay-contas_a_receber').show();

    var url = "{{ route('fin.contas_a_receber.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '7560718a' ] )
    .then( function(response)
    {
      aReceber_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-contas_a_receber').hide();
    })
  }


// ------------------------------------------------------------------------------------------------------------------------------------------------------------ COPIAR DEPOIS EXCLUIR
  // function aReceber_restaurar(id)
  // {
  //   $('#overlay-contas_a_receber').show();

  //   {{-- var url = "{{ route('fin.contas_a_receber.restaurar', ':id') }}"; --}}
  //   var url = url.replace(':id', id);

  //   axios.post(url)
  //   .then(function(response)
  //   {
  //     console.log(response.data)
  //     toastrjs(response.data.type, response.data.message)
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '3163298a' ] ) --}}
  //   .then( function(response)
  //   {
  //     aReceber_tabelar()
  //   })
  //   .then( function(response)
  //   {
  //     $('#overlay-contas_a_receber').hide();
  //   })
  // }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
