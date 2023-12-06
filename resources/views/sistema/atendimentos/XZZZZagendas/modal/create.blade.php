<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_agendamento_create">
  <form method="POST" action="{{ route('tarefa.store') }}" autocomplete="off" id="form_agendamento_create">
    @csrf
    <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="overlay" id="overlay_create">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="modal-header">
          <h4 class="modal-title">Novo Agendamento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label>Cliente</label>
                <select class="form-control form-control-sm select2" name="id_cliente" id="id_cliente" onchange="escolhiCliente( this.value )">
                  <option value="">Selecione . . .</option>
                  @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nomes }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Serviço</label>
                <select class="form-control form-control-sm select2" name="id_servprod" id="id_servprod" onchange="escolhiServico( this.value )">
                  <option>Selecione . . .</option>
                  @foreach($servicos as $servico)
                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Profissional</label>
                <select class="form-control form-control-sm select2" name="id_profexec" id="id_profexec" onchange="escolhiProfissional( this.value )">
                  <option value="all">Selecione . . .</option>
                  @foreach($profissionais as $profissional)
                    <option value="{{ $profissional->id }}">{{ $profissional->nome }}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label>Início</label>
                <input type="datetime-local" class="form-control form-control-sm" name="start" id="start" value="{{ \Carbon\Carbon::now()->ceilMinutes(60)->format('Y-m-d\TH:i') }}" onchange="ajusteHorario()">
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Duração</label>
                <input type="time" class="form-control form-control-sm" name="duracao" id="duracao" value="{{ \Carbon\Carbon::parse('01:00')->format('H:i') }}" onchange="ajusteHorario()">
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Final</label>
                <input type="datetime-local" class="form-control form-control-sm" name="end" id="end" value="{{ \Carbon\Carbon::now()->ceilMinutes(120)->format('Y-m-d\TH:i') }}" readonly="readonly">
              </div>
            </div>

          </div>
          <hr>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label>Valor</label>
                <input type="text" class="form-control form-control-sm text-right" name="valor" id="valor" placeholder="0,00" value="0" onchange="escolhiValor( this.value )">
              </div>
            </div>

            <div class="col-8">
              <div class="form-group">
                <label>Observação</label>
                <input type="text" class="form-control form-control-sm" name="obs" id="obs" onkeyup="escolhiObs( this.value )">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-default btn-sm" data-dismiss="modal" id='cancel_agendamento_create'>Cancel</a>
          <a class="btn btn-default btn-sm disabled" data-bs-toggle="modal" id="btn_modal_sobreOCliente" href="#modal_sobreOCliente"><i class="fas fa-fw fa-address-card"></i></a>
          <a class="btn btn-primary btn-sm disabled" id='submit_agendamento_create'>Agendar</a>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
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
      dropdownParent: $('#modal_agendamento_create'),
    });

    $('#overlay_create').hide();
    // ajusteHorario()
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
    id_criador       : {{ Auth::User()->id }},
    obs              : null,
    color            : null,
    status           : 'Agendado',
    id_venda_detalhe : null,
    prc_comissao     : null,
    vlr_comissao     : null,
    m_start          : null,
    m_end            : null,
    valor          : null,
    m_duracao        : null,
  }

  // load_clientes()
});


// function load_clientes()
// {
//   axios.get("{{ route('atd.pessoas.carregar') }}")
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
{{-- @include('includes.catch', [ 'codigo_erro' => '8248581a' ] ) --}}

function escolhiServico( id_servprod )
{
  // procurar dados do servico escolhido
  atd_agendamento.id_servprod = id_servprod;

  $('#overlay_create').show();
  url_servico = "{{ route('cat.servicos.encontrar', ':id') }}";
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
@include('includes.catch', [ 'codigo_erro' => '2621946a' ] )

  // procurar profissionais do servico escolhido
  url_profiss = "{{ route('pessoa.profExec', ':id') }}";
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
@include('includes.catch', [ 'codigo_erro' => '3338861a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 1000);
  })
}

function escolhiProfissional( id_profexec )
{
  // pesquisa servicos que o profissional faz
  atd_agendamento.id_profexec = id_profexec;
  
  $('#overlay_create').show();

  url_servs = "{{ route('agenda.profissionalProduto', ':id') }}";
  url_servs = url_servs.replace(':id', id_profexec );
  
  axios.get(url_servs)
  .then( function(response)
  {
    // console.log(response.data)
    if (id_profexec != 'all')
    {
      $("#id_servprod").empty().append('<option value="">Selecione . . .</option>');
      $.each( response.data, function( key, value )
      {
        if (value.id_servprod == atd_agendamento.id_servprod)
        {
          $("#id_servprod").append('<option value="'+value.id_servprod+'" selected>'+value.nome+'</option>');
        }
        else
        {
          $("#id_servprod").append('<option value="'+value.id_servprod+'">'+value.nome+'</option>');
        }
      });
    }
    else
    {
      $("#id_servprod").empty().append('<option value="">Selecione . . .</option>');
      $.each( response.data, function( key, value )
      {
        if (value.id == atd_agendamento.id_servprod)
        {
          $("#id_servprod").append('<option value="'+value.id+'" selected>'+value.nome+'</option>');
        }
        else
        {
          $("#id_servprod").append('<option value="'+value.id+'">'+value.nome+'</option>');
        }
      });
    }
  })
@include('includes.catch', [ 'codigo_erro' => '4561714a' ] )
  .then( function()
  {
    preencherModal()
  })
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_create').hide();
    }, 1000);
  })
}

function escolhiCliente( id_cliente )
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
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);

    objCalendar.refetchEvents();
  })
@include('includes.catch', [ 'codigo_erro' => '9406107a' ] )
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
  {{-- //   url       : "{{ route('atd.agendamentos.gravar') }}", --}}
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
  //       // var el = $(document).find('[name="'+i+'"]');
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
  url = "{{ route('pessoa.find', ':id') }}";
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
    dados_do_cliente.tipos       = response.data.dsnewksmasknasj;
    dados_do_cliente.vendas      = response.data.eidwuedoeduzdsd;
  })
@include('includes.catch', [ 'codigo_erro' => '2877251a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '8906956a' ] )
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
@endpush
