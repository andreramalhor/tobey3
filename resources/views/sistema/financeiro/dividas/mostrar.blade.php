@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Banco: {{ $banco->nome }}</h3>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item"><a class="nav-link active" href="#sobre" data-bs-toggle="tab">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#extrato" data-bs-toggle="tab">Extrato</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="sobre">
            <div class="row">
              <div class="row invoice-info">
                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted"># ID</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->id }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Nome</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->nome }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Número do Banco</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->num_banco ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Número da Agência</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->num_agencia ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Número da Conta</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->num_conta ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Saldo Inicial</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  R$ {{ number_format($banco->saldo_inicial ?? 0, 2, ',', '.') }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Saldo Atual</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  R$ {{ number_format($banco->saldo_atual ?? 0, 2, ',', '.') }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Código da Carteira</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->cod_carteira ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Chave Pix</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->chave_pix ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>


                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Pix</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $banco->pix ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <br><br>
              </div>
            </div>
          </div>
          <div class="tab-pane " id="extrato">
            {{-- <div class="overlay" id="overlay-bancos-extrato"> --}}
              {{-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> --}}
            {{-- </div> --}}
            <div class="card-body table-responsive p-0" id="tabela-bancos-extrato">
              <table class="table table-sm table-striped no-padding table-valign-middle">
                <thead class="table-dark">
                  <tr>
                    <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="{{ route('fin.bancos') }}" class="btn btn-secondary">Voltar</a>
  </div>
</div>
<br>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
    bancos_extrato_tabelar()
  });

  function bancos_extrato_tabelar()
  {
    $('#overlay-bancos-extrato').show();

    var url = "{{ route('fin.bancos.extrato.tabelar', ':id') }}";
    var url = url.replace(':id', {{ $banco->id }});

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-bancos-extrato').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '7548478a' ] )
    .then( function(response)
    {
      $('#overlay-bancos-extrato').hide();
    })
  }

  function bancos_usuario_remover(id)
  {
    $('#overlay-bancos-extrato').show();

    {{-- var url = "{{ route('fin.bancos.extrato.remover', ':id') }}"; --}}
    var url = url.replace(':id', {{ $banco->id }});

    axios.post(url, [{
      id_pessoa: id,
    }])
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
      $('#tabela-bancos-extrato').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '1607587a' ] )
    .then( function(response)
    {
      bancos_extrato_tabelar();
    })
    .then( function(response)
    {
      $('#overlay-bancos-extrato').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endpush
