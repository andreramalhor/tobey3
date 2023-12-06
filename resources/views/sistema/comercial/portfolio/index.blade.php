@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Portfolio de Cursos</h3>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
              Cursos <span class="caret"></span>
            </a>
            <div class="dropdown-menu">
              @forelse($portfolio as $port)
                <a class="dropdown-item" tabindex="-1" onclick="mostrar_portfolio('{{ $port->slug }}')">{{ $port->titulo }}</a>
              @empty
                <a class="dropdown-item" tabindex="-1" href="{{ route('com.portfolio.adicionar') }}">Adicionar o primeiro</a>
              @endforelse
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" tabindex="-1" href="{{ route('com.portfolio.adicionar') }}">Adicionar Novo</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div id="conteudo"></div>
      </div>
    </div> 
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

function mostrar_portfolio( slug )
{
  $('#overlay-portfolio').show();

  var url = "{{ route('com.portfolio.mostrar', ':slug') }}";
  var url = url.replace(':slug', slug);
  
  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#conteudo').empty().append(response.data);
  })
  @include('includes.catch', [ 'codigo_erro' => '2341662a' ] )
  .then( function(response)
  {
    setTimeout(function() {
      $('#overlay-portfolio').hide();
    }, 500);
  })}
</script>
@endsection
