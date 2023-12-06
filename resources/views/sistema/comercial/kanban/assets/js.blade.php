<script type="text/javascript">
  $(document).ready( function()
  {
    lead_fichas();
  });

  function lead_fichas(page)
  {
    $('#overlay-pessoas').show();

    var url = "{{ route('com.leads.ficha', ':page') }}";
    var url = url.replace(':page', 'page='+page);

    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $("#entrada_lead").empty();
      $("#apresentacao_curso").empty();
      $("#proposta_enviada").empty();
      $("#negociando_venda").empty();
      $("#cancelado").empty();
      collect(response.data).sortBy('updated_at').sortByDesc('favorito').groupBy('status').each((status) =>
      {
        // console.log(status)
        collect(status).each((item) =>
        {
          // console.log(item)
          switch (item.status)
          {
            case 'entrada_lead':
            $("#entrada_lead").append(ficha(item))
            break;
            case 'apresentacao_curso':
            $("#apresentacao_curso").append(ficha(item))
            break;
            case 'proposta_enviada':
            $("#proposta_enviada").append(ficha(item))
            break;
            case 'negociando_venda':
            $("#negociando_venda").append(ficha(item))
            break;
          }
        })
      })

      // $('#tabela-pessoas').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '1307860a' ] )
    .then( function(response)
    {
      $('#overlay-pessoas').hide();
    })
  }

  function ficha( item )
  {
    // curso = (item.id_turma == null ? 'NAO TEM' : item.rtyyvaqazxgdssf.cbntdakklaoyfih.nome);
    // turma = (item.id_turma == null ? 'NAO TEM' : item.rtyyvaqazxgdssf.sigla);
    x = moment().diff(item.updated_at, 'days');
    switch ( true )
    {
      case ( x < 3 ):
        var color = 'black';
        break;
      case ( x <= 5 ):
        var color = 'orange';
        break;
      case ( x > 10 ):
        var color = 'red';
        break;
      default:
        var color = 'blue';
        break;
    }

    var ficha =
    '<div class="callout p-2" style="'+item.color_interesse+'">'+
      '<div class="d-flex bd-highlight">'+
        '<span class="w-100">'+
          '<a class="bd-highlight" style="cursor: pointer;" onClick="lead_favoritar('+item.id+','+item.favorito+')">'+
            '<i class="fa-solid fa-star" style="color: '+(item.favorito ? 'gold' : 'lightgoldenrodyellow')+';"></i>'+
          '</a>&nbsp;'+
          '<a class="bd-highlight" style="cursor: pointer;" onClick="lead_modal('+item.id+')">'+
            '<strong>'+item.nome+'</strong>'+
          '</a>'+
          '</span>'+
            '<span class="flex-shrink-1 bd-highlight collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_'+item.id+'" aria-expanded="false" aria-controls="collapse_'+item.id+'">'+
              '<i class="fa-solid fa-caret-down"></i>'+
              '<i class="fa-solid fa-caret-up"></i>'+
            '</span>&nbsp;&nbsp;'+
          '</div>'+
          '<div>'+
            '<p class="p-0 m-0">'+
              '<span>'+item.telefone+'</span>&nbsp;&nbsp;'+
              '<a '+
                'href="'+item.link_whatsapp+'"'+
                'target="_blank"'+
                'data-tt="tooltip"'+
                'data-bs-original-title="Whatsapp"'+
                'aria-label="Whatsapp"'+
                '>'+
                '<i class="fa-brands fa-whatsapp"></i>'+
              '</a>'+
              '<span" class="float-end" style="color: '+color+';">'+moment().diff(item.updated_at, 'days')+' dia'+(moment().diff(item.updated_at, 'days') != 1 ? 's' : '')+'</span>'+
            '</p>'+
          '</div>'+

          '<div id="collapse_'+item.id+'" class="collapse" data-bs-parent="#accordion" style="border-top: 1px solid lightgray">'+
            '<div class="card-body" style="padding: 10px 5px;">'+
              '<small><strong>Nome:</strong> '+item.nome+'</small></br>'+
            //   '<small><strong>Cursos:</strong> '+curso+'</small></br>'+
            //   '<small><strong>Turma:</strong> '+turma+'</small></br></br>'+
              '<small><strong>Último Contato:</strong> '+moment(item.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h </small></br></br>'+
              '<small><strong>Convesas:</strong></small></br>'+
              '<small>';

              collect(item.fghtvxswwryiiil).sortByDesc('created_at').each((conversa) =>
              {
                // console.log(conversa)
                ficha = ficha +
                '<li>'+
                  conversa.conversa+
                '</li>';
              })

              ficha = ficha +
            '</small></br>'+
          '<small><strong>Data de Cadastro:</strong> '+moment(item.created_at).format('DD/MM/YYYY [às] HH:mm')+'h </small></br>'+
        '</div>'+
      '</div>'+
    '</div>';

    return ficha;
  }

  function lead_excluir(id)
  {
    $('#overlay-pessoas').show();

    var url = "{{ route('atd.pessoas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '9786030a' ] )
    .then( function(response)
    {
      lead_fichas()
    })
    .then( function(response)
    {
      $('#overlay-pessoas').hide();
    })
  }

  function lead_restaurar(id)
  {
    $('#overlay-pessoas').show();

    var url = "{{ route('atd.pessoas.restaurar', ':id') }}";
    var url = url.replace(':id', id);

    axios.post(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '7351975a' ] )
    .then( function(response)
    {
      lead_fichas()
    })
    .then( function(response)
    {
      $('#overlay-pessoas').hide();
    })
  }

  function lead_favoritar( id, status )
  {
    $('#overlay_lead').show()

    var dados = {
        favorito : status,
    }

    var url  = "{{ route('com.leads.atualizar', ':idd') }}"
    var url  = url.replace(':idd', id)

    axios.put(url, dados)
    .then( function(response)
    {
      console.log(response)
    })
    @include('includes.catch', [ 'codigo_erro' => '7945518a' ] )
    .then( function()
    {
      lead_fichas()
      setTimeout(() => {
        $('#overlay_lead').hide()
      }, 500 )
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
