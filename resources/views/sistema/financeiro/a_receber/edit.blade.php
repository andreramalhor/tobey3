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
                  <img class="img-circle elevation-1" src="{{ asset('img/atendimentos/pessoas/'. $comissao->krnclwowqamsjls->sbbgaqleesuzlus->lufqzahwwexkxli->id .'.png') }}" alt="User Avatar" height="85px" id="profile_picture">
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
                <td class="text-center"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $comissao->krnclwowqamsjls->sbbgaqleesuzlus->id }})"><span class="badge bg-pink">{{ $comissao->krnclwowqamsjls->sbbgaqleesuzlus->id }}</span></a></td>
                <td class="text-center">{{ $comissao->krnclwowqamsjls->sbbgaqleesuzlus->lufqzahwwexkxli->apelido ?? 'apelido' }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($comissao->krnclwowqamsjls->sbbgaqleesuzlus->created_at)->format('d/m/Y H:i') }}</td>
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
              @foreach($comissao->krnclwowqamsjls->sbbgaqleesuzlus->dfyejmfcrkolqjh->sortBy('id') as $detalheVenda)
                @if($detalheVenda->id == $comissao->id_origem)
                  <tr class="bg-maroon">
                    <td class="text-center">{{ $detalheVenda->id }}</td>
                    <td class="text-center">{{ $detalheVenda->kcvkongmlqeklsl->nome }}</td>
                    <td class="text-center">{{ number_format($detalheVenda->vlr_final, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $detalheVenda->pqwnldkwjfencsb->xeypqgkmimzvknq->apelido }}</td>
                    <td class="text-center">{{ $detalheVenda->hgihnjekboyabez->percentual * 100 }}%</td>
                    <td class="text-center">{{ number_format($detalheVenda->hgihnjekboyabez->valor, 2, ',', '.') }}</td>
                  </tr>
                @else
                  <tr>
                    <td class="text-center">{{ $detalheVenda->id }}</td>
                    <td class="text-center">{{ $detalheVenda->kcvkongmlqeklsl->nome }}</td>
                    <td class="text-center">{{ number_format($detalheVenda->vlr_final, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $detalheVenda->pqwnldkwjfencsb->xeypqgkmimzvknq->apelido }}</td>
                    <td class="text-center">{{ $detalheVenda->hgihnjekboyabez->percentual * 100 }}%</td>
                    <td class="text-center">{{ number_format($detalheVenda->hgihnjekboyabez->valor, 2, ',', '.') }}</td>
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
@endsection

@section('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  procurar_dados_ProfissionaisCapacitados( {{ $comissao->krnclwowqamsjls->id_servprod }} )
});

function procurar_dados_ProfissionaisCapacitados( id_servprod_servico )
{
  url = "{{ route('pessoa.profExec', ':id') }}";
  url = url.replace(':id', [id_servprod_servico] );

  id_pessoa = {{ $comissao->id_pessoa }}

  axios.get(url)
  .then( function(response)
  {
    // console.log(response.data)
    $("#id_profexec_fez_servico").empty().append('<option value="" selected>. . . </option>');
    $.each( response.data, function( key, value )
    {
      if (value.id == id_pessoa )
      {
        $("#id_profexec_fez_servico").append('<option value="'+value.id+'" selected>'+value.nome+'</option>')
      }
      else
      {
        $("#id_profexec_fez_servico").append('<option value="'+value.id+'">'+value.nome+'</option>')
      }
    })
  })
  .then( function ()
  {
    $('#overlay_editar_comissoes').hide();
  })
@include('includes.catch', [ 'codigo_erro' => '7011838a' ] )
}

$("#id_profexec_fez_servico").on('change', function (e)
{
  $('#overlay_editar_comissoes').show();

  id_profexec = $("#id_profexec_fez_servico").val();
  id_servprod      = {{ $comissao->krnclwowqamsjls->id_servprod }};
  valor           = {{ $comissao->percentual == 0 ? 0 : $comissao->valor / $comissao->percentual }};

  selecionarProfissional(id_profexec, id_servprod, valor)
});


function selecionarProfissional(id_profexec, id_servprod, valor)
{
  url = "{{ route('servico.profServ', [ ':id_servprod', ':id_pessoa' ] ) }}";
  url = url.replace(':id_servprod', id_servprod );
  url = url.replace(':id_pessoa', id_profexec );

  axios.get(url)
  .then( function(response)
  {
    $("#id_profexec").val(id_profexec);
    $("#percentual").val(parseFloat(response.data.prc_comissao)).attr("readonly", false);;
    $("#valor").val(parseFloat(response.data.prc_comissao) * valor).attr("readonly", false);
  })
  .then( function ()
  {
    $('#overlay_editar_comissoes').hide();
    $('#submit_comissao_update').show();
  })
@include('includes.catch', [ 'codigo_erro' => '6981685a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '5200675a' ] )
});

{{-- 
function validar(field)
{
  let campo = $(field);
  let atrib = campo.attr('name');
  let dados = $('#form_pessoa_create').serialize();

  axios.post('{{ route('pessoa.triate') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    campo.removeClass('is-warning');
    campo.removeClass('is-invalid');
    campo.addClass('is-valid');

    if(atrib == 'instagram')
    {
      let foto_perfil = $("#foto_perfil").val();
      $("#profile_picture").attr('src', foto_perfil);
      toastrjs('success', 'Foto do perfil atualizada.')
      $("#instagram_address").attr('href', 'https://www.instagram.com/'+instagram);
    }
  })
@include('includes.catch', [ 'codigo_erro' => '6429773a' ] )
};

function validarINTA(field)
{
  let campo = $(field);
  let arroba = $("#instagram").val();

  if ($('#trocar_foto').is(':checked'))
  {
    axios.get('https://www.instagram.com/'+arroba+'/?__a=1')
    .then(function(response)
    {
      // console.log(response)
      $("#foto_perfil").val(response.data.graphql.user.profile_pic_url);
      validar(field)
    })
@include('includes.catch', [ 'codigo_erro' => '2492431a' ] )
  }
}

function validarCPF(field)
{
  let cpf = field.value.replace(/[^\d]+/g,'');

  if(cpf.length == 0)
  {
    $('#cpf').removeClass('is-invalid');
    $('#cpf').removeClass('is-valid');
    $('#cpf').addClass('is-warning');
    toastrjs('warning', 'O CPF será salvo como "Não preenchido".')
    $('#cpf').val('');
  }
  else if(cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
  {
    $('#cpf').removeClass('is-invalid');
    $('#cpf').removeClass('is-valid');
    $('#cpf').addClass('is-warning');
    toastrjs('warning', 'O CPF será salvo como "Não preenchido".')
    $('#cpf').val('');
  }
  else
  {
    var Soma;
    var Resto;
    Soma = 0;

    for(i=1; i<=9; i++)
    {
      Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
    }

    Resto = (Soma * 10) % 11;

    if((Resto == 10) || (Resto == 11))
    {
      Resto = 0;
    }

    if(Resto != parseInt(cpf.substring(9, 10)) )
    {
      $('#cpf').removeClass('is-invalid');
      $('#cpf').removeClass('is-valid');
      $('#cpf').addClass('is-warning');
      toastrjs('error', 'CPF Inválido.')
      return false;
    }

    Soma = 0;
    for(i = 1; i <= 10; i++)
    {
      Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
    }

    Resto = (Soma * 10) % 11;

    if((Resto == 10) || (Resto == 11))
    {
      Resto = 0;
    }

    if(Resto != parseInt(cpf.substring(10, 11) ) )
    {
      $('#cpf').removeClass('is-valid');
      $('#cpf').removeClass('is-warning');
      $('#cpf').addClass('is-invalid');
      toastrjs('error', 'CPF Inválido.')
    }
    else
    {
      validar(field)
    }
  }
}



 --}}
</script>
@endsection
