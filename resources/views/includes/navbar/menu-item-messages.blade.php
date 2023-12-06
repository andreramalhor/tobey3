 {{-- 
@if(\Schema::hasTable('frm_contatos'))
  <li class="nav-item dropdown" id="messages_nav-menu">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
      <i class="far fa-envelope"></i>
    </a>
  </li>
 --}}

  @push('js')
  <script type="text/javascript">
    $(document).ready(function()
    {
      mensagens_ler()
    })

    function mensagens_ler()
    {
      axios.get("{{ route('frm.mensagens.widget') }}")
      .then( function(response)
      {
        // console.log(response.data)
        $('#messages_nav-menu').empty().append(response.data)
      })
      @include('includes.catch', [ 'codigo_erro' => '5143065a' ] )
    }
    
    setInterval(() => {
      mensagens_ler()
    }, 300000)
  </script>
  @endpush
{{-- 
@endif
 --}}
