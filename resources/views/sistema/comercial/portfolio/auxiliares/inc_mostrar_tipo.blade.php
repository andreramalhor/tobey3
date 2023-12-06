<div class="row">
  @can('Funções.Editar')
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col">
        @foreach($funcoes->groupBy('categoria') as $categoria => $funcao)
          <br><strong>{{ $categoria }}</strong><br>
          @foreach($funcao as $funcao_pessoa)
            @include('sistema.atendimentos.pessoas.auxiliares.inc_editar_color_checkbox', [ 'pessoa_funcoes' => $pessoa->aistggwbdgrrher ?? 'funcao_pessoa', 'funcao_id' => $funcao_pessoa->id ?? 'funcao_id', 'funcao_nome' => $funcao_pessoa->nome, 'funcao_descricao' => $funcao_pessoa->descricao ])
          @endforeach
        @endforeach
        <br><br>
      </div>
    </div>
  @else
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col">
        @foreach($funcoes->groupBy('categoria') as $categoria => $funcao)
          <br><strong>{{ $categoria }}</strong><br>
          @foreach($funcao as $funcao_pessoa)
            <i class="fa-xs fa-solid fa-circle"
            @if($pessoa->aistggwbdgrrher->contains('id_funcao', $funcao_pessoa->id))
              style="color:green;"
            @else
              style="color:red;"
            @endif
            ></i>
            &nbsp;
            <label>
              <span class="small">{{ $funcao_pessoa->id ?? 'funcao_pessoa->id' }} - </span>&nbsp;{{ $funcao_pessoa->nome ?? 'funcao_pessoa->nome' }}<span class="small"> ({{ $funcao_pessoa->descricao ?? 'funcao_pessoa->descricao' }})</span>
            </label>
            <br>
          @endforeach
        @endforeach
        <br><br>
      </div>
    </div>
  @endcan
</div>


@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
  });

  function pessoas_editar(item)
  {    
    var url  = "{{ route('atd.pessoas.atualizar', $pessoa->id) }}";

    axios.put(url, [{
      [item.name]: item.value,
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '3144907a' ] )
  }

  function pessoas_funcoes_verificar(item)
  {
    let funcao = item.id;

    $(item).attr( 'checked', true )
    if ($(item).is(':checked'))
    {
      $(item).attr( 'checked', true )
      pessoas_funcoes_adicionar(funcao, 'on')
    }
    else
    {
      $(item).attr( 'checked', false )
      pessoas_funcoes_adicionar(funcao, 'off')
    }
  }

  function pessoas_funcoes_adicionar(funcao, status)
  {
    var url = "{{ route('atd.pessoas.funcoes', $pessoa->id) }}";

    axios.post(url, [{
      funcao : funcao,
      status : status
    }])
    .then( function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '5970786a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
