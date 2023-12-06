<form id="pessoas_form">
  <input type="hidden" name="id_criador" value="{{ \Auth::User()->id }}">
  <input type="hidden" name="id_empresa" value="{{ \Auth::User()->id_empresa }}">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title pb-0">Adicionar nova pessoa</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body pt-0">
    <div class="accordion" id="pessoas-accordion">
      <div class="card navbar-{{ env('APP_COLOR') }}">
        <div class="card-header">
          <h4 class="card-title w-100">
            <a class="d-block w-100 text-white collapsed" data-bs-toggle="collapse" href="#dados-pessoais" aria-expanded="false">Dados pessoais</a>
          </h4>
        </div>
        <div id="dados-pessoais" class="collapse show" data-bs-parent="#pessoas-accordion">
          <div class="card-body card-comments">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <label class="text-black">CPF / CNPJ</label>
                <input type="text" class="form-control form-control-sm cpf" name="cpf" onchange="validarCPF(this)">
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label class="text-black">Nome Completo<font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm " name="nome" onchange="validar(this)">
              </div>
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <label class="text-black">Apelido<font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="apelido" onchange="validar(this)">
              </div>
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <label class="text-black">Data de Nascimento</label>
                <input type="date" class="form-control form-control-sm" name="dt_nascimento" value="">
              </div>
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <label class="text-black">Sexo</label>
                <select class="form-control form-control-sm" name="sexo">
                  <option value="">Não Informado</option>
                  <option value="F">Feminino</option>
                  <option value="M">Masculino</option>
                </select>
              </div>
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label class="text-black">e-Mail</label>
                <input type="mail" class="form-control form-control-sm" name="email" onchange="validar(this)">
              </div>
              
              @if(optional(\Auth::User()->klwqejqlkwndwiqo)->nome != 'Instituto Embelleze Caratinga')
              <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <label class="text-black">Observação</label>
                <input type="text" class="form-control form-control-sm" name="observacao">
              </div>
              @else
              <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <label class="text-black">Observação</label>
                <input type="text" class="form-control form-control-sm" name="observacao">
              </div>
              @endif
              
              @if(optional(\Auth::User()->klwqejqlkwndwiqo)->nome != 'Instituto Embelleze Caratinga')
              <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                <label class="text-black">ID RS School</label>
                <input type="text" class="form-control form-control-sm" name="id_rsschool">
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card navbar-{{ env('APP_COLOR') }}">
        <div class="card-header">
          <h4 class="card-title w-100">
            <a class="d-block w-100 text-white collapsed" data-bs-toggle="collapse" href="#enderecos" aria-expanded="false">Endereços</a>
          </h4>
        </div>
        <div id="enderecos" class="collapse" data-bs-parent="#pessoas-accordion">
          <div class="card-body card-comments" id="pessoas_enderecos_accordion">
            <div class="row card-comment" id="pessoas_enderecos_linha_0">
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <div class="form-group">
                  <label class="text-black">Tipo</label>
                  <select class="form-control form-control-sm" name="pessoas_enderecos[0][tipo_endereco]">
                    <option value="Residencial">Residencial</option> 
                    <option value="Comercial">Comercial</option> 
                    <option value="Cobrança">Cobrança</option> 
                    <option value="Recado">Recado</option> 
                    <option value="Outros">Outros</option> 
                  </select>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <div class="form-group">
                  <label class="text-black">CEP</label>
                  <input type="text" class="form-control form-control-sm cep" name="pessoas_enderecos[0][cep]" onblur="buscar_endereco_cep( this )">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                <div class="form-group">
                  <label class="text-black">Número</label>
                  <input type="text" class="form-control form-control-sm" name="pessoas_enderecos[0][numero]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <div class="form-group">
                  <label class="text-black">Compl.</label>
                  <input type="text" class="form-control form-control-sm" name="pessoas_enderecos[0][complemento]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <div class="form-group">
                  <label class="text-black">Logradouro</label>
                  <input type="text" class="form-control form-control-sm" name="pessoas_enderecos[0][logradouro]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                  <label class="text-black">Bairro</label>
                  <input type="text" class="form-control form-control-sm" name="pessoas_enderecos[0][bairro]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                  <label class="text-black">Cidade</label>
                  <input type="text" class="form-control form-control-sm" name="pessoas_enderecos[0][cidade]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label class="text-black">Estado</label>
                  <select class="form-control form-control-sm" name="pessoas_enderecos[0][uf]">
                    <option value="">Selecione . . .</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option> 
                  </select>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                <div class="form-group">
                  <label style="display: block;">&emsp;</label>
                  <a class="btn btn-sm btn-danger float-end d-none" id="pessoas_enderecos_remover_0" onclick="pessoas_enderecos_remover( 0 )"><i class="fas fa-minus"></i></a>
                  <a class="btn btn-sm btn-success float-end" id="pessoas_enderecos_adicionar_0" onclick="pessoas_enderecos_adicionar( 1 )"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card navbar-{{ env('APP_COLOR') }}">
        <div class="card-header">
          <h4 class="card-title w-100">
            <a class="d-block w-100 text-white" data-bs-toggle="collapse" href="#contatos">Telefones</a>
          </h4>
        </div>
        <div id="contatos" class="collapse" data-bs-parent="#pessoas-accordion">
          <div class="card-body card-comments" id="pessoas_contatos_accordion">
            <div class="row card-comment" id="pessoas_contatos_linha_0">
              <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <div class="form-group">
                  <label class="text-black">Tipo</label>
                  <select class="form-control form-control-sm" name="pessoas_contatos[0][tipo_contato]">
                  <option value="Celular">Celular</option> 
                      <option value="Residencial">Residencial</option> 
                      <option value="Comercial">Comercial</option> 
                      <option value="Cobrança">Cobrança</option> 
                      <option value="Recado">Recado</option> 
                      <option value="Outros">Outros</option> 
                  </select>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                <div class="form-group">
                  <label class="text-black">DDD</label>
                  <input type="text" class="form-control form-control-sm ddd" name="pessoas_contatos[0][ddd]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label class="text-black">Número</label>
                  <input type="text" class="form-control form-control-sm telefone" name="pessoas_contatos[0][telefone]">
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group" style="padding-top: 10px;">
                  <label class="text-black"></label>
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input"  name="pessoas_contatos[0][whatsapp]" id="whatsapp_0" name="" value="1" checked>
                    <label class="custom-control-label text-black" for="whatsapp_0" name="">WhatsApp</label>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="form-group">
                  <label style="display: block;">&emsp;</label>
                  <a class="btn btn-sm btn-danger float-end d-none" id="pessoas_contatos_remover_0" onclick="pessoas_contatos_remover( 0 )"><i class="fas fa-minus"></i></a>
                  <a class="btn btn-sm btn-success float-end" id="pessoas_contatos_adicionar_0" onclick="pessoas_contatos_adicionar( 1 )"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card navbar-{{ env('APP_COLOR') }}">
        <div class="card-header">
          <h4 class="card-title w-100">
            <a class="d-block w-100 text-white" data-bs-toggle="collapse" href="#foto-perfil">Foto Perfil</a>
          </h4>
        </div>
        <div id="foto-perfil" class="collapse" data-bs-parent="#pessoas-accordion">
          <div class="card-body card-comments">
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-12">
                <div class="widget-user-header">
                  <div class="widget-user-image text-center">
                    @php $url = asset('img/atendimentos/pessoas/0.png') @endphp
                    <input type="hidden" name="imagem[imagem_padrao]" value="{{ $url }}">
                    <input type="hidden" name="imagem[foto_temp]" value="">
                    <img class="img-circle elevation-1" src="{{ $url }}" height="155px" id="pessoa_picture">
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-6 offset-3">
                <div class="btn-group w-100">
                  <span class="btn btn-success col fileinput-button dz-clickable" onchange="pessoa_avatar_gravar()" id="spam_enviar">
                    <input type="file" name="imagem[image]" class="btn btn-success col fileinput-button dz-clickable">
                  </span>
                </div>
                <div class="btn-group w-100">
                  <span class="btn btn-warning col cancel d-none" onclick="pessoas_avatar_remove()" id="spam_remover">
                    <i class="fas fa-times-circle"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between pt-3">
      <a class="btn btn-default" data-bs-dismiss="offcanvas" onclick="pessoas_avatar_remove()">Cancelar</a>
      <a class="btn btn-success disabled" id="pessoas_gravar" onclick="pessoa_gravar()">Gravar</a>
    </div>
  </div>
</form>

<script type="text/javascript">
$(window).on('shown.bs.offcanvas', function()
{
  inputMasksActivate()
})
  
$("[name='nome']").on('change', function (e)
{
  let nome = (e.target.value).split(" ")
  let ulti = (nome.length) - 1
  let apelido = nome[0]+" "+nome[ulti]
  if (ulti == 0)
  {
    $("[name='apelido']").val(nome[0])
  }
  else
  {
    $("[name='apelido']").val(apelido)
    $("[name='apelido']").change()
  }
})

function validar(item)
{
  let valor = item.value
  let campo = item.name

  var dados = {
    valor: valor,
    campo: campo,
  }
  
  var url = "{{ route('atd.pessoas.validar', ':idd') }}"
  var url = url.replace(':idd', {{ $pessoa->id ?? null }})

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    if(response.data.type == 'error')
    {
      toastrjs(response.data.type, response.data.message )
      $("#pessoas_gravar").addClass('disabled')
      $("[name='"+item.name+"']").removeClass('is-warning')
      $("[name='"+item.name+"']").removeClass('is-valid')
      $("[name='"+item.name+"']").addClass('is-invalid')
    }
    else
    {
      $("[name='"+item.name+"']").removeClass('is-warning')
      $("[name='"+item.name+"']").removeClass('is-invalid')
      $("[name='"+item.name+"']").addClass('is-valid')
      $("#pessoas_gravar").removeClass('disabled')
    }
  })
  @include('includes.catch', [ 'codigo_erro' => '8580728a' ] )
}

function validarCPF(field)
{
  valor = (field).value
  valor = valor.replace(/[^0-9]/g, '')

  if ( valor.length === 11 )
  {
    if(valor.length == 0)
    {
      $("[name='cpf']").removeClass('is-invalid')
      $("[name='cpf']").removeClass('is-valid')
      $("[name='cpf']").addClass('is-warning')
      toastrjs('warning', 'O CPF será salvo como "Não preenchido".')
      $("[name='cpf']").val('')
    }
    else if(valor == "00000000000" || valor == "11111111111" || valor == "22222222222" || valor == "33333333333" || valor == "44444444444" || valor == "55555555555" || valor == "66666666666" || valor == "77777777777" || valor == "88888888888" || valor == "99999999999")
    {
      $("[name='cpf']").removeClass('is-invalid')
      $("[name='cpf']").removeClass('is-valid')
      $("[name='cpf']").addClass('is-warning')
      toastrjs('warning', 'O CPF será salvo como "Não preenchido".')
      $("[name='cpf']").val('')
    }
    else
    {
      valida_cpf( valor )
    }
  }
  else if ( valor.length === 14 ) 
  {
    valida_cnpj( valor )
  } 
  else
  {
    $("[name='cpf']").removeClass('is-valid')
    $("[name='cpf']").removeClass('is-invalid')
    $("[name='cpf']").addClass('is-warning')
    toastrjs('warning', 'CPF/CNPJ Inválido.')
    return false
  }
  validar( field )
}

function calc_digitos_posicoes( digitos, posicoes = 10, soma_digitos = 0 )
{
  digitos = digitos.toString()
  
  for ( var i = 0; i < digitos.length; i++  )
  {
    soma_digitos = soma_digitos + ( digitos[i] * posicoes )

    posicoes--

    if ( posicoes < 2 )
    {
      posicoes = 9
    }
  }

  soma_digitos = soma_digitos % 11

  if ( soma_digitos < 2 )
  {
    soma_digitos = 0
  }
  else
  {
    soma_digitos = 11 - soma_digitos
  }

  var cpf = digitos + soma_digitos

  return cpf;  
}

function valida_cpf( valor )
{
  var digitos = valor.substr(0, 9)
  var novo_cpf = calc_digitos_posicoes( digitos )
  var novo_cpf = calc_digitos_posicoes( novo_cpf, 11 )

  if ( novo_cpf === valor )
  {
    $("[name='cpf']").removeClass('is-warning')
    $("[name='cpf']").removeClass('is-invalid')
    $("[name='cpf']").addClass('is-valid')
    toastrjs('success', 'CPF Válido.')
    return true
  }
  else
  {
    $("[name='cpf']").removeClass('is-valid')
    $("[name='cpf']").removeClass('is-warning')
    $("[name='cpf']").addClass('is-invalid')
    toastrjs('error', 'CPF Inválido.')
    return false
  } 
}

function valida_cnpj( valor )
{
  var cnpj_original = valor

  var primeiros_numeros_cnpj = valor.substr( 0, 12 )

  var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 )

  var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 )

  var cnpj = segundo_calculo

  if ( cnpj === cnpj_original )
  {
    $("[name='cpf']").removeClass('is-warning')
    $("[name='cpf']").removeClass('is-invalid')
    $("[name='cpf']").addClass('is-valid')
    toastrjs('success', 'CNPJ Válido.')
    return true
  }
  
  $("[name='cpf']").removeClass('is-valid')
  $("[name='cpf']").removeClass('is-warning')
  $("[name='cpf']").addClass('is-invalid')
  toastrjs('error', 'CNPJ Inválido.')
  return false
}

// =================================================================================================================================== ENDEREÇO
pessoas_enderecos_indice = 0

function buscar_endereco_cep( campo )
{
  let valor = campo.value
  
  //Nova variável "cep" somente com dígitos.
  let cep = valor.replace(/\D/g, '')
  
  //Verifica se campo cep possui valor informado.
  if (cep != "")
  {
    //Expressão regular para validar o CEP.
    let validacep = /^[0-9]{8}$/
    
    //Valida o formato do CEP.
    if(validacep.test(cep))
    {
      //Preenche os campos com "..." enquanto consulta webservice.
      $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][logradouro]']").val("...")
      $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][bairro]']").val("...")
      $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][cidade]']").val("...")
      $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][uf]']").val("...")

      //Cria um elemento javascript.
      let script = document.createElement('script')
      
      //Sincroniza com o callback.
      script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback'
      
      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script)
    }
    else
    {
      //cep é inválido.
      limpa_formulário_cep()
      toastrjs('success', 'Formato de CEP inválido.')
    }
  }
  else
  {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep()
  }
}

function meu_callback(conteudo)
{
  if (!("erro" in conteudo))
  {
    //Atualiza os campos com os valores.
    $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][logradouro]']").val(conteudo.logradouro)
    $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][bairro]']").val(conteudo.bairro)
    $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][cidade]']").val(conteudo.localidade)
    $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][uf]']").val(conteudo.uf)
  }
  else
  {
    //CEP não Encontrado.
    limpa_formulário_cep()
    toastrjs('success', 'CEP não encontrado.')
  }
}

function limpa_formulário_cep()
{
  //Limpa valores do formulário de cep.
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][logradouro]']").val("")
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][bairro]']").val("")
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][numero]']").val("")
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][complemento]']").val("")
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][cidade]']").val("")
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][uf]']").val("")
}

function pessoas_enderecos_adicionar( indice )
{
  $("#pessoas_enderecos_adicionar_"+pessoas_enderecos_indice).addClass('d-none');
  $("#pessoas_enderecos_remover_"+pessoas_enderecos_indice).removeClass('d-none');

  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][tipo_endereco]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][cep]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][logradouro]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][bairro]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][numero]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][complemento]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][cidade]']").attr('readonly', true);
  $("[name='pessoas_enderecos["+pessoas_enderecos_indice+"][uf]']").attr('readonly', true);

  pessoas_enderecos_indice = indice

  $("#pessoas_enderecos_accordion").append(
    '<div class="row card-comment" id="pessoas_enderecos_linha_'+pessoas_enderecos_indice+'">'+
      '<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">'+
        '<div class="form-group">'+
          '<label class="text-black">Tipo</label>'+
          '<select class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][tipo_endereco]">'+
            '<option value="Residencial">Residencial</option>'+
            '<option value="Comercial">Comercial</option>'+
            '<option value="Cobrança">Cobrança</option>'+
            '<option value="Recado">Recado</option>'+
            '<option value="Outros">Outros</option>'+
          '</select>'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">'+
        '<div class="form-group">'+
          '<label class="text-black">CEP</label>'+
          '<input type="text" class="form-control form-control-sm cep" name="pessoas_enderecos['+pessoas_enderecos_indice+'][cep]" onblur="buscar_endereco_cep( this )">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">'+
        '<div class="form-group">'+
          '<label class="text-black">Número</label>'+
          '<input type="text" class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][numero]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">'+
        '<div class="form-group">'+
          '<label class="text-black">Compl.</label>'+
          '<input type="text" class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][complemento]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">'+
        '<div class="form-group">'+
          '<label class="text-black">Logradouro</label>'+
          '<input type="text" class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][logradouro]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">'+
        '<div class="form-group">'+
          '<label class="text-black">Bairro</label>'+
          '<input type="text" class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][bairro]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">'+
        '<div class="form-group">'+
          '<label class="text-black">Cidade</label>'+
          '<input type="text" class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][cidade]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">'+
        '<div class="form-group">'+
          '<label class="text-black">Estado</label>'+
          '<select class="form-control form-control-sm" name="pessoas_enderecos['+pessoas_enderecos_indice+'][uf]">'+
            '<option value="">Selecione . . .</option>'+
            '<option value="AC">Acre</option>'+
            '<option value="AL">Alagoas</option>'+
            '<option value="AP">Amapá</option>'+
            '<option value="AM">Amazonas</option>'+
            '<option value="BA">Bahia</option>'+
            '<option value="CE">Ceará</option>'+
            '<option value="DF">Distrito Federal</option>'+
            '<option value="ES">Espírito Santo</option>'+
            '<option value="GO">Goiás</option>'+
            '<option value="MA">Maranhão</option>'+
            '<option value="MT">Mato Grosso</option>'+
            '<option value="MS">Mato Grosso do Sul</option>'+
            '<option value="MG">Minas Gerais</option>'+
            '<option value="PA">Pará</option>'+
            '<option value="PB">Paraíba</option>'+
            '<option value="PR">Paraná</option>'+
            '<option value="PE">Pernambuco</option>'+
            '<option value="PI">Piauí</option>'+
            '<option value="RJ">Rio de Janeiro</option>'+
            '<option value="RN">Rio Grande do Norte</option>'+
            '<option value="RS">Rio Grande do Sul</option>'+
            '<option value="RO">Rondônia</option>'+
            '<option value="RR">Roraima</option>'+
            '<option value="SC">Santa Catarina</option>'+
            '<option value="SP">São Paulo</option>'+
            '<option value="SE">Sergipe</option>'+
            '<option value="TO">Tocantins</option>'+
          '</select>'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">'+
        '<div class="form-group">'+
          '<label style="display: block;">&emsp;</label>'+
          '<a class="btn btn-sm btn-danger float-end d-none" id="pessoas_enderecos_remover_'+pessoas_enderecos_indice+'" onclick="pessoas_enderecos_remover( '+pessoas_enderecos_indice+' )"><i class="fas fa-minus"></i></a>'+
          '<a class="btn btn-sm btn-success float-end" id="pessoas_enderecos_adicionar_'+pessoas_enderecos_indice+'" onclick="pessoas_enderecos_adicionar( '+ ( pessoas_enderecos_indice + 1 ) +' )"><i class="fas fa-plus"></i></a>'+
        '</div>'+
      '</div>'+
    '</div>'
  )

  inputMasksActivate()
}

function pessoas_enderecos_remover( indice )
{
  $("#pessoas_enderecos_linha_"+indice).remove()
}


// =================================================================================================================================== CONTATO
pessoas_contatos_indice = 0


function pessoas_contatos_adicionar( indice )
{
  $("#pessoas_contatos_adicionar_"+pessoas_contatos_indice).addClass('d-none');
  $("#pessoas_contatos_remover_"+pessoas_contatos_indice).removeClass('d-none');

  $("[name='pessoas_contatos["+pessoas_contatos_indice+"][tipo_contato]']").attr('readonly', true);
  $("[name='pessoas_contatos["+pessoas_contatos_indice+"][ddd]']").attr('readonly', true);
  $("[name='pessoas_contatos["+pessoas_contatos_indice+"][telefone]']").attr('readonly', true);
  $("[name='pessoas_contatos["+pessoas_contatos_indice+"][whatsapp]']").attr('readonly', true);

  pessoas_contatos_indice = indice

  $("#pessoas_contatos_accordion").append(
    '<div class="row card-comment" id="pessoas_contatos_linha_'+pessoas_contatos_indice+'">'+
      '<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">'+
        '<div class="form-group">'+
          '<label class="text-black">Tipo</label>'+
          '<select class="form-control form-control-sm" name="pessoas_contatos['+pessoas_contatos_indice+'][tipo_contato]">'+
          '<option value="Celular">Celular</option>'+
              '<option value="Residencial">Residencial</option>'+
              '<option value="Comercial">Comercial</option>'+
              '<option value="Cobrança">Cobrança</option>'+
              '<option value="Recado">Recado</option>'+
              '<option value="Outros">Outros</option>'+
          '</select>'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">'+
        '<div class="form-group">'+
          '<label class="text-black">DDD</label>'+
          '<input type="text" class="form-control form-control-sm ddd" name="pessoas_contatos['+pessoas_contatos_indice+'][ddd]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">'+
        '<div class="form-group">'+
          '<label class="text-black">Número</label>'+
          '<input type="text" class="form-control form-control-sm telefone" name="pessoas_contatos['+pessoas_contatos_indice+'][telefone]">'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">'+
        '<div class="form-group" style="padding-top: 10px;">'+
          '<label class="text-black"></label>'+
          '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">'+
            '<input type="checkbox" class="custom-control-input"  name="pessoas_contatos['+pessoas_contatos_indice+'][whatsapp]" id="whatsapp_'+pessoas_contatos_indice+'" name="" value="1" checked>'+
            '<label class="custom-control-label text-black" for="whatsapp_'+pessoas_contatos_indice+'" name="">WhatsApp</label>'+
          '</div>'+
        '</div>'+
      '</div>'+
      '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">'+
        '<div class="form-group">'+
          '<label style="display: block;">&emsp;</label>'+
          '<a class="btn btn-sm btn-danger float-end d-none" id="pessoas_contatos_remover_'+pessoas_contatos_indice+'" onclick="pessoas_contatos_remover( '+pessoas_contatos_indice+' )"><i class="fas fa-minus"></i></a>'+
          '<a class="btn btn-sm btn-success float-end" id="pessoas_contatos_adicionar_'+pessoas_contatos_indice+'" onclick="pessoas_contatos_adicionar( '+ ( pessoas_contatos_indice + 1 ) +' )"><i class="fas fa-plus"></i></a>'+
        '</div>'+
      '</div>'+
    '</div>'
  )

  inputMasksActivate()
}

function pessoas_contatos_remover( indice )
{
  $("#pessoas_contatos_linha_"+indice).remove()
}

// =================================================================================================================================== AVATAR
function pessoa_avatar_gravar()
{
  const formData = new FormData()
  const imagefile = $("[name='imagem[image]']")[0]

  formData.append("image", imagefile.files[0])

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
    $("[name='imagem[foto_temp]']").val(response.data)
    $("#pessoa_picture").attr('src', response.data )
  })
  @include('includes.catch', [ 'codigo_erro' => '3011893a' ] )
  .then()
  {
    $('#spam_enviar').addClass('d-none')
    $('#spam_remover').removeClass('d-none')
  }
}

function pessoas_avatar_remove()
{
  foto = {
    temp_foto: $("[name='imagem[foto_temp]']").val()
  }

  axios.post('{{ route('atd.pessoas.avatar_remove') }}', foto)
  .then(function(response)
  {
    // console.log(response)
    $("[name='imagem[foto_temp]']").val('')
    $("#pessoa_picture").attr('src', '{{ $url }}' )
    $("[name='imagem[image]']").val('')
  })
  @include('includes.catch', [ 'codigo_erro' => '9167723a' ] )
  .then()
  {
    $('#spam_enviar').removeClass('d-none')
    $('#spam_remover').addClass('d-none')
  }
}

// =================================================================================================================================== GRAVAR
function pessoa_gravar()
{
  let dados = $('#pessoas_form').serialize()

  axios.post('{{ route('atd.pessoas.gravar') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    pessoas_avatar_remove()
    $('#offcanva-geral-'+id_cnv).offcanvas('hide')
    toastrjs(response.data.type, response.data.message )
    {{ $destino }}
  })
  @include('includes.catch', [ 'codigo_erro' => '6250716a' ] )
}
</script>
