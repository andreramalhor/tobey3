@extends('layouts.app')

@section('content')
@include('sistema.pdv.vendas.auxiliares.resumo')
<form method="POST" action="{{ route('comissoes.updateComissao') }}" id="form_comissao_update" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Comanda</h3>
        </div>
        <div class="card-body p-0">
          <div class="row">
            <div class="col-12">
              <div class="widget-user-header">
                <div class="widget-user-image text-center">
                  <img class="img-circle elevation-1" src="{{ asset('img/atendimentos/pessoas/'. optional($comissao->lskjasdlkdflsdj->vekwjqowidskjsd)->id ?? '0' .'.png') }}" alt="User Avatar" height="85px" id="profile_picture">
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="col-md-12 p-0">
            <table class="table table-bordered table-condensed">
              <tr style="background-color: #222d32; color: white;">
                <th class="text-center">Comanda</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Data da Venda</th>
              </tr>
              <tr>
                <td class="text-center"><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $comissao->lskjasdlkdflsdj->id }})"><span class="badge bg-pink">{{ $comissao->lskjasdlkdflsdj->id }}</span></a></td>
                  <td class="text-center">{{ $comissao->lskjasdlkdflsdj->vekwjqowidskjsd->apelido ?? '(Cliente sem cadastro)' }}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($comissao->lskjasdlkdflsdj->created_at ?? '')->format('d/m/Y H:i') }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detalhes da Comanda</h3>
          </div>
          <div class="card-body p-0">
            <div class="col-md-12 p-0">
              <table class="table table-bordered table-condensed">
                <tr style="background-color: #222d32; color: white;">
                  <th class="text-center"># Serviço</th>
                  <th class="text-center">Serviços</th>
                  <th class="text-center">Valor do Serviço</th>
                  <th class="text-center">Profissional</th>
                  <th class="text-center">% Comissão</th>
                  <th class="text-center">Valor Comissão</th>
                </tr>
                @foreach($comissao->skfmwuorwmlpdlm->dfyejmfcrkolqjh->sortBy('id') as $venda_detalhe)
                  @if($venda_detalhe->id == $comissao->id_origem)
                  <tr class="bg-maroon">
                    <td class="text-center">{{ $venda_detalhe->id }}</td>
                    <td class="text-center">{{ $venda_detalhe->kcvkongmlqeklsl->nome }}</td>
                      <td class="text-center">{{ number_format($venda_detalhe->vlr_final, 2, ',', '.') }}</td>
                      <td class="text-center">{{ $venda_detalhe->hgihnjekboyabez->xeypqgkmimzvknq->apelido }}</td>
                      <td class="text-center">{{ $venda_detalhe->hgihnjekboyabez->percentual * 100 }}%</td>
                      <td class="text-center">{{ number_format($venda_detalhe->hgihnjekboyabez->valor, 2, ',', '.') }}</td>
                    </tr>
                  @else
                    <tr>
                      <td class="text-center">{{ $venda_detalhe->id }}</td>
                      <td class="text-center">{{ $venda_detalhe->kcvkongmlqeklsl->nome }}</td>
                      <td class="text-center">{{ number_format($venda_detalhe->vlr_final, 2, ',', '.') }}</td>
                      <td class="text-center">{{ $venda_detalhe->hgihnjekboyabez->xeypqgkmimzvknq->apelido }}</td>
                      <td class="text-center">{{ $venda_detalhe->hgihnjekboyabez->percentual * 100 }}%</td>
                      <td class="text-center">{{ number_format($venda_detalhe->hgihnjekboyabez->valor, 2, ',', '.') }}</td>
                    </tr>
                  @endif
                @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        {{--       <div class="overlay" id="overlay_editar_comissoes">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div> --}}
      <div class="card-header">
        <h3 class="card-title">Informação da Comissão</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-1">
            <div class="form-group">
              <label class="col-form-label">ID</label>
              <input type="text" class="form-control form-control-sm " name="id" value="{{ $comissao->id }}" readonly="readonly">
            </div>
          </div>
          <div class="col-1">
            <label class="col-form-label">ID Origem</label>
            <input type="text" class="form-control form-control-sm " name="id_origem" value="{{ $comissao->id_origem }}" readonly="readonly">
          </div>
          <div class="col-2">
            <label class="col-form-label">Fonte Origem</label>
            <input type="text" class="form-control form-control-sm " name="fonte_origem" value="{{ $comissao->fonte_origem }}" readonly="readonly">
          </div>
          <div class="col-1">
            <div class="form-group">
              <label class="col-form-label">ID Profissional</label>
              <input type="text" class="form-control form-control-sm " name="id_pessoa" value="{{ $comissao->id_pessoa }}" readonly="readonly">
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <label class="col-form-label">Profissional</label>
              <select class="form-control form-control-sm" name="id_profexec_fez_servico" id="id_profexec_fez_servico">
                <option value=""> . . . </option>
              </select>
            </div>
          </div>
            <div class="col-2">
              <label class="col-form-label">Tipo</label>
              <input type="text" class="form-control form-control-sm " name="tipo" value="{{ $comissao->tipo }}" readonly="readonly">
            </div>
            <div class="col-1">
              <label class="col-form-label">Percentual</label>
              <input type="text" class="form-control form-control-sm " id="percentual" name="percentual" value="{{ $comissao->percentual }}">
            </div>
            <div class="col-1">
              <label class="col-form-label">Valor</label>
              <input type="text" class="form-control form-control-sm " id="valor" name="valor" value="{{ $comissao->valor }}">
            </div>
            <div class="col-2">
              <label class="col-form-label">Dt Prevista</label>
              <input type="text" class="form-control form-control-sm " name="dt_prevista" value="{{ $comissao->dt_prevista }}" readonly="readonly">
            </div>
            <div class="col-2">
              <label class="col-form-label">Dt Quitação</label>
              <input type="text" class="form-control form-control-sm " name="dt_quitacao" value="{{ $comissao->dt_quitacao }}" readonly="readonly">
            </div>
            <div class="col-2">
              <label class="col-form-label">ID Destino</label>
              <input type="text" class="form-control form-control-sm " name="id_destino" value="{{ $comissao->id_destino }}" readonly="readonly">
            </div>
            <div class="col-2">
              <label class="col-form-label">Fonte Destino</label>
              <input type="text" class="form-control form-control-sm " name="fonte_destino" value="{{ $comissao->fonte_destino }}" readonly="readonly">
            </div>
            <div class="col-2">
              <label class="col-form-label">Status</label>
              <input type="text" class="form-control form-control-sm " name="status" value="{{ $comissao->status }}" readonly="readonly">
            </div>
            <div class="col-2">
              <label class="col-form-label">Dt Lançamento</label>
              <input type="text" class="form-control form-control-sm " name="created_at" value="{{ $comissao->created_at }}" readonly="readonly">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      {{-- <a href="{{ redirect()->back() }}" class="btn btn-secondary">Cancel</a> --}}
      <a class="btn btn-success float-right" style="color: white; display: none;" id='submit_comissao_update'>Editar</a>
    </div>
  </div>
  <br>
</form>
@include('includes.modal.modal-geral-1')
@endsection

@section('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  procurar_dados_ProfissionaisCapacitados( {{ $comissao->lskjasdlkdflsdj->id_servprod }} )
});

function procurar_dados_ProfissionaisCapacitados( id_servprod )
{
  url = "{{ route('pessoa.profExec', ':id') }}";
  url = url.replace(':id', [id_servprod] );

  id_profexec = {{ $comissao->id_pessoa }}

  axios.get(url)
  .then( function(response)
  {
    // console.log(response.data)
    $("#id_profexec_fez_servico").empty().append('<option value="" selected>. . . </option>');
    $.each( response.data, function( key, value )
    {
      if (value.id_profexec == id_profexec )
      {
        $("#id_profexec_fez_servico").append('<option value="'+value.dwsdjqwqwekowqe.id+'" selected>'+value.dwsdjqwqwekowqe.apelido+'</option>')
      }
      else
      {
        $("#id_profexec_fez_servico").append('<option value="'+value.dwsdjqwqwekowqe.id+'">'+value.dwsdjqwqwekowqe.apelido+'</option>')
      }
    })
  })
  .then( function ()
  {
    $('#overlay_editar_comissoes').hide();
  })
  @include('includes.catch', [ 'codigo_erro' => '9774305a' ] )
}

$("#id_profexec_fez_servico").on('change', function (e)
{
  $('#overlay_editar_comissoes').show();

  id_profexec = $("#id_profexec_fez_servico").val();
  id_servprod = {{ $comissao->lskjasdlkdflsdj->id_servprod }};
  valor       = {{ $comissao->percentual == 0 ? 0 : $comissao->valor / $comissao->percentual }};

  selecionarProfissional(id_profexec, id_servprod, valor)
});


function selecionarProfissional(id_profexec, id_servprod, valor)
{
  url = "{{ route('cat.comissao.buscar', [ ':id_profexec', ':id_servprod' ] ) }}";
  url = url.replace(':id_profexec', id_profexec );
  url = url.replace(':id_servprod', id_servprod );

  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    $("#id_profexec").val(id_profexec);
    $("#percentual").val(parseFloat(response.data.prc_comissao)).attr("readonly", false);;
    $("#valor").val(parseFloat(response.data.prc_comissao) * valor).attr("readonly", false);
  })
  .then( function ()
  {
    $('#overlay_editar_comissoes').hide();
    $('#submit_comissao_update').show();
  })
  @include('includes.catch', [ 'codigo_erro' => '3944527a' ] )
}

$("#submit_comissao_update").on('click', function(e)
{
  e.preventDefault();

  let dados = $('#form_comissao_update').serialize();

  axios.post('{{ route('comissoes.updateComissao') }}', dados) 
  .then(function(response)
  {
    console.log(response)
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '6977200a' ] )
});

</script>
@endsection
