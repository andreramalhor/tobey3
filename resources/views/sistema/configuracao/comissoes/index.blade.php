@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista Geral de Comissões</h3>

        <div class="card-tools">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('comissao.create') }}" ><i class="fas fa-plus"></i></a>
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
          </div>
        </div>
        @include('sistema.financeiro.lancamentos.modal.pesquisa')
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-bordered table-hover table-head-fixed text-nowrap no-padding" id="comissao-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Tipo</th>
              <th class="text-left">Categoria > Serviço</th>
              @foreach($pessoas->sortBy('id') as $pessoa)
                <th class="text-center">{{ $pessoa->apelido }}</th>
                {{-- <th class="text-center"><img src="{{ $pessoa->foto_perfil }}" class="img-circle" alt="User Image" width="30px" style="margin: 5px;" data-origem="imagem" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="{{ $pessoa->apelido }} ({{ $pessoa->id }})"></th> --}}
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach($catalogo as $tipo => $prod_serv)
              <tr>
                <td class="text-left" colspan="{{ count($pessoas) + 3 }}" style="background-color: darkgray;">{{ $tipo }}</td>
              </tr>
              @foreach($prod_serv->groupBy('QualCategoriaDisso.nome') as $categoria => $cadas)
                <tr>
                  <td class="text-left" colspan="{{ count($pessoas) + 3 }}" style="background-color: lightgray;">{{ $categoria }}</td>
                </tr>
                @foreach($cadas as $cada)
                  <tr>
                    <td class="text-center"><a href="{{ route('servico.edit', $cada->id) }}" class="badge bg-pink" target="_blank">{{ $cada->id }}</a></td>
                    <td class="text-left">{{ $cada->tipo }}</td>
                    <td class="text-left">{{ $cada->nome }}</td>
                    @foreach($pessoas->sortBy('id') as $profissional)
                      <td contenteditable class="text-center column_nome" data-column_name="{{ $cada->id }}" id="{{ $profissional->id }}">
                        @foreach ( $cada->smenhgskqwmdjwe as $colabservic )
                          @if( $colabservic->id_profexec == $profissional->id && $colabservic->executa == 'Sim' )
                            {{ $colabservic->prc_comissao * 100 }}
                          @endif
                        @endforeach
                    @endforeach
                    </td>
                    </tr>
                  @endforeach
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right">
          @if(isset($dataForm))
          {{-- {{ $servicos->appends($dataForm)->links() }} --}}
          @else
          {{-- {{ $servicos->links() }} --}}
          @endif
        </div>
      </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    var _token = $('input[name="_token"]').val();

    $(document).on('blur', '.column_nome', function()
    {
      var id_servprod      = $(this).data('column_name');
      var prc_comissao    = $(this).text();
      var id_profexec = $(this).attr('id');

      axios.post("{{ route('comissao.configurar') }}", {
        id_servprod      : id_servprod,
        prc_comissao    : prc_comissao,
        id_profexec : id_profexec,
      })
      .then(function(response)
      {
        // console.log(response)
        toastrjs( response.data.type, response.data.message )
      })
  @include('includes.catch', [ 'codigo_erro' => '2257805a' ] )
    })
  })
  
</script>
@stop
