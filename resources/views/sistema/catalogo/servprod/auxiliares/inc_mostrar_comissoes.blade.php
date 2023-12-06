<div class="row">
  @can('Serviços.Editar')
    <div id="usuarios_acesso_sistema"></div>
    <br><br>
  @else
  {{--
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col">
        @foreach($pessoas->groupBy('categoria') as $categoria => $pessoa)
          <br><strong>{{ $categoria }}</strong><br>
          @foreach($pessoa as $pessoa_produto)
            <i class="fa-xs fa-solid fa-circle"
            @if($servprod->aistggwbdgrrher->contains('id_pessoa', $pessoa_produto->id))
              style="color:green;"
            @else
              style="color:red;"
            @endif
            ></i>
            &nbsp;
            <label>
              <span class="small">{{ $pessoa_produto->id ?? 'pessoa_produto->id' }} - </span>&nbsp;{{ $pessoa_produto->nome ?? 'pessoa_produto->nome' }}<span class="small"> ({{ $pessoa_produto->descricao ?? 'pessoa_produto->descricao' }})</span>
            </label>
            <br>
          @endforeach
        @endforeach
        <br><br>
      </div>
    </div>
    --}}
  @endcan
</div>


@push('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
    comissoes_pessoas_sistema()
  });
  
  function comissoes_pessoas_sistema()
  {
    var url  = "{{ route('atd.pessoas.sistema') }}";
    
    axios.get(url)
    .then( function(response)
    {
      // console.log(response.data)

      $('#usuarios_acesso_sistema').empty();
      collect(response.data).each((value, key) =>
      {
        console.log(value)
        // tem comissão desse produto?
        tcdp = collect(value.aeahvtsijjoprlc).filter((comissao, key) => comissao.id_servprod == {{ $servprod->id }}).count() > 0
        valor_percentual = tcdp ? collect(value.aeahvtsijjoprlc).filter((comissao, key) => comissao.id_servprod == {{ $servprod->id }}).items[0].prc_comissao * 100 : {{ $servprod->prc_comissao ?? 0 }}
        
        $('#usuarios_acesso_sistema').append(
          '<div class="row invoice-info">'+
            '<div class="col-sm-3 invoice-col">'+
              '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">'+
                '<input type="checkbox" class="custom-control-input" id="'+value.id+'" onchange="liberar_input_comissao(this)" '+(tcdp ? 'checked' : '')+'>'+ 
                '<label class="custom-control-label" for="'+value.id+'">&nbsp;'+value.apelido+'<span class="small"> ('+value.id+')</span></label>'+
              '</div>'+
            '</div>'+
            
            '<div class="col-sm-2">'+
              '<div class="form-group">'+
                '<input '+
                  'type="number" '+
                  'class="form-control form-control-sm text-right" '+
                  'id="input_comissao_'+value.id+'" '+
                  'value="'+valor_percentual+'" '+
                  'step="1" '+
                  'min="0" '+
                  'max="100" '+
                  'onchange="comissoes_pessoas_editar('+value.id+', \'on\')" '+
                  (tcdp ? "" : "disabled")+'>'+
              '</div>'+
            '</div>'+
            '<div class="col-sm-1 text-left">%</div>'+
          '</div>'+
          '</br>');
      });
    })
    @include('includes.catch', [ 'codigo_erro' => '6790642a' ] )
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
      id_profexec  : pessoa,
      id_servprod  : {{ $servprod->id }},
      prc_comissao : $('#input_comissao_'+pessoa+'').val(),
      status       : status
    }])
    .then( function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '4611289a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endpush
