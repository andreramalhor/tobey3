@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Foto de Perfil</h3>
      </div>
      <div class="card-body">
        <form id="form_clientes_adicionar_avatar" onsubmit="return false">
          @csrf
          <div id="actions" class="row">
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="widget-user-header">
                  <div class="widget-user-image text-center">
                    @php $url = asset('img/atendimentos/pessoas/0.png') @endphp
                    <input type="hidden" name="foto_padrao" id="foto_padrao" value="{{ $url }}">
                    <img class="img-circle elevation-1" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar" height="155px" id="profile_picture">
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="btn-group w-100">
                  <span class="btn btn-success col fileinput-button dz-clickable" onchange="pessoa_avatar_gravar()" id="foto_enviar">
                    <input type="file" name="image" id="image" class="btn btn-success col fileinput-button dz-clickable">
                    {{-- <i class="fas fa-plus"></i> --}}
                  </span>
                </div>
                
                {{-- <span class="btn btn-primary col start" onclick="pessoa_gravar_avatar()"> --}}
                  {{-- <i class="fas fa-upload"></i> --}}
                  {{-- </span> --}}
                  
                <div class="btn-group w-100">
                  <button type="reset" class="btn btn-warning col cancel" id="foto_cancelar" onclick="pessoas_avatar_remove()" style="display:none;">
                    <i class="fas fa-times-circle"></i>
                  </button>
                </div>
              </div>
            </div>
            {{--               <div class="row" style="margin-bottom: 20px;">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex align-items-center">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
          <div class="table table-striped files" id="previews"></div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <form method="POST" id="form_clientes_adicionar" autocomplete="off">
      @csrf
      <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
      <input type="hidden" name="foto_temp" id="foto_temp" value="">
      <input type="hidden" name="pessoas_contatos" id="pessoas_contatos" value="">
      <input type="hidden" name="pessoas_enderecos" id="pessoas_enderecos" value="">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dados Pessoais</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
              <label class="col-form-label">Nome Completo<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm " name="nome" onchange="validar(this)">
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <label class="col-form-label">Apelido<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm" name="apelido" onchange="validar(this)">
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label class="col-form-label">Data de Nascimento</label>
              <input type="date" class="form-control form-control-sm" name="dt_nascimento" value="">
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label class="col-form-label">Sexo</label>
              <select class="form-control form-control-sm" name="sexo">
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
                <option value="">Não Informado</option>
              </select>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <label class="col-form-label">CPF / CNPJ</label>
              <input type="text" class="form-control form-control-sm" name="cpf" id="cpf" onchange="validarCPF(this)">
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
              <label class="col-form-label">e-Mail</label>
              <input type="mail" class="form-control form-control-sm" name="email" onchange="validar(this)">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <label class="col-form-label">Observação</label>
              <input type="text" class="form-control form-control-sm" name="observacao">
            </div>
            {{-- @dd(\Auth::User(),  \Auth::User()->klwqejqlkwndwiqo,  \Auth::User()->klwqejqlkwndwiqo->nome) --}}
            @if(\Auth::User()->klwqejqlkwndwiqo->nome == 'Instituto Embelleze Caratinga')
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <label class="col-form-label">ID RS School</label>
              <input type="text" class="form-control form-control-sm" name="id_rsschool">
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Redes Sociais</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <div class="form-group">
                <label class="col-form-label">Instagram</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a class="input-group-text" href="https://www.instagram.com" target="_blank" id="instagram_address">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                  <input type="text" class="form-control form-control-sm" name="instagram" id="instagram" onchange="validarISNTA(this)">
                  {{-- <div class="input-group-append"> --}}
                    {{-- <div class="input-group-text"> --}}
                      {{-- <input type="checkbox" id="trocar_foto" data-bs-tooltip="tooltip" data-bs-title="Substituir Foto" checked onchange="validar(this)"> --}}
                      {{-- </div> --}}
                      {{-- </div> --}}
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
    
    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
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
    
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
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
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <a href="{{ route('atd.pessoas') }}" class="btn btn-secondary">Cancelar</a>
      <a class="btn btn-success float-right" style="color:white" onclick="pessoa_gravar()" id="btn_pessoa_gravar">Cadastrar</a>
    </div>
  </div>
</form>
<br>
@endsection

@section('js')
<script type="text/javascript">
function pessoa_gravar()
{
  // e.preventDefault();
  let dados = $('#form_clientes_adicionar').serialize();

  axios.post('{{ route('atd.pessoas.gravar') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '3543453a' ] )
}


</script>
@endsection
