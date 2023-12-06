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
            
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="vert-tabs-home-tab" data-bs-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Home</a>
                <a class="nav-link" id="vert-tabs-profile-tab" data-bs-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="vert-tabs-messages-tab" data-bs-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="vert-tabs-settings-tab" data-bs-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Settings</a>
              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                </div>
                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                  Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                </div>
                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                  Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                </div>
                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                  Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
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
@include('includes.catch', [ 'codigo_erro' => '8580728a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '6074235a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '6250716a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '3011893a' ] )
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
@include('includes.catch', [ 'codigo_erro' => '9167723a' ] )
  .then()
  {
    $('#foto_enviar').show();
    $('#foto_cancelar').hide();
  }
}
</script>
@endpush
