.catch(function(error)
{
  {{-- toastrjs('error', error.response.data.message, true); --}}

  if ( error.response !== undefined )
  {
    if ( error.response.status >= 100 && error.response.status <= 199 )
    {
      {{-- Informacional --}}
      toastrjs('error', 'O cliente que a solicitação foi recebida e está sendo processada. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Informacional')
    }
    else if ( error.response.status >= 200 && error.response.status <= 299 )
    {
      {{-- Sucesso --}}
      toastrjs('error', 'A solicitação foi bem-sucedida e foram devolvidos os recursos solicitados. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Sucesso')
    }
    else if ( error.response.status >= 300 && error.response.status <= 399 )
    {
      {{-- Redirecionamento --}}
      toastrjs('error', 'A solicitação foi redirecionada para outra URL, geralmente porque o recurso solicitado foi movido ou renomeado. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Redirecionamento')
    }
    else if ( error.response.status >= 400 && error.response.status <= 499 )
    {
      {{-- Erro do cliente --}}
      {{-- toastrjs('error', 'A solicitação não pode ser processada devido a um erro do cliente, como uma solicitação malformada ou uma tentativa de acessar um recurso não autorizado. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Erro do cliente') --}}
      
      if ( error.response.status == 401 )
      {
        {{-- 401 Unauthorized: O cliente não forneceu credenciais de autenticação válidas para acessar o recurso solicitado. --}}
        {{--
          Estava no arquivo:  C:\laragon\www\tobey\resources\views\includes\navbar\menu-item-messages.blade.php
          Quanto passa o tempo de login, e a pessoa desloga, automaticamente joga a pessoa para a tela HOME
          forçando a fazer login novamente.
        --}}
        toastrjs('error', 'Você será redirecionado para a tela de autenticação. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true)
        window.location.href = "{{ url('/home') }}"
      }
      else if ( error.response.status == 403 )
      {
        toastrjs('error', 'O cliente não tem permissão para acessar o recurso solicitado. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Forbidden')
      }
      else if ( error.response.status == 404 )
      {
        toastrjs('error', 'O recurso solicitado não foi encontrado no servidor. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Not Found')
      }
      else if ( error.response.status === 422 )
      {
        $.each(error.response.data.errors, function (i, msg)
        {
          var el = $(document).find('[name="'+i+'"]')
          el.addClass('is-invalid')
          toastrjs('error', msg)
        })
      }
    }
    else if ( error.response.status >= 500 && error.response.status <= 599 )
    {
      {{-- Erro do servidor --}}
      {{-- toastrjs('error', 'A solicitação não pode ser processada devido a um erro no servidor, como uma falha no banco de dados ou um erro de programação. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Erro do servidor') --}}
  
      if ( error.response.status == 500 )
      {
        console.log(error.response)
        toastrjs('error', error.response.data.message, true);
        toastrjs('error', 'O servidor encontrou um erro interno e não pôde processar a solicitação. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Internal Server Error')
      }
      else if ( error.response.status == 503 )
      {
        toastrjs('error', 'O servidor está temporariamente indisponível devido a sobrecarga ou manutenção. - Cód: {{ $codigo_erro ?? 'codigo_erro não informado' }}', true, 'Service Unavailable')
      }
      else
      {
        toastrjs('error', '{{ $codigo_erro ?? 'codigo_erro não informado' }}', true );
      }
    }
    else
    {
      console.log(error.response)
      toastrjs('error', error.response.data.message, true);
      toastrjs('error', '{{ $codigo_erro ?? 'codigo_erro não informado' }}', true );
    }
  }

  return Promise.reject(error);
})

