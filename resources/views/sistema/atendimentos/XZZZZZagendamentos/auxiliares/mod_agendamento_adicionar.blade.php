<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="overlay" id="overlay_create">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="modal-header">
      <h4 class="modal-title">Novo Agendamento</h4>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label>Cliente</label>
            <select class="form-control form-control-sm select2" id="id_cliente">
              <option>Carregando . . .</option>
            </select>
          </div>
        </div>

        @if(is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
          <input type="hidden" id="id_profexec" value="{{ \Auth::User()->id }}">
        @else
          <div class="col-12">
            <div class="form-group">
              <label>Profissional</label>
              <select class="form-control form-control-sm" id="id_profexec" onchange="parceiros_selecionado( this.value )">
                <option>Carregando . . .</option>
              </select>
            </div>
          </div>
        @endif

        @can('gerente')
        <div class="col-12">
          <div class="form-group">
            <label>Serviço</label>
            <select class="form-control form-control-sm select2" id="id_servprod" onchange="servicos_selecionado( this.value )">
              <option>Carregando . . .</option>
            </select>
          </div>
        </div>
        @endcan
      </div>

      <div class="row">
        <div class="col-4">
          <div class="form-group">
            <label>Início</label>
            <input type="datetime-local" class="form-control form-control-sm" id="start" value="{{ \Carbon\Carbon::now()->ceilMinutes(60)->format('Y-m-d\TH:i') }}" onchange="ajusteHorario()">
          </div>
        </div>

        <div class="col-4">
          <div class="form-group">
            <label>Duração</label>
            <input type="time" class="form-control form-control-sm" id="duracao" value="{{ \Carbon\Carbon::parse('01:00')->format('H:i') }}" onchange="ajusteHorario()">
          </div>
        </div>

        <div class="col-4">
          <div class="form-group">
            <label>Final</label>
            <input type="datetime-local" class="form-control form-control-sm" id="end" value="{{ \Carbon\Carbon::now()->ceilMinutes(120)->format('Y-m-d\TH:i') }}" readonly="readonly">
          </div>
        </div>

      </div>
      <hr>
      <div class="row">
        <div class="col-4">
          <div class="form-group">
            <label>Valor</label>
            <input type="text" class="form-control form-control-sm text-right" id="valor" placeholder="0,00" value="0" onchange="escolhiValor( this.value )">
          </div>
        </div>

        <div class="col-8">
          <div class="form-group">
            <label>Observação</label>
            <input type="text" class="form-control form-control-sm" id="obs" onkeyup="escolhiObs( this.value )">
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a class="btn btn-default btn-sm" data-bs-dismiss="modal" id='cancel_agendamento_create'>Cancel</a>
      <a class="btn btn-default btn-sm disabled" data-bs-toggle="modal" id="btn_modal_sobreOCliente" href="#modal_sobreOCliente"><i class="fas fa-fw fa-address-card"></i></a>
      <a class="btn btn-primary btn-sm disabled" id='submit_agendamento_create'>Agendar</a>
    </div>
  </div>
</div>

<script type="text/javascript">
//
$(document).ready(function()
{
  // $("#valor").inputmask('decimal', {
  //   'alias': 'numeric',
  //   'groupSeparator': '.',
  //   'autoGroup': true,
  //   'digits': 2,
  //   'radixPoint': ",",
  //   'digitsOptional': false,
  //   'allowMinus': false,
  //   'placeholder': '0,00',
  // });

  $(window).on('shown.bs.modal', function()
  {
    $('.select2').select2({
      dropdownParent: $('#modal-geral-1'),
    });

    $('#overlay_create').hide();
  });

  pessoas = [];
  
  dados_do_cliente = {};

  atd_agendamento = {
    start            : null,
    end              : null,
    id_cliente       : null,
    id_profexec  : null,
    id_servprod       : null,
    id_comanda       : null,
    valor            : null,
    id_criador       : "{{ Auth::User()->id }}",
    obs              : null,
    color            : null,
    status           : 'Agendado',
    id_venda_detalhe : null,
    prc_comissao     : null,
    vlr_comissao     : null,
    m_start          : null,
    m_end            : null,
    valor            : null,
    m_duracao        : null,
  }
  clientes_carregar()
  parceiros_carregar()
});

function clientes_carregar()
{
  $('#overlay_create').show();
    
  axios.get("{{ route('atd.pessoas.plucar') }}")
  .then(function(response)
  {
    // console.log(response.data)
    $("#id_cliente").empty().append('<option>Selecione . . .</option>');
    $.each( response.data, function( value, key )
    {
      $("#id_cliente").append('<option value="'+key+'">'+value+' ( '+key+' )</option>');
    })
  })
@include('includes.catch', [ 'codigo_erro' => '6363585a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 500);
  })
}

function parceiros_carregar()
{
  $('#overlay_create').show();
    
  axios.get("{{ route('atd.parceiros.pluck') }}")
  .then(function(response)
  {
    // console.log(response.data)
    $("#id_profexec").empty().append('<option>Selecione . . .</option>');
    $.each( response.data, function( value, key )
    {
      $("#id_profexec").append('<option value="'+key+'">'+value+' ( '+key+' )</option>');
    })
  })
@include('includes.catch', [ 'codigo_erro' => '3416971a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
      $("#id_profexec").val("{{ $id_parceiro }}");
    }, 500);
  })
}

function parceiros_selecionado( id_profexec )
{
  $('#overlay_create').show();

  url = "{{ route('atd.parceiros.servicos', ':id') }}";
  url = url.replace(':id', id_profexec );
  
  axios.get(url)
  .then( function(response)
  {
    // console.log(response.data)
    $("#id_servprod").empty().append('<option>Selecione . . .</option>');
    $.each( response.data, function( value, key )
    {
      $("#id_servprod").append('<option value="'+key+'">'+value+'</option>');
    })
  })
@include('includes.catch', [ 'codigo_erro' => '1743320a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 500);
  })
}

function servicos_selecionado( id_servprod )
{
  $('#overlay_create').show();

  url = "{{ route('cat.servprod.buscar', ':id') }}";
  url = url.replace(':id', id_servprod );
  
  axios.get(url)
  .then( function(response)
  {
    // console.log(response.data)
    $("#valor").val(response.data.vlr_venda)
    $("#duracao").val(response.data.duracao)
  })
@include('includes.catch', [ 'codigo_erro' => '9849890a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 500);
  })
  .then( function()
  {
    $('#overlay_create').hide();
  })  
}

// function load_clientes()
// {
{{-- 
  //   axios.get("{{ route('pessoa.load') }}")
  --}}
//   .then(function(response)
//   {
//     (response.data).forEach((obj, i) => {
//       people =
//       {
//         id: obj.id,
//         text: obj.nomes,
//       }

//       pessoas.push(people);

//       $('#id_pessoa').select2({
//         data: pessoas,
//       });
//     });
//   })
{{-- @include('includes.catch', [ 'codigo_erro' => '4895938a' ] ) --}}

function servicos_escolhido( id_servprod )
{
  // procurar dados do servico escolhido
  atd_agendamento.id_servprod = id_servprod;

  $('#overlay_create').show();
  {{-- 
    url_servico = "{{ route('servico.find', ':id') }}";
    --}}
  url_servico = url_servico.replace(':id', id_servprod );

  axios.get(url_servico)
  .then( function(response)
  {
    // console.log(response.data)
    atd_agendamento.id_servprod       = id_servprod;
    atd_agendamento.valor            = response.data.vlr_venda;
    atd_agendamento.m_duracao        = response.data.duracao;
  })
  .then( function()
  {
    preencherModal()
  })
  .then( function()
  {
    ajusteHorario()
  })
@include('includes.catch', [ 'codigo_erro' => '8921619a' ] )

  // procurar profissionais do servico escolhido
  {{-- 
    url_profiss = "{{ route('pessoa.profExec', ':id') }}";
    --}}
  url_profiss = url_profiss.replace(':id', id_servprod );

  axios.get(url_profiss)
  .then( function(response)
  {
    // console.log(response.data)
    $("#id_profexec").empty().append('<option value="all">Selecione . . .</option>');
    $.each( response.data, function( key, value )
    {
      if (value.id == atd_agendamento.id_profexec)
      {
        $("#id_profexec").append('<option value="'+value.id+'" selected>'+value.apelido+'</option>');
      }
      else
      {
        $("#id_profexec").append('<option value="'+value.id+'">'+value.apelido+'</option>');
      }
    });
  })
@include('includes.catch', [ 'codigo_erro' => '6886233a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 1000);
  })
}

function clientes_escolhido( id_cliente )
{
  console.log(id_cliente)
  if (id_cliente != '')
  {
    atd_agendamento.id_cliente  = id_cliente;
    dados_do_cliente.id_cliente = id_cliente;
    procurar_dados_Cliente()
    $('#btn_modal_sobreOCliente').removeClass('disabled')
  }
  else
  {
    atd_agendamento.id_cliente  = null;
    dados_do_cliente.id_cliente = null;
    $('#btn_modal_sobreOCliente').addClass('disabled')
  }
}

function escolhiValor( valor )
{
  atd_agendamento.valor = valor;

  let novo_valor = $("#valor").val().replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
  atd_agendamento.valor = novo_valor;
}

function escolhiObs( obs )
{
  atd_agendamento.obs = obs;
}

function submitar()
{
  $('#overlay_create').show();

  axios.post("{{ route('atd.agendamentos.gravar') }}", atd_agendamento)
  axios.post(url, atd_agendamento)
  .then(function(response)
  {
    console.log(response)
    toastrjs(response.data.type, response.data.message);

    objCalendar.refetchEvents();
  })
@include('includes.catch', [ 'codigo_erro' => '4971118a' ] )
  .then(function ()
  {
    $("#cancel_agendamento_create").click();
  })
  .then(function ()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 1000);
  })

}

$("#submit_agendamento_create").on('click', function (e)
{

  e.preventDefault();

  submitar()
  // let dados = $('#form_agendamento_create').serialize();

  // // atd_pessoas.splice(0, 1, pessoa);

  // // foto_perfil = $("#profile-picture").src();
  // // console.log(foto_perfil)
  // $.ajax({
  {{-- 
    //   url       : "{{ route('atd.agendamentos.gravar') }}", 
    --}}
  //   method    : "POST", 
  //   data      : dados,
  //   success   : function(response)
  //   {
  //     // console.log(response)
  //     // window.location.href = response.redirect;
  //   },
  //   error     : function(reject)
  //   {        
  //     // console.log(reject)
  //     // $.each(reject.responseJSON.errors, function (i, error)
  //     // {
  //       // var el = $(document).find(''"]');
  //       // el.addClass('is-invalid');
  //     // });

  //     // console.log(reject)
  //     // console.log(reject.responseJSON)
  //   },
  //   complete  : function(complete)
  //   {
  //     // console.log(complete)
  //     $("#cancel_agendamento_create").click();
  //     // toastrjs(complete.responseJSON.type, complete.responseJSON.message);
  //     // window.location.href = complete.responseJSON.redirect;
  //   },
  // });
});

$('#form_agendamento_create').keypress(function()
{
  if( atd_agendamento.start != null && atd_agendamento.end != null && atd_agendamento.id_cliente != null && atd_agendamento.id_profexec != 'all'  && atd_agendamento.id_profexec != null && atd_agendamento.id_servprod != null && atd_agendamento.valor != null && atd_agendamento.id_criador != null && atd_agendamento.obs != null && atd_agendamento.status != null && atd_agendamento.m_start != null && atd_agendamento.m_end != null && atd_agendamento.valor != null && atd_agendamento.m_duracao != null )
  {
    $("#submit_agendamento_create").removeClass('disabled');
  }
  else
  {
    $("#submit_agendamento_create").addClass('disabled');
  }
});


function preencherModal()
{
  $("#duracao").val(atd_agendamento.m_duracao);
  $('#id_servprod').val(atd_agendamento.id_servprod);
  $('#id_profexec').val(atd_agendamento.id_profexec);
  $("#duracao").val(atd_agendamento.m_duracao);
  $("#valor").val(Number(atd_agendamento.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
  ajusteHorario()
}

function ajusteHorario()
{
  atd_agendamento.m_start = moment($(start).val(), "YYYY-MM-DDTHH:mm");
  atd_agendamento.duracao = moment($(duracao).val(), "HH:mm:ss")
  
  atd_agendamento.m_end = (atd_agendamento.m_start).add((atd_agendamento.duracao).format("HH"), 'hours').add((atd_agendamento.duracao).format("mm"), 'minutes');

  $(end).val(moment(atd_agendamento.m_end).format('YYYY-MM-DDTHH:mm:ss'));
  atd_agendamento.start = moment($(start).val()).format("YYYY-MM-DD HH:mm:ss");
  atd_agendamento.end   = moment($(end).val()).format("YYYY-MM-DD HH:mm:ss");
}

function procurar_dados_Cliente()
{
  {{-- 
    url = "{{ route('pessoa.find', ':id') }}";
    --}}
  url = url.replace(':id', [atd_agendamento.id_cliente] );

  axios.post(url)
  .then( function(response)
  {
    // console.log(response)
    dados_do_cliente.id          = response.data.id;
    dados_do_cliente.nome        = response.data.nome;
    dados_do_cliente.apelido     = response.data.apelido;
    dados_do_cliente.cpf         = response.data.cpf;
    dados_do_cliente.instagram   = response.data.instagram;
    dados_do_cliente.foto_perfil = response.data.foto_perfil;
    dados_do_cliente.saldo       = response.data.saldo;
    dados_do_cliente.observacao  = response.data.observacao;
    dados_do_cliente.tipos       = response.data.a_t_d__pessoas__tipos;
    dados_do_cliente.vendas      = response.data.eidwuedoeduzdsd;
  })
@include('includes.catch', [ 'codigo_erro' => '5701134a' ] )
  .then( function()
  {
    $('#btn_modal_sobreOCliente').show();   
    preencher_modal_Cliente();
  })
}

function preencher_modal_Cliente()
{
  // LEVAR IMAGEM ATUALIZADA DO INSTAGRAM PARA MODAL SOBRE O CLIENTE
  if (dados_do_cliente.instagram != null)
  {
    axios.get('https://www.instagram.com/'+dados_do_cliente.instagram+'?__a=1')
    .then(function(response)
    {
      console.log(response)
      $('#m1_picture').attr('src', response.data.graphql.user.profile_pic_url);                                                                         // corrigir essa parte depois
    })
@include('includes.catch', [ 'codigo_erro' => '2934250a' ] )
  }
  else
  { // CASO DE ERRO, COLOCA A IMAGEM DO INSTITUTO EMBELLEZE
    $('#m1_picture').attr('src', $('#widget-user-picture').attr('src'));
  }

  // PREENCHER INFORMACOES DO MODAL SOBRE O CLIENTE
  $('#m1_id').val(dados_do_cliente.id);
  $('#m1_nome').val(dados_do_cliente.nome);
  $('#m1_apelido').val(dados_do_cliente.apelido);
  $('#m1_cpf').val(dados_do_cliente.cpf);
  $('#m1_instagram').val(dados_do_cliente.instagram);
  $('#m1_observacao').val(dados_do_cliente.observacao);

  // PREENCHER O CAMPO VENDAS ATENRIRES
  if ((dados_do_cliente.vendas).length > 0)
  {
    $('#m1_vendas').empty();
    $.each( dados_do_cliente.vendas, function( key, value )
    {
      let x = document.URL;
      let asset = 'http://127.0.0.1:8000/PDV/venda/'+value.id_venda;

      $('#m1_vendas').append('<tr>'+
        '<td class="text-center"><a class="badge bg-pink" target="_blank" href="'+asset+'">'+value.id_venda+'</a></td>'+
        '<td class="text-center">'+moment(value.created_at).format('DD/MM/YYYY HH:mm:ss')+'</td>'+
        '<td class="text-center">'+value.p_d_v_servico_produtos_vendas_detalhes.nome+'</td>'+
        '<td class="text-center">'+value.profissional_que_fez_esse_servico.apelido+'</td>'+
        '<td class="text-right">'+Number(value.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</td>'+
        '</tr>');
    });
  }
  else
  {
    $('#m1_vendas').empty().append('<tr><td colspan="5" class="text-center">Não há vendas registradas para essa pessoa.</td></tr>');
  }

  preencher_TipoCliente();
}

function preencher_TipoCliente()
{
  // PREENCHER O CAMPO TIPO
  if ( (dados_do_cliente.tipos).length > 0 )
  {
    $('#m1_tipos').empty();
    $.each( dados_do_cliente.tipos, function( key, value )
    {
      $('#m1_tipos').append('<tr>'+
        '<td class="text-center">'+value.nome+'</td>'+
        '</tr>');
    });
  }
  else
  {
    $('#m1_tipos').empty().append('<tr><td colspan="2" class="text-center">Nenhum Tipo</td></tr>');
  }
}

</script>
