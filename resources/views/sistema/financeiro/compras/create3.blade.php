@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('pdv.vendas.store') }}" id="form_venda_create" autocomplete="off">
  @csrf
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <input type="hidden" name="tipo" value="Venda">
  <input type="hidden" name="ativo" value="1">
  <div class="row">
    <div class="col-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="overlay" id="overlay_cliente">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
              <h3 class="card-title">Cliente</h3>
              <div class="card-tools">
                <div class="btn-group">
                  {{-- <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a> --}}
                  <a class="btn btn-sm btn-default" id="mudar-cliente" style="display: none;"><i class="fas fa-undo"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body" id="card-cliente-select">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Nome do Cliente<font color="red">*</font></label>
                  <input type="hidden" name="id_comanda" id="id_comanda" value="{{ $comanda->id ?? null }}">
                  <select class="form-control form-control-sm select2" name="id_cliente" onchange="selecionarCliente(this)">
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" 
                      @if($cliente->id == $cliente->id)
                      {{-- @if($comanda->id_cliente == $cliente->id) --}}
                      selected="selected" 
                      @endif
                      >{{ $cliente->nomes }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="card card-widget widget-user-2">
                <div class="widget-user-header" style="background-color: #dea6c4 !important; padding: 10px;">
                  <div class="widget-user-image">
                    <img class="img-circle info_profile-pic" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar">
                  </div>
                  <h5 class="widget-user-desc" id="widget-user-nickname">Apelido</h5>
                  <h6 class="widget-user-desc" id="widget-user-name">Nome</h6>
                  <p class="widget-user-desc" id="widget-user-desc" style="margin-bottom: 0px">Observação</p>
                </div>
              </div>
            </div>
          </div>
          <div id="escolher_profissional" style="display: none;">
            <div class="col-12">
              <div class="card">
                <div class="overlay" id="overlay_profissional" style="display: none;">
                  <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="card-header">
                  <h3 class="card-title">Profissional</h3>
                  <div class="card-tools">
                    <div class="btn-group">
                      <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                      <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12" style="display: none;">
                    <label class="col-form-label">Nome do Profissional<font color="red">*</font></label>
                    <select class="form-control form-control-sm select2" name="id_profexec" onchange="selecionaProfissional(this)" data-origem="select">
                      <option value="" >Selecione . . .</option>
                      @foreach($profissionais as $profissional)
                      <option value="{{ $profissional->id }}" >{{ $profissional->apelido }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="card-body" style="padding: 0px;">
                  <div class="row">
                    <div class="col-2">
                      <div class="card-body no-padding" style="margin-top: 10px; display: none;">
                        <input type="hidden" name="pdv_comandas" id="pdv_comandas" value="">
                      </div>
                      <div class="radio-group">
                        @foreach($profissionais as $profissional)
                        <img src="{{ asset('img/atendimentos/pessoas/'. $profissional->id .'.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_{{ $profissional->id }}" data-value="{{ $profissional->id }}" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="{{ $profissional->apelido }}">
                        @endforeach
                      </div>
                    </div>
                    <div class="col-10" style="padding: 5px 10px 3px 0px">

                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-filter fa-sm"></i></span>
                        </div>
                        <input type="text" class="form-control btn-sm" aria-describedby="inputGroup-sizing-sm" placeholder="Filtrar">
                      </div>
                      <table class="table table-sm table-bordered">
                        <thead>                  
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th class="text-center">Valor</th>
                          </tr>
                        </thead>
                        <tbody id="produtos-servicos">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>

  {{--               <div class="row">
                  <div class="col-12">
                    <label class="col-form-label">Nome Cliente<font color="red">*</font></label>
                    <select class="form-control form-control-sm" name="id_cliente" onchange="validar(this)">
                      <option value="">Selecione . . .</option>

                    </select>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-8" style="display: none;">>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Itens da Venda</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Profissional<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_profexec" onchange="validar(this)">
                    <option value="">Selecione . . .</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Itens da Venda</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Profissional<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_profexec2" onchange="validar(this)">
                    <option value="">Selecione . . .</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('pdv.vendas.index') }}" class="btn btn-secondary">Cancel</a>
      <a class="btn btn-success float-right" style="color:white" id='submit_venda_create'>Cadastrar</a>
    </div>
  </div>
</form>
@endsection
{{-- 
@section('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  $("[name='vlr_venda'], [name='vlr_custo'], [name='vlr_cst_adicional']").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': false,
    'prefix': '',
    'placeholder': '0,00',
  });
});

function validar(field)
{
  let campo = $(field);
  let n_campo = campo.attr('name');
  let v_campo = campo.val();

  let dados = {
    [n_campo]: v_campo,
  }

  axios.post('{{ route('pdv.vendas.triate') }}', dados)
  .then(function(response)
  {
    console.log(response)
    campo.removeClass('is-warning');
    campo.removeClass('is-invalid');
    campo.addClass('is-valid');
  })
@include('includes.catch', [ 'codigo_erro' => '5484215a' ] )

$("#submit_venda_create").on('click', function(e)
{
  e.preventDefault();

  let dados = $('#form_venda_create').serialize();

  axios.post('{{ route('pdv.vendas.store') }}', dados)
  .then(function(response)
  {
    console.log(response)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '7507785a' ] )
});
</script>
@endsection --}}

@push('css')
<style type="text/css">
  .radio-group {
    position: relative;
  }

  .radio {
    display:inline-block;
    cursor:pointer;

    border: solid 1px transparent;
  }

  .radio.selected {
    box-shadow: 0px 0px 5px 2px #d34d8d;
  }
</style>
@endpush

@push('css')
<style type="text/css">
  .radio-group
  {
    position: relative;
  }

  .radio
  {
    display:inline-block;
    cursor:pointer;

    border: solid 1px transparent;
  }

  .radio.selected
  {
    card-shadow: 0px 0px 5px 2px #d34d8d;
  }
</style>
@endpush

@push('js')
<script>
  $(document).ready(function()
  {
    desconto_predefinido    = 0; // Identifica Influencer Digital, Desconto Cliente VIP ou Preço especial para Sócio ou Colaborador
    tipo_comissao           = "Normal"; // Identifica se comissão será sobre o preço tabelado ou sobre o preço com desconto
    informacoesdapessoa = 0;

    pdv_comandas = {};
    // PDVComandas();

    // $('#id_cliente').change();
    // selecionarCliente($('#id_cliente'));
    // mostrarItens();
    $('#overlay_cliente').hide();
  });

  function selecionarCliente(field) {

    let id_cliente = field.value;

    if(id_cliente != "") {

      url = "{{ route('pessoa.find', ':id') }}";
      url = url.replace(':id', [id_cliente] );

      axios.post(url)
      .then( function(response) {
        $('#overlay_cliente').show();
        // console.log(response)
        desconto_predefinido    = 0; // Identifica Influencer Digital, Desconto Cliente VIP ou Preço especial para Sócio ou Colaborador
        tipo_comissao           = "Normal"; // Identifica se comissão será sobre o preço tabelado ou sobre o preço com desconto
        selo                    = [];

        if(response.data.dsnewksmasknasj.filter(x => x.id === 8).map(x => x.nome) == "Influencer Digital")
        {
          desconto_predefinido    = -1;
          tipo_comissao           = "Tabelado";
          selo                    = response.data.dsnewksmasknasj.filter(x => x.id === 8).map(x => x.nome); 
        }
        else if(response.data.dsnewksmasknasj.filter(x => x.id === 6).map(x => x.nome) == "Cliente VIP")
        {
          desconto_predefinido    = "VIP";
          tipo_comissao           = "Comissão";
          selo                    = response.data.dsnewksmasknasj.filter(x => x.id === 6).map(x => x.nome); 
        }
        else if(response.data.dsnewksmasknasj.filter(x => x.id === 4).map(x => x.nome) == "Colaborador")
        {
          desconto_predefinido    = -0.3;
          tipo_comissao           = "Final";
          selo                    = response.data.dsnewksmasknasj.filter(x => x.id === 4).map(x => x.nome); 
        }

        $(".info_profile-pic").attr('src', response.data.foto_perfil);

        if(selo.length != 0)
        {
          $("#widget-user-nickname").text(response.data.apelido+'  ').append('<span class="badge bg-pink">'+selo+'</span>');
        }
        else if(response.data.saldo_conta > 0)
        {
          $("#widget-user-nickname").text(response.data.apelido+'  ').append('<span class="badge bg-green">'+new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(response.data.saldo_conta)+'</span>');
        }
        else if(response.data.saldo_conta < 0)
        {
          $("#widget-user-nickname").text(response.data.apelido+'  ').append('<span class="badge bg-red">'+new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(response.data.saldo_conta)+'</span>');
        }
        else
        {
          $("#widget-user-nickname").text(response.data.apelido);
        }

        $("#widget-user-saldo").text(response.data.saldo+'  ').append('');
        $("#widget-user-name").text(response.data.nome);
        $("#widget-user-desc").text(response.data.observacao);
      })
  @include('includes.catch', [ 'codigo_erro' => '5523095a' ] )
      .then( function() {
        setTimeout(function() {
          $('#overlay_cliente').hide();
        }, 500);

        abrirComanda(id_cliente)
      })
    }
  }

  function abrirComanda(id_cliente) {
    let dados = {
      'id_cliente'    : id_cliente,
      {{-- 'id_caixa'      : "{{ $caixa['db']->id }}", --}}
      'id_usuario'    : "{{ \Auth::User()->id }}",
      'status'        : "Aberta",
      'id_comanda'    : $("#id_comanda").val(),
    }

    axios.post('{{ route('pdv.vendas.store') }}', dados)
    .then( function(response) {
      // console.log(response)
      // $('#overlay_cliente').show();
      toastrjs(response.data.type, response.data.message)

      $('#mudar-cliente').show();
      $('#card-cliente-select').hide();
      $('#id_comanda').val(response.data.data.id);
      $('#num_comanda').text(response.data.data.id);

      if(response.data.data.id != null)
      {
        $("#escolher_profissional").show();

        // url_barra = window.location.pathname;
        // url_barra = url_barra.replace('/pdv/comandas/iniciarComanda/',"");

        // if( url_barra > 1 )
        // {
        //   console.log('');
        // }
        // else
        // {
        //   window.location.href= "{{ route('pdv.vendas.store') }}/"+response.data.data.id+"";
        // }
      }


    })
    @include('includes.catch', [ 'codigo_erro' => '5449690a' ] )
  }

//     $.ajax(
//     {
//       method    : "GET",
//       success   : function(data)
//       {
//         $('#mudar-cliente').show();
//         $('#card-cliente-select').hide();
//         $('#id_comanda').val(data.data.id);
//         $('#num_comanda').text(data.data.id);

//         if(data.data.id != null)
//         {
//           $("#escolher_profissional").show();
//           $("#produtos-servicos").select2({
//             width: 'resolve'
//           });

//           url_barra = window.location.pathname;
//           url_barra = url_barra.replace('/pdv/comandas/iniciarComanda/',"");

//           if( url_barra > 1 )
//           {
//             console.log('');
//           }
//           else
//           {
//             {{-- window.location.href= "{{ route('comandas.iniciarComanda') }}/"+data.data.id+""; --}}
//           }
//         }

//         {{-- pagar = "{{ route('comandas.pagarComanda', ':id') }}"; --}}
//         pagar = pagar.replace(':id',data.data.id);

//         $('#pagar_comanda').empty();
//         $('#pagar_comanda').append('<a href="'+pagar+'" class="btn btn-default btn-sm" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="Pagar"><i class="glyphicon glyphicon-credit-card"></i></a>');
//       },
//       error     : function(erro)
//       {
//         console.log(erro) 
//       },
//       complete  : function(conclusao)
//       {
//     // console.log(conclusao)
//   },
// })
  // })

  // $('#mudar-cliente').on('click', function()
  // {
  //   $('#card-cliente-select').show();
  //   $('#mudar-cliente').hide();
  //   $("#id_cliente").select2({
  //     width: 'resolve'
  //   });

  // });

  function selecionaProfissional(field) {
    $('#overlay_profissional').show();

    var origem = $(field).attr('data-origem');

    if(origem == 'select') {
      elemento = $('#profissa_'+field.value);

      $(elemento).parent().find('.radio').removeClass('selected');
      $(elemento).addClass('selected');
    } else if(origem == 'imagem') {
      $(field).parent().find('.radio').removeClass('selected');
      $(field).addClass('selected');

      var id_profexec = $(field).attr('data-value');
      $('#id_profexec').val(id_profexec);
    }

    url = "{{ route('pessoa.profExec', ':id') }}";
    url = url.replace(':id', [id_profexec] );

    axios.get(url)
    .then( function(response) {
      // console.log(response)
      $("#produtos-servicos").empty();

      $.each( response.data, function( key, value ) {

        $("#produtos-servicos").append('<tr>'+
          '<td colspan="3"><strong>'+key+'</strong></td>'+
          '</tr>');

        $.each( value, function( chv, prod_serv ) {
          $("#produtos-servicos").append('<tr>'+
            '<td>'+prod_serv.id+'</td>'+
            '<td>'+prod_serv.nome+'</td>'+
            '<td class="text-right">'+prod_serv.vlr_venda+'</td>'+
            '</tr>');
        })
      })
    })
@include('includes.catch', [ 'codigo_erro' => '2516823a' ] )
    .then( function() {
      setTimeout(function() {
        $('#overlay_profissional').hide();
      }, 500);
    })
  }

  // function selecionaServico( field )
  // {
  //   {{-- var url = '{{ route("produtos.infoProdutos", ":id") }}'; --}}
  //   url = url.replace(':id',field.value);

  //   let id_profexec = $('#id_profexec').val();

  //   info_vlr_negociado = info_vlr_venda;

  //   $.ajax(
  //   {
  //     method    : "GET",
  //     url       : url,
  //     dataType  : "json",
  //     timeout   : 100000,
  //     success   : function(data)
  //     {
  //       info_vlr_venda        = parseFloat(data.vlr_venda);

  //       info_vlr_negociado    = info_vlr_venda;

  //       info_prc_comissao     = parseFloat(data.cnf_comissao_servico_m_a_n_y.filter(x => x.id_colaborador == id_profexec)[0].prc_comissao);

  //       switch (desconto_predefinido)
  //       {
  //         case 'VIP':
  //         info_vlr_final        = info_prc_comissao * info_vlr_venda;
  //         info_vlr_dsc_acr      = info_vlr_final - info_vlr_negociado;
  //         break;

  //         default:
  //         info_vlr_dsc_acr      = desconto_predefinido * info_vlr_venda;
  //         info_vlr_final        = info_vlr_negociado + info_vlr_dsc_acr;
  //       }

  //       switch (tipo_comissao)
  //       {
  //         case 'Final':
  //         info_vlr_comissao     = parseFloat(info_prc_comissao) * info_vlr_final;
  //         break;
  //         case 'Tabelado':
  //         info_vlr_comissao     = parseFloat(info_prc_comissao) * info_vlr_venda;
  //         break;
  //         default:
  //         info_vlr_comissao     = parseFloat(info_prc_comissao) * info_vlr_venda;
  //       }

  //       $("#info_vlr_venda").text(parseFloat(info_vlr_venda, 10).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //       $("#info_vlr_negociado").text(parseFloat(info_vlr_negociado, 10).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //       $("#info_vlr_dsc_acr").text(parseFloat(info_vlr_dsc_acr, 10).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //       $("#info_vlr_final").text(parseFloat(info_vlr_final, 10).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //       $("#info_prc_comissao").text(parseFloat(info_prc_comissao * 100, 10).toFixed(1).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString().concat(' %'));
  //       $("#info_vlr_comissao").text(parseFloat(info_vlr_comissao, 10).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //     },
  //     error     : function(defeito)
  //     {
  //       console.log(defeito)
  //     },
  //   });
  // };

  // $(document).on('blur', '[contenteditable]', function(e)
  // {
  //   calcular_valores(e)
  // });

  // function calcular_valores(origem)
  // {
  //   let c_info_vlr_venda      = parseFloat($('#info_vlr_venda')[0].textContent.replace('.', '').replace(',', '.').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString()).toFixed(2);
  //   let c_info_vlr_negociado  = parseFloat($('#info_vlr_negociado')[0].textContent.replace('.', '').replace(',', '.').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString()).toFixed(2);
  //   let c_info_vlr_dsc_acr    = parseFloat($('#info_vlr_dsc_acr')[0].textContent.replace('.', '').replace(',', '.').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString()).toFixed(2);
  //   let c_info_vlr_final      = parseFloat(c_info_vlr_negociado) + parseFloat(c_info_vlr_dsc_acr);
  //   let c_info_prc_comissao   = parseFloat($('#info_prc_comissao')[0].textContent.replace(' ', '').replace('%', '').replace('.', '').replace(',', '.').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
  //   let c_info_vlr_comissao   = parseFloat(c_info_vlr_final) * parseFloat(c_info_prc_comissao) / 100;

  //   $("#info_vlr_venda").text(parseFloat(c_info_vlr_venda).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //   $("#info_vlr_negociado").text(parseFloat(c_info_vlr_negociado).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //   $("#info_vlr_dsc_acr").text(parseFloat(c_info_vlr_dsc_acr).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());
  //   $("#info_vlr_final").text(parseFloat(c_info_vlr_final).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());    

  //   switch (tipo_comissao)
  //   {
  //     case 'Final':
  //     c_info_vlr_comissao = parseFloat(c_info_prc_comissao) * c_info_vlr_final / 100;
  //     break;
  //     case 'Tabelado':
  //     c_info_vlr_comissao = parseFloat(c_info_prc_comissao) * c_info_vlr_venda / 100;
  //     break;
  //     default:
  //     c_info_vlr_comissao = parseFloat(c_info_prc_comissao) * c_info_vlr_venda / 100;
  //   }

  //   $("#info_vlr_comissao").text(parseFloat(c_info_vlr_comissao).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString());    
  // }

  // $("#add_servprod").on('click', function(e)
  // {
  //   e.preventDefault();

  //   var id_comanda        = $("#id_comanda").val();

  //   {{-- url = "{{ route('comandas.gravarItens', ':id') }}"; --}}
  //   url = url.replace(':id',id_comanda);  

  //   var id_comanda            = $("#id_comanda").val();
  //   var id_cliente            = $("#id_cliente").val();
  //   var id_profexec       = $("#id_profexec").val();
  //   var id_servprod          = $("#id_servprod").val();

  //   var vlr_venda             = parseFloat($("#info_vlr_venda")[0].innerText.replace(".","").replace(",","."));
  //   var vlr_venda             = parseFloat($("#info_vlr_venda")[0].innerText.replace(".","").replace(",","."));
  //   var vlr_negociado         = parseFloat($("#info_vlr_negociado")[0].innerText.replace(".","").replace(",","."));
  //   var vlr_dsc_acr           = parseFloat($("#info_vlr_dsc_acr")[0].innerText.replace(".","").replace(",","."));
  //   var vlr_final             = parseFloat($("#info_vlr_final")[0].innerText.replace(".","").replace(",","."));
  //   var prc_comissao          = parseFloat($("#info_prc_comissao")[0].innerText.replace(".","").replace(",",".")) / 100;
  //   var vlr_comissao          = parseFloat($("#info_vlr_comissao")[0].innerText.replace(".","").replace(",","."));

  //   $.ajax({
  //     type: 'get',
  //     url: url,
  //     dataType: 'json',  
  //     data: 
  //     {
  //       id_comanda            : id_comanda,
  //       id_cliente            : id_cliente,
  //       id_profexec       : id_profexec,
  //       id_servprod          : id_servprod,
  //       vlr_venda             : vlr_venda,
  //       vlr_venda             : vlr_venda,
  //       vlr_negociado         : vlr_negociado,
  //       vlr_dsc_acr           : vlr_dsc_acr,
  //       vlr_final             : vlr_final,
  //       prc_comissao          : prc_comissao,
  //       vlr_comissao          : vlr_comissao,
  //     },
  //     success: function(data)
  //     {
  //       mostrarItens()
  //     },
  //     error: function(defeito)
  //     {
  //       console.log(defeito)
  //     },
  //   });
  // });

  // function mostrarItens()
  // {
  //   var id_comanda = $("#id_comanda").val();

  //   if (id_comanda != "")
  //   {
  //     {{-- url = "{{ route('comandas.mostrarItens', ':id') }}"; --}}
  //     url = url.replace(':id',id_comanda);  

  //     $.ajax({
  //       type: 'GET',
  //       url: url,
  //       data: 
  //       {
  //         id_comanda: id_comanda,
  //       },
  //       beforeSend: function()
  //       {
  //         loading = setTimeout('$(".overlay").css("display", "block");', 5000);
  //       },
  //       complete: function()
  //       {
  //         clearTimeout(loading);
  //         $(".overlay").css("display", "none");
  //       },
  //       success: function(data)
  //       {
  //         $('#mostrar-itens').empty().append(data)
  //       },
  //       error: function(defeito)
  //       {
  //         console.log(defeito.responseJSON)
  //         console.log(defeito.responseJSON.message)
  //         console.log("erro");
  //       },
  //     });
  //   };
  // };

  // function apagarItem(item)
  // {
  //   if (confirm('Deseja apagar este item ?'))
  //   {
  //     var id_comanda = $("#id_comanda").val();

  //     {{-- url = "{{ route('comandas.apagarItem', ':id') }}"; --}}
  //     url = url.replace(':id',id_comanda);

  //     $.ajax({
  //       type: 'GET',
  //       url: url,
  //       data: 
  //       {
  //         id            : item,
  //         id_comanda    : id_comanda,
  //       },
  //       success: function(data)
  //       {
  //         mostrarItens();
  //       },
  //       error: function(defeito)
  //       {
  //         console.log(defeito.responseJSON)
  //         console.log(defeito.responseJSON.message)
  //         console.log("erro");
  //       },
  //     });
  //   }
  // }

//   function PDVComandas()
//   {
//   // {{-- pdv_comandas.id_caixa    = {{ $caixa['db']->id }}; --}}
//   // pdv_comandas.id_cliente  = null;

//   document.getElementById("pdv_comandas").value = JSON.stringify(pdv_comandas);
// }

// $("#id_cliente").change(function(event)
// {
//   // pdv_comandas.id_cliente = $("#id_cliente").val();

//   document.getElementById("pdv_comandas").value = JSON.stringify(pdv_comandas);
// });

// function menos( index ) 
// {
//   item = pdv_vendas_detalhes.findIndex(val => val.identificacao == index);

//   if( pdv_vendas_detalhes[item].quantidade > 1 )
//     pdv_vendas_detalhes[item].quantidade = pdv_vendas_detalhes[item].quantidade - 1;

//   document.getElementById('Bqtd_'+index).innerHTML = pdv_vendas_detalhes[item].quantidade;
//   calc_total(index);
// } 

// function mais( index )
// {
//   item = pdv_vendas_detalhes.findIndex(val => val.identificacao == index);

//   pdv_vendas_detalhes[item].quantidade = pdv_vendas_detalhes[item].quantidade + 1;

//   document.getElementById('Bqtd_'+index).innerHTML = pdv_vendas_detalhes[item].quantidade;
//   calc_total(index);
// }

// $('#modal-pessoa-create').on('hidden.bs.modal', function ()
// {
//   location.reload();
// })

</script>
@endpush
