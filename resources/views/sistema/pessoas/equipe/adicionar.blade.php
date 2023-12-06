@extends('layouts.app')

@section('content')
<form id="form_equipe_adicionar" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-4">
      <div class="card">
        <div class="overlay" id="overlay-cliente">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Pesquisar Integrante</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Nome</label>
                <select class="form-control form-control-sm select2" name="id_pessoa" id="id_pessoa" onchange="selecionarIntegrante()">
                  <option>Carregando. . . </option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="overlay" id="overlay-identificao">
          {{-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> --}}
        </div>
        <div class="card-header">
          <h3 class="card-title">Identificação</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="widget-user-header">
                <div class="widget-user-image text-center">
                  @php $url = asset('img/atendimentos/pessoas/0.png') @endphp
                  <img class="img-circle elevation-1" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar" height="85px" id="profile_picture">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label class="col-form-label">Nome</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="identificacao_nome" disabled="disabled">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label class="col-form-label">Data de Nascimento</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="identificacao_dt-nascimento" disabled="disabled">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="overlay" id="overlay-acessos">
          {{-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> --}}
        </div>
        <div class="card-header">
          <h3 class="card-title">Acessos</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="col-form-label">Usuário</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="username" name="username">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label class="col-form-label">Senha</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="password" name="password" value="123456" disabled="disabled">
                  <input type="hidden" id="password_confirmation" name="password_confirmation" value="123456">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label class="col-form-label">Tipo de Acesso</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="tipo_pessoa" name="tipo_pessoa" value="Equipe" disabled="disabled">
                  <input type="hidden" id="id_tipo" name="id_tipo" value="3">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('pessoas.equipe') }}" class="btn btn-secondary">Cancel</a>
      <a class="btn btn-success float-right" style="color:white" id='submit_equipe_gravar'>Adicionar</a>
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
  carregarPessoas()
  pss_todos = []
});

function carregarPessoas()
{
  var url = "{{ route('pessoas.pesquisar', ':tp') }}"
  var url = url.replace(':tp', "mode=!=&tp=Equipe")

  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    pss_pessoas = collect(response.data)
    $("#id_pessoa").empty().append('<option value="">Selecione . . . </option>')
    pss_pessoas.sortBy('nome').each((data) =>
    {
      $("#id_pessoa").append('<option value="'+data.id+'">'+data.nome+'</option>')
    })
  })
@include('includes.catch', [ 'codigo_erro' => '7245188a' ] )
  .then( function()
  {
    $("#overlay-cliente").hide()
  })
}

function selecionarIntegrante()
{
  $("#overlay-cliente").show()
  
  let id = $("#id_pessoa").val();
  let pessoa = pss_pessoas.filter(item => item.id === parseInt(id));

  $("#identificacao_nome").val(pessoa.items[0].nome)
  $("#identificacao_dt-nascimento").val(moment(pessoa.items[0].dt_nascimento).format('DD/MM/YYYY'))

  $("#overlay-cliente").hide()
  $("#overlay-identificao").hide()
  $("#overlay-acessos").hide()
}

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



$("#submit_equipe_gravar").on('click', function(e)
{
  e.preventDefault();

  let dados = $('#form_equipe_adicionar').serialize();
  console.log(dados)
  axios.post('{{ route('pessoas.equipe.gravar') }}', dados)
  .then(function(response)
  {
    console.log(response)
    // setTimeout(function(){
    window.location.href = response.data.redirect;
    // },5000);
  })
@include('includes.catch', [ 'codigo_erro' => '9174999a' ] )
});
</script>
@endsection
