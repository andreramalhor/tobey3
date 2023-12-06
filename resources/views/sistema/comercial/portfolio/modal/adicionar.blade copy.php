<div class="modal fade" id="modal_atendimentos_pessoas_adicionar">
  <form method="POST" id="form_clientes_adicionar" autocomplete="off">
  @csrf
    <div class="modal-dialog" style="min-width: 95%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agendamentos: {{ \Carbon\Carbon::today()->format('d/m/Y') }}</h5>
          <input type="hidden" id="agendamentos_hoje_id" value="{{ $id_pessoa ?? null }}">
        </div>
        <div class="modal-body" style="background-color: #f5f5f5">
          <div class="row">
            <div class="col-9">
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
                    <div class="col-5">
                      <label class="col-form-label">Nome Completo<font color="red">*</font></label>
                      <input type="text" class="form-control form-control-sm " name="nome" onchange="validar(this)">
                    </div>
                    <div class="col-3">
                      <label class="col-form-label">Apelido<font color="red">*</font></label>
                      <input type="text" class="form-control form-control-sm" name="apelido" onchange="validar(this)">
                    </div>
                    <div class="col-2">
                      <label class="col-form-label">Data de Nascimento</label>
                      <input type="date" class="form-control form-control-sm" name="dt_nascimento" value="">
                    </div>
                    <div class="col-2">
                      <label class="col-form-label">Sexo</label>
                      <select class="form-control form-control-sm" name="sexo">
                        <option value="F">Feminino</option>
                        <option value="M">Masculino</option>
                        <option value="">Não Informado</option>
                      </select>
                    </div>
                    <div class="col-2">
                      <label class="col-form-label">CPF / CNPJ</label>
                      <input type="text" class="form-control form-control-sm cpf" name="cpf" id="cpf" onchange="validarCPF(this)">
                    </div>
                    <div class="col-4">
                      <label class="col-form-label">e-Mail</label>
                      <input type="mail" class="form-control form-control-sm" name="email" onchange="validar(this)">
                    </div>
                    <div class="col-5">
                      <label class="col-form-label">Observação</label>
                      <input type="text" class="form-control form-control-sm" name="observacao">
                    </div>
                    <div class="col-1">
                      <label class="col-form-label">#RSSchool</label>
                      <input type="text" class="form-control form-control-sm" name="id_rsschool">
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
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                      <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control form-control-sm" name="pessoas_enderecos['tipo_endereco'] " id="tipo_endereco">
                          <option value="Residencial">Residencial</option> 
                          <option value="Comercial">Comercial</option> 
                          <option value="Cobrança">Cobrança</option> 
                          <option value="Recado">Recado</option> 
                          <option value="Outros">Outros</option> 
                        </select>
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label>CEP</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['cep'] " id="cep">
                      </div>
                    </div>
                    <div class="col-1">
                      <div class="form-group">
                        <label>Número</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['numero'] " id="numero">
                      </div>
                    </div>
                    <div class="col-1">
                      <div class="form-group">
                        <label>Compl.</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['complemento'] " id="complemento">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['logradouro'] " id="logradouro">
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['bairro'] " id="bairro">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['cidade'] " id="cidade">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Estado</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_enderecos['uf'] " id="uf">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Contatos</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control form-control-sm" name="pessoas_contatos['tipo_contato']" id="tipo_contato">
                          <option value="Celular">Celular</option> 
                          <option value="Residencial">Residencial</option> 
                          <option value="Comercial">Comercial</option> 
                          <option value="Cobrança">Cobrança</option> 
                          <option value="Recado">Recado</option> 
                          <option value="Outros">Outros</option> 
                        </select>
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label>DDD</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_contatos['ddd']" id="ddd">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>Número</label>
                        <input type="text" class="form-control form-control-sm" name="pessoas_contatos['telefone']" id="telefone">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group" style="padding-top: 10px;">
                        <label></label>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="whatsapp" name="pessoas_contatos['']" value="1" checked>
                          <label class="custom-control-label" for="whatsapp" name="pessoas_contatos['']">WhatsApp</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
        <div class="modal-footer justify-content-between">
          <a class="btn btn-default" data-bs-dismiss="modal">Fechar</a>
          <a class="btn btn-success float-right" style="color:white" onclick="pessoa_gravar()" id="btn_pessoa_gravar">Cadastrar</a>
        </div>
      </div>
    </div>
  </form>
</div>
@include('sistema.atendimentos.pessoas.auxiliares.mod_contato')

@push('js')
<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  inputMasksActivate()
})

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
  var url = url.replace(':idd', {{ $pessoa->id ?? null }});

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    if(response.data.type == 'error')
    {
      toastrjs(response.data.type, response.data.message )
      $("#btn_pessoa_gravar").addClass('disabled');
      $("[name='"+item.name+"']").removeClass('is-warning');
      $("[name='"+item.name+"']").removeClass('is-valid');
      $("[name='"+item.name+"']").addClass('is-invalid');
    }
    else
    {
      $("[name='"+item.name+"']").removeClass('is-warning');
      $("[name='"+item.name+"']").removeClass('is-invalid');
      $("[name='"+item.name+"']").addClass('is-valid');
      $("#btn_pessoa_gravar").removeClass('disabled');
    }


    // if(valor == 'instagram')
    // {
    //   let foto_perfil = $("#foto_perfil").val();
    //   $("#profile_picture").attr('src', foto_perfil);
    //   toastrjs('success', 'Foto do perfil atualizada.')
    //   $("#instagram_address").attr('href', 'https://www.instagram.com/'+instagram);
    // }
  })
@include('includes.catch', [ 'codigo_erro' => '7323549a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '7647733a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '4713572a' ] )
}

function pessoa_avatar_gravar()
{
  const formData = new FormData();
  const imagefile = document.querySelector('#image');
  formData.append("image", imagefile.files[0]);

  let dados = $('#form_clientes_adicionar_avatar');
  // let dados = $('#form_clientes_adicionar_avatar').serialize();

  axios.post('{{ route('atd.pessoas.avatar') }}', formData,
  {
    headers:
    {
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(function(response)
  {
    // console.log(response)
    imagem = $('#foto_temp').val(response.data);
    $("#profile_picture").attr('src', response.data );
  })
@include('includes.catch', [ 'codigo_erro' => '4946863a' ] )
  .then()
  {
    $('#foto_enviar').hide();
    $('#foto_cancelar').show();
  }
}

function pessoas_avatar_remove()
{
  foto = {
    temp_foto: $('#foto_temp').val()
  };

  axios.post('{{ route('atd.pessoas.avatar_remove') }}', foto)
  .then(function(response)
  {
    // console.log(response)
    imagem = $('#foto_temp').val('');
    $("#profile_picture").attr('src', $('#foto_padrao').val() );
  })
@include('includes.catch', [ 'codigo_erro' => '1208784a' ] )
  .then()
  {
    $('#foto_enviar').show();
    $('#foto_cancelar').hide();
  }
}
</script>
@endpush
