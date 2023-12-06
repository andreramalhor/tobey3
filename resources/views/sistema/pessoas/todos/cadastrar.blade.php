@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('pessoas.gravar') }}" id="form_pessoa_create" autocomplete="off">
  @csrf
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <input type="hidden" name="atd_pessoas_contacts" id="atd_pessoas_contacts" value="">
  <input type="hidden" name="atd_pessoas_address" id="atd_pessoas_address" value="">
  <div class="row">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dados Pessoais</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <div class="form-group">
                <label class="col-form-label">Nome Completo<font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm " name="nome" onchange="validar(this)">
              </div>
            </div>
            <div class="col-4">
              <label class="col-form-label">Apelido<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm" name="apelido" onchange="validar(this)">
            </div>
            <div class="col-6">
              <label class="col-form-label">Data de Nascimento</label>
              <input type="date" class="form-control form-control-sm" name="dt_nascimento" value="">
            </div>
            <div class="col-6">
              <div class="form-group">
                <label class="col-form-label">Sexo</label>
                <select class="form-control form-control-sm" name="sexo">
                  <option value="F">Feminino</option>
                  <option value="M">Masculino</option>
                  <option value="">Não Informado</option>
                </select>
              </div>
            </div>
            <div class="col-4">
              <label class="col-form-label">CPF</label>
              <input type="text" class="form-control form-control-sm" name="cpf" id="cpf" onchange="validarCPF(this)">
            </div>
            <div class="col-8">
              <label class="col-form-label">e-Mail</label>
              <input type="mail" class="form-control form-control-sm" name="email" onchange="validar(this)">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Redes Sociais</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="widget-user-header">
                <div class="widget-user-image text-center">
                  @php $url = asset('img/atendimentos/pessoas/0.png') @endphp
                  <input type="hidden" name="foto_padrao" id="foto_padrao" value="{{ $url }}">
                  <input type="hidden" name="foto_temp" id="foto_temp" value="">
                  <input type="hidden" name="foto_perfil" id="foto_perfil" value="">
                  <img class="img-circle elevation-1" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar" height="85px" id="profile_picture">
                </div>
              </div>
            </div>
            <div class="col-12">
            {{-- @include('includes.form.text', [ 'colunas' => '2', 'name' => 'ddd', 'id' => 'ddd', 'label' => 'DDD', 'value' => '33' ]) --}}

              <div class="form-group">
                <label class="col-form-label">Instagram</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a class="input-group-text" href="https://www.instagram.com" target="_blank" id="instagram_address">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                  <input type="text" class="form-control form-control-sm" name="instagram" id="instagram" onchange="validarINTA(this)">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <input type="checkbox" id="trocar_foto" data-bs-tooltip="tooltip" data-bs-title="Substituir Foto" checked onchange="validar(this)">
                    </div>
                  </div>
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
                <input type="text" class="form-control form-control-sm" name="facebook">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Contatos</h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn b btn-default btn-xs" data-bs-toggle="modal" data-bs-target="#modal_pessoas_contact" id="modal_contact"><i class="fas fa-plus"></i></a>
            </div>
          </div>
        </div>
        @include('sistema.atendimentos.pessoas.modal.contact')
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
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Endereços</h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn btn-default btn-xs" data-bs-toggle="modal" data-bs-target="#modal_pessoas_address" id="modal_address"><i class="fas fa-plus"></i></a>
            </div>
            @include('sistema.atendimentos.pessoas.modal.address')
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm">
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
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('pessoas.todos') }}" class="btn btn-secondary">Cancel</a>
      <a class="btn btn-success float-right" style="color:white" id='submit_pessoa_create'>Cadastrar</a>
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
  $("[name='cpf']").inputmask({"mask": "999.999.999-99"});
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
@include('includes.catch', [ 'codigo_erro' => '4011221a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '8796108a' ] )
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

$("#submit_pessoa_create").on('click', function(e)
{
  e.preventDefault();

  let dados = $('#form_pessoa_create').serialize();

  axios.post('{{ route('pessoas.gravar') }}', dados)
  .then(function(response)
  {
    console.log(response)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '3926081a' ] )
});
</script>
@endsection
