@extends('layouts.app')

@section('content')
<form method="POST" id="form_clientes_editar" autocomplete="off">
  @csrf
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <input type="hidden" name="pessoas_contatos" id="pessoas_contatos" value="{{ $pessoa->ginthgfwxbdhwtu->toJson() ?? '' }}">
  <input type="hidden" name="pessoas_enderecos" id="pessoas_enderecos" value="{{ $pessoa->uqbchiwyagnnkip->toJson() ?? '' }}">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Foto de Perfil</h3>
        </div>
        <div class="card-body">
          <div id="actions" class="row">
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-12">
                <div class="widget-user-header">
                  <div class="widget-user-image text-center">
                    @php $url = asset('img/atendimentos/pessoas/0.png') @endphp
                    <input type="hidden" name="foto_padrao" id="foto_padrao" value="{{ $url }}">
                    <input type="hidden" name="foto_temp" id="foto_temp" value="">
                    <input type="hidden" name="foto_perfil" id="foto_perfil" value="">
                    <img class="img-circle elevation-1" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar" height="155px" id="profile_picture">
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-lg-12">
                <div class="btn-group w-100">
                  <span class="btn btn-success col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                  </span>
                  <button type="submit" class="btn btn-primary col start">
                    <i class="fas fa-upload"></i>
                  </button>
                  <button type="reset" class="btn btn-warning col cancel">
                    <i class="fas fa-times-circle"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-lg-12 d-flex align-items-center">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table table-striped files" id="previews">
          </div>
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dados Pessoais: {{ $pessoa->nome }} ({{ $pessoa->apelido }})</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <label class="col-form-label">Nome Completo<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm " name="nome" value="{{ $pessoa->nome ?? '' }}" onchange="validar(this)">
            </div>
            <div class="col-4">
              <label class="col-form-label">Apelido<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm" name="apelido" value="{{ $pessoa->apelido ?? '' }}" onchange="validar(this)">
            </div>
            <div class="col-6">
              <label class="col-form-label">Data de Nascimento</label>
              <input type="date" class="form-control form-control-sm" name="dt_nascimento" value="{{ $pessoa->dt_nascimento ?? '' }}">
            </div>
            <div class="col-6">
              <label class="col-form-label">Sexo</label>
              <select class="form-control form-control-sm" name="sexo">
                <option value="F" {{ $pessoa->sexo == "F" ? 'selected' : "" }}>Feminino</option>
                <option value="M" {{ $pessoa->sexo == "M" ? 'selected' : "" }}>Masculino</option>
                <option value="" {{ $pessoa->sexo == "" ? 'selected' : "" }}>Não Informado</option>
              </select>
            </div>
            <div class="col-4">
              <label class="col-form-label">CPF / CNPJ</label>
              <input type="text" class="form-control form-control-sm" name="cpf" id="cpf" value="{{ $pessoa->cpf ?? '' }}" onchange="validarCPF(this)">
            </div>
            <div class="col-8">
              <label class="col-form-label">e-Mail</label>
              <input type="mail" class="form-control form-control-sm" name="email" value="{{ $pessoa->email ?? '' }}" onchange="validar(this)">
            </div>
            <div class="col-12">
              <label class="col-form-label">Observação</label>
              <input type="text" class="form-control form-control-sm" name="observacao" value="{{ $pessoa->observao ?? '' }}">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Redes Sociais</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="col-form-label">Instagram</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a class="input-group-text" href="https://www.instagram.com" target="_blank" id="instagram_address">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                  <input type="text" class="form-control form-control-sm" name="instagram" id="instagram" value="{{ $pessoa->instagram ?? '' }}" onchange="validarISNTA(this)">
                  {{-- <div class="input-group-append"> --}}
                    {{-- <div class="input-group-text"> --}}
                      {{-- <input type="checkbox" id="trocar_foto" data-bs-tooltip="tooltip" data-bs-title="Substituir Foto" checked onchange="validar(this)"> --}}
                    {{-- </div> --}}
                  {{-- </div> --}}
                </div>
              </div>
            </div>
            <div class="col-12">
              <label class="col-form-label">Facebook</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a class="input-group-text" href="https://www.facebook.com" target="_blank">
                    <i class="fab fa-facebook"></i>
                  </a>
                </div>
                <input type="text" class="form-control form-control-sm" name="facebook" value="{{ $pessoa->facebook }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Endereços</h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn btn-default btn-xs" data-bs-toggle="modal" data-bs-target="#modal_pessoas_endereco"><i class="fas fa-plus"></i></a>
            </div>
            @include('sistema.atendimentos.pessoas.auxiliares.mod_endereco')
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-left">Tipo</th>
                <th class="text-left">CEP</th>
                <th class="text-left">Logradouro, Número (Compl.) - Bairro</th>
                <th class="text-left">Cidad - UF</th>
                <th><i class="fas fa-ellipsis-h"></i></th>
              </tr>
            </thead>
            <tbody id="tabela-address">
              <tr>
                <td class="text-center" colspan="5">Não há endereços cadastrados.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Contatos</h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn b btn-default btn-xs" data-bs-toggle="modal" data-bs-target="#modal_pessoas_contato"><i class="fas fa-plus"></i></a>
            </div>
          </div>
        </div>
        @include('sistema.atendimentos.pessoas.auxiliares.mod_contato')
        <div class="card-body p-0">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-center">Tipo</th>
                <th class="text-center">(DDD) Número</th>
                <th><i class="fas fa-ellipsis-h"></i></th>
              </tr>
            </thead>
            <tbody id="tabela-contacts">
              <tr>
                <td class="text-center" colspan="3">Não há contatos cadastrados.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('atd.pessoas') }}" class="btn btn-secondary">Cancelar</a>
      <a class="btn btn-success float-right" style="color:white" onclick="pessoa_editar()" id="btn_pessoa_editar">Editar</a>
    </div>
  </div>
</form>
<br>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function()
{
  $("[name='cpf'").inputmask({
    mask: ["999.999.999-99", "99.999.999/9999-99", ],
    keepStatic: true
  })
});

$("[name='nome']").on('change', function (e)
{
  let nome = (e.target.value).split(" ");
  let ulti = (nome.length) - 1;
  let apelido = nome[0]+" "+nome[ulti];
  if (ulti == 0)
  {
    $("[name='apelido']").val(nome[0]);
  }
  else
  {
    $("[name='apelido']").val(apelido);
    $("[name='apelido']").change();
  }
});

function validar(item)
{
  let valor = item.value;
  let campo = item.name;

  var dados = {
    valor: valor,
    campo: campo,
  };
  
  var url = "{{ route('atd.pessoas.validar', ':idd') }}";
  var url = url.replace(':idd', {{ $pessoa->id }});

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    if(response.data.type == 'error')
    {
      toastrjs(response.data.type, response.data.message )
      $("#btn_pessoa_editar").addClass('disabled');
      $("[name='"+item.name+"']").removeClass('is-warning');
      $("[name='"+item.name+"']").removeClass('is-valid');
      $("[name='"+item.name+"']").addClass('is-invalid');
    }
    else
    {
      $("[name='"+item.name+"']").removeClass('is-warning');
      $("[name='"+item.name+"']").removeClass('is-invalid');
      $("[name='"+item.name+"']").addClass('is-valid');
      $("#btn_pessoa_editar").removeClass('disabled');
    }


    // if(valor == 'instagram')
    // {
    //   let foto_perfil = $("#foto_perfil").val();
    //   $("#profile_picture").attr('src', foto_perfil);
    //   toastrjs('success', 'Foto do perfil atualizada.')
    //   $("#instagram_address").attr('href', 'https://www.instagram.com/'+instagram);
    // }
  })
@include('includes.catch', [ 'codigo_erro' => '5103383a' ] )
};

function validarISNTA(field)
{
  validar(field)
  let campo = $(field);
  let arroba = $("#instagram").val();

  if ($('#trocar_foto').is(':checked'))
  {
    url = 'https://www.instagram.com/web/search/topsearch/?context=user&count=0&query='+arroba;
    // axios.get('https://www.instagram.com/'+arroba+'/?__a=1')
    axios.get(url)
    .then(function(response)
    {
      // console.log(response)
      $("#foto_perfil").val(response.data.graphql.user.profile_pic_url);
      validar(field)
    })
@include('includes.catch', [ 'codigo_erro' => '2344361a' ] )
  }
}

function validarCPF(field)
{
  valor = (field).value;
  valor = valor.replace(/[^0-9]/g, '');

  if ( valor.length === 11 )
  {
    if(valor.length == 0)
    {
      $('#cpf').removeClass('is-invalid');
      $('#cpf').removeClass('is-valid');
      $('#cpf').addClass('is-warning');
      toastrjs('warning', 'O CPF será salvo como "Não preenchido".')
      $('#cpf').val('');
    }
    else if(valor == "00000000000" || valor == "11111111111" || valor == "22222222222" || valor == "33333333333" || valor == "44444444444" || valor == "55555555555" || valor == "66666666666" || valor == "77777777777" || valor == "88888888888" || valor == "99999999999")
    {
      $('#cpf').removeClass('is-invalid');
      $('#cpf').removeClass('is-valid');
      $('#cpf').addClass('is-warning');
      toastrjs('warning', 'O CPF será salvo como "Não preenchido".')
      $('#cpf').val('');
    }
    else
    {
      valida_cpf( valor )
      validar(field)
    }
  }
  else if ( valor.length === 14 ) 
  {
    valida_cnpj( valor )
    validar(field)
  } 
  else
  {
    $('#cpf').removeClass('is-valid');
    $('#cpf').removeClass('is-invalid');
    $('#cpf').addClass('is-warning');
    toastrjs('warning', 'CPF/CNPJ Inválido.')
    return false;
  }
}

function calc_digitos_posicoes( digitos, posicoes = 10, soma_digitos = 0 )
{
  digitos = digitos.toString();
  
  for ( var i = 0; i < digitos.length; i++  )
  {
    soma_digitos = soma_digitos + ( digitos[i] * posicoes );

    posicoes--;

    if ( posicoes < 2 )
    {
      posicoes = 9;
    }
  }

  soma_digitos = soma_digitos % 11;

  if ( soma_digitos < 2 )
  {
    soma_digitos = 0;
  }
  else
  {
    soma_digitos = 11 - soma_digitos;
  }

  var cpf = digitos + soma_digitos;

  return cpf;  
}

function valida_cpf( valor )
{
  var digitos = valor.substr(0, 9);
  var novo_cpf = calc_digitos_posicoes( digitos );
  var novo_cpf = calc_digitos_posicoes( novo_cpf, 11 );

  if ( novo_cpf === valor )
  {
    $('#cpf').removeClass('is-warning');
    $('#cpf').removeClass('is-invalid');
    $('#cpf').addClass('is-valid');
    toastrjs('success', 'CPF Válido.')
    return true;
  }
  else
  {
    $('#cpf').removeClass('is-valid');
    $('#cpf').removeClass('is-warning');
    $('#cpf').addClass('is-invalid');
    toastrjs('error', 'CPF Inválido.')
    return false;
  } 
}

function valida_cnpj( valor )
{
  var cnpj_original = valor;

  var primeiros_numeros_cnpj = valor.substr( 0, 12 );

  var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );

  var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );

  var cnpj = segundo_calculo;

  if ( cnpj === cnpj_original )
  {
    $('#cpf').removeClass('is-warning');
    $('#cpf').removeClass('is-invalid');
    $('#cpf').addClass('is-valid');
    toastrjs('success', 'CNPJ Válido.')
    return true;
  }
  
  $('#cpf').removeClass('is-valid');
  $('#cpf').removeClass('is-warning');
  $('#cpf').addClass('is-invalid');
  toastrjs('error', 'CNPJ Inválido.')
  return false;
}

function valida_cpf_cnpj( valor )
{
    var valida = verifica_cpf_cnpj( valor );

    valor = valor.toString();
    
    valor = valor.replace(/[^0-9]/g, '');

    if ( valida === 'CPF' )
    {
      return valida_cpf( valor );
    } 
    else if ( valida === 'CNPJ' )
    {
      return valida_cnpj( valor );
    } 
    
    else
    {
      alert('ERRO NO RETORNO')
      return false;
    }
}

function pessoa_editar()
{
  var url = "{{ route('atd.pessoas.atualizar', ':idd') }}";
  var url = url.replace(':idd', {{ $pessoa->id }});

  let dados = $('#form_clientes_editar').serialize();


  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '5939680a' ] )
}
</script>
@endsection
