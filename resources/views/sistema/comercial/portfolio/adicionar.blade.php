@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Adicionar Novo Portfolio</h3>
      </div>
      <div class="card-body">
        <div class='row'>
          <div class='col-12'>
            <div class='form-group'>
              <label>Título</label>
              <input type="text" class='form-control form-control-sm' name='titulo' id='titulo'>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='col-12'>
            <div class='form-group'>
              <textarea id="summernote">Olá. Adicione aqui as informações desejadas.</textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('com.portfolio') }}" class="btn btn-secondary">Cancelar</a>
        <a class="btn btn-success float-right" onclick="enviar()">Adicionar</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function()
{
  $('#summernote').summernote({
    height: 300 // altura em pixels
  })
})

function enviar()
{
  var url = "{{ route('com.portfolio.create') }}";  
  var conteudo = $('#summernote').summernote('code');

  dados = {
    conteudo : conteudo,
    titulo   : $('#titulo').val(),
  }

  axios.post(url, dados)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '9834572a' ] )
}
</script>
@endsection
