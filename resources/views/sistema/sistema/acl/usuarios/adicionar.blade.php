@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Criar Função</h3>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label for="id_pessoa" class="col-sm-2 col-form-label">Usuário</label>
          <div class="col-sm-10">
            <select class="form-control form-control-sm select2" id="id_pessoa" name="id_pessoa">
              <option value="NULL">Selecione . . .</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="username" class="col-sm-2 col-form-label">Nome de Usuário</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Nome de Usuário" onchange="username_verificar()">
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Senha</label>
          <div class="col-sm-10">
            <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Senha" onchange="senha_verificar()">
          </div>
        </div>
        <div class="form-group row">
          <label for="confirm_password" class="col-sm-2 col-form-label">Confirmar Senha</label>
          <div class="col-sm-10">
            <input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" placeholder="Confirmar Senha" onchange="senha_confirmar()">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="col-12">
          <a href="{{ route('acl.usuarios') }}" class="btn btn-secondary">Cancelar</a>
          <a class="btn btn-success float-right d-none" id="usuario_incluir" onclick="usuario_incluir()">Incluir Usuário</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">  
$(document).ready(function()
{
  pessoas_listar()
})

function pessoas_listar()
{
  axios.get("{{ route('atd.pessoas.plucar') }}")
  .then(function(response)
  {
    // console.log(response.data)
    $("#id_pessoa").empty().append('<option>Selecione . . .</option>')
    $.each( response.data, function( value, key )
    {
      $("#id_pessoa").append('<option value="'+key+'">'+value+' ( '+key+' )</option>')
    })
  })
@include('includes.catch', [ 'codigo_erro' => '9625913a' ] )
}

function username_verificar()
{
  var url = "{{ route('atd.pessoas.pesquisar_usuario', ':username') }}"
  var url = url.replace(':username', $("#username").val())
  
  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    if(response.data)
    {
      $("#username").removeClass('is-invalid')
      $("#username").addClass('is-valid')
    }
    else
    {
      $("#username").removeClass('invalid')
      $("#username").addClass('is-invalid')
      $("#username").val('')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '2773149a' ] )
  .then( function ()
  {
    verificar_tudo()
  })
}

function senha_verificar()
{
  if($("#password").val().length >= 4)
  {
    $("#password").removeClass('is-invalid')
    $("#password").addClass('is-valid')
  }
  else
  {
    $("#password").removeClass('invalid')
    $("#password").addClass('is-invalid')
    $("#password").val('')
    toastrjs('error', 'A senha deve conter mais do que 4 caracteres.')
  }
  verificar_tudo()
}

function senha_confirmar()
{
  if($("#password").val() == $("#confirm_password").val())
  {
    $("#confirm_password").removeClass('is-invalid')
    $("#confirm_password").addClass('is-valid')
  }
  else
  {
    $("#confirm_password").removeClass('is-valid')
    $("#confirm_password").addClass('is-invalid')
    $("#confirm_password").val('')
    toastrjs('error', 'A confirmação não coincide com a senha.')
  }
  verificar_tudo()
}

function verificar_tudo()
{
  if(
    $('#id_pessoa').val() != 'Selecione . . .' &&
    $("#username").val() != '' &&
    $("#password").val() != '' &&
    $("#confirm_password").val() != ''
  )
  {
    $("#usuario_incluir").removeClass('d-none')
  }
  else
  {
    $("#usuario_incluir").addClass('d-none')
  }
}

function usuario_incluir()
{
  var url = "{{ route('acl.usuarios.atualizar', ':id') }}"
  var url = url.replace(':id', $("#id_pessoa").val())

  axios.put(url, {
    id_pessoa: $('#id_pessoa').val(),
    username: $("#username").val(),
    password: $("#password").val(),
    confirm_password: $("#confirm_password").val(),
  })
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message);
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '4462639a' ] )
}

</script>
@endsection
