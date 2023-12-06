@extends('layouts.app')

@section('content')
<form method="POST" id="form_clientes_editar" autocomplete="off">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Mensagem: {{ $mensagem->area }}</h3>
        </div>
        <div class="card-body">
          
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <label class="col-form-label">Mensagem</label>
              <textarea class="form-control form-control-sm" name="mensagem" id="mensagem" rows="4">{{ $mensagem->mensagem }}</textarea>
            </div>
          </div>
          
          <hr>
          
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <label class="col-form-label">Campos personalizáveis</label>

          <div id="mensagens-accordion">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title w-100">
                  <a class="d-block w-100 collapsed" data-bs-toggle="collapse" href="#pessoa" aria-expanded="false">Pessoa</a>
                </h4>
              </div>
              <div id="pessoa" class="collapse show" data-bs-parent="#mensagens-accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-id')">
                        #ID:<br>
                        <strong>
                          {{ \Auth::User()->id }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-apelido')">
                        Apelido:<br>
                        <strong>
                          {{ \Auth::User()->apelido }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-nome')">
                        Nome:<br>
                        <strong>
                          {{ \Auth::User()->nome }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-dt_nascimento')">
                        Data de nascimento:<br>
                        <strong>
                          {{ \Carbon\Carbon::parse(\Auth::User()->dt_nascimento)->format('d/m/Y') }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-sexo')">
                        Sexo:<br>
                        <strong>
                          {{ \Auth::User()->sexo }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-cpf')">
                        CPF ou CNPJ:<br>
                        <strong>
                          {{ \Auth::User()->cpf }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-email')">
                        e-Mail:<br>
                        <strong>
                          {{ \Auth::User()->email }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-observacao')">
                        Observação:<br>
                        <strong>
                          {{ \Auth::User()->observacao }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-instagram')">
                        Instagram:<br>
                        <strong>
                          {{ \Auth::User()->instagram }}
                        </strong>
                      </a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title w-100">
                  <a class="d-block w-100" data-bs-toggle="collapse" href="#endereco">Endereço</a>
                </h4>
              </div>
              <div id="endereco" class="collapse" data-bs-parent="#mensagens-accordion">
                <div class="card-body">
                  <div class="row">
              
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-tipo')">
                        Tipo de Endereço:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->tipo_endereco }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-cep')">
                        CEP:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->cep }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-numero')">
                        Número:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->numero }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-complemento')">
                        Complemento:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->complemento }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-logradouro')">
                        Logradouro:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->logradouro }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-bairro')">
                        Bairro:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->bairro }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-cidade')">
                        Cidade:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->cidade }}
                        </strong>
                      </a>
                    </div>
                    
                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-endereco-estado')">
                        Estado:<br>
                        <strong>
                          {{ optional(\Auth::User()->uqbchiwyagnnkip->first())->uf }}
                        </strong>
                      </a>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title w-100">
                  <a class="d-block w-100" data-bs-toggle="collapse" href="#contato">Contato</a>
                </h4>
              </div>
              <div id="contato" class="collapse" data-bs-parent="#mensagens-accordion">
                <div class="card-body">
                  <div class="row">

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-contato-tipo')">
                        Tipo de Telefone:<br>
                        <strong>
                          {{ optional(\Auth::User()->ginthgfwxbdhwtu->first())->tipo_contato }}
                        </strong>
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-contato-ddd')">
                        DDD:<br>
                        <strong>
                          {{ optional(\Auth::User()->ginthgfwxbdhwtu->first())->ddd }}
                        </strong>
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-contato-numero')">
                        Número:<br>
                        <strong>
                          {{ optional(\Auth::User()->ginthgfwxbdhwtu->first())->telefone }}
                        </strong>
                      </a>
                    </div>

                    </div>
                </div>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title w-100">
                  <a class="d-block w-100" data-bs-toggle="collapse" href="#agendamento">Agendamento</a>
                </h4>
              </div>
              <div id="agendamento" class="collapse" data-bs-parent="#mensagens-accordion">
                <div class="card-body">
                  <div class="row">

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-agendamento-data')">
                        Data:<br>
                        <strong>
                        {{ \Carbon\Carbon::parse(optional(\Auth::User()->iemzmwadhadlask->first())->start)->format('d/m/Y') }}
                        </strong>
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-agendamento-inicio')">
                        Início:<br>
                        <strong>
                        {{ \Carbon\Carbon::parse(optional(\Auth::User()->iemzmwadhadlask->first())->start)->format('h:i') }}
                        </strong>
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-agendamento-ate')">
                        Até:<br>
                        <strong>
                        {{ \Carbon\Carbon::parse(optional(\Auth::User()->iemzmwadhadlask->first())->end)->format('h:i') }}
                        </strong>
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-agendamento-profissional')">
                        Profissional:<br>
                        <strong>
                          {{ optional(optional(\Auth::User()->iemzmwadhadlask->first())->hhmaqpijffgfhmj)->apelido }}
                        </strong>Profissional
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-agendamento-servico')">
                        Serviço:<br>
                        <strong>
                          {{ optional(optional(\Auth::User()->iemzmwadhadlask->first())->zlpekczgsltqgwg)->nome }}
                        </strong>
                      </a>
                    </div>

                    <div class="col-2">
                      <a class="btn btn-app btn-block p-1 text-truncate" onclick="incluir_palavra_chave('atd-pessoa-agendamento-status')">
                        Status:<br>
                        <strong>
                          {{ optional(\Auth::User()->iemzmwadhadlask->first())->status }}
                        </strong>
                      </a>
                    </div>
                              
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          @if($mensagem->area == 'Aniversário')

          @else($mensagem->area == 'Agendamento (criação)')

      
          
          

        
          @endif


        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <a href="{{ route('cfg.mensagens') }}" class="btn btn-secondary">Cancelar</a>
              <a class="btn btn-success float-right" style="color:white" onclick="pessoa_editar()">Editar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<br>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function()
{
  $('#mensagem').summernote({
    height: 300, // altura em pixels
    plainText: true,
    toolbar: [
      ['font', ['bold', 'italic', 'underline']],
    ],
  })
})

function incluir_palavra_chave( campo )
{
  var textarea = $('#mensagem')[0];
 
  var palavra = ':'+campo;

  // Verifica se o textarea está selecionado
  if (textarea.selectionStart || textarea.selectionStart === 0)
  {
    var startPos = textarea.selectionStart;
    var endPos = textarea.selectionEnd;

    // Insere a palavra na posição do cursor
    textarea.value = textarea.value.substring(0, startPos) + palavra + textarea.value.substring(endPos, textarea.value.length);
  }
  else
  {
    // Caso o cursor não esteja selecionado, insere a palavra no final do texto
    textarea.value += palavra;
  }
}

function pessoa_editar()
{
  var url = "{{ route('cfg.mensagens.atualizar', ':idd') }}";
  var url = url.replace(':idd', {{ $mensagem->id }});

  let dados = $('#form_clientes_editar').serialize();

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '1353553a' ] )
}
</script>
@endsection
