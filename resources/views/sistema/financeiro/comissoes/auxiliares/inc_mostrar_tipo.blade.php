<div class="row">
  @can('Funções.Editar')
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col">
        {{--
          @foreach($tipos->groupBy('categoria') as $categoria => $tipos)
          <br><strong>{{ $categoria }}</strong><br>
          @foreach($tipos as $tipo_pessoa)
          @include('sistema.atendimentos.pessoas.auxiliares.inc_editar_color_checkbox', [ 'pessoa_tipos' => $pessoa->aistggwbdgrrher ?? '$tipo_pessoa', 'tipo_id' => $tipo_pessoa->id ?? 'tipo_id', 'tipo_nome' => $tipo_pessoa->nome, 'tipo_descricao' => $tipo_pessoa->descricao ])
          @endforeach
          @endforeach
        --}}
        <br><br>
      </div>
    </div>
  @else
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col">
        {{--
          @foreach($tipos->groupBy('categoria') as $categoria => $tipos)
          <br><strong>{{ $categoria }}</strong><br>
          @foreach($tipos as $tipo_pessoa)
          <i class="fa-xs fa-solid fa-circle"
          @if($pessoa->aistggwbdgrrher->contains('id_tipo', $tipo_pessoa->id))
          style="color:green;"
          @else
          style="color:red;"
            @endif
            ></i>
            &nbsp;
            <label>
              <span class="small">{{ $tipo_pessoa->id ?? 'tipo_pessoa->id' }} - </span>&nbsp;{{ $tipo_pessoa->nome ?? 'tipo_pessoa->nome' }}<span class="small"> ({{ $tipo_pessoa->descricao ?? 'tipo_pessoa->descricao' }})</span>
            </label>
            <br>
            @endforeach
            @endforeach
            --}}
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
    {{--
      var url  = "{{ route('atd.pessoas.atualizar', $pessoa->id) }}";
      --}}

    axios.put(url, [{
      [item.name]: item.value,
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '8069672a' ] )
  }

  function pessoas_tipos_verificar(item)
  {
    let tipo = item.id;

    $(item).attr( 'checked', true )
    if ($(item).is(':checked'))
    {
      $(item).attr( 'checked', true )
      pessoas_tipos_adicionar(tipo, 'on')
    }
    else
    {
      $(item).attr( 'checked', false )
      pessoas_tipos_adicionar(tipo, 'off')
    }
  }

  function pessoas_tipos_adicionar(tipo, status)
  {
    {{--
      var url = "{{ route('atd.pessoas.tipos', $pessoa->id) }}";
      --}}

    axios.post(url, [{
      tipo   : tipo,
      status : status
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '3323043a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
