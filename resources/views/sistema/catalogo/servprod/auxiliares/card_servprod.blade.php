<div class="card">
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <input type="hidden" name="imagem_temp" id="imagem_temp" value="">
  <div class="card-header">
    <h3 class="card-title">Dados do {{ $tipo == 'produtos' ? 'Produto' : 'Serviço' }}</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="form-group">
          <label class="col-form-label">Tipo</label>
          <div class="input-group">
            <select class="form-control form-control-sm select2" name="tipo">
              <option value="Serviço" {{ (isset($servprod->tipo) && $servprod->tipo == 'Serviço') ? 'selected' : '' }}>Serviço</option>
              <option value="Produto" {{ (isset($servprod->tipo) && $servprod->tipo == 'Produto') ? 'selected' : '' }}>Produto</option>
              {{-- <option value="Consumo" {{ (isset($servprod->tipo) && $servprod->tipo == 'Consumo') ? 'selected' : '' }}>Consumo</option> --}}
            </select>
          </div>
        </div>
      </div>
    
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
          <label class="col-form-label">Nome<font color="red">*</font></label>
          <input type="text" class="form-control form-control-sm" name="nome" value="{{ $servprod->nome ?? '' }}">
        </div>
      </div>
    
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="form-group">
          <label class="col-form-label">Categoria</label><font color="red">*</font></label>
          <div class="input-group">
            <select class="form-control form-control-sm" name="id_categoria">
              <option>Carregando . . .</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
        <div class="form-group">
          <label class="col-form-label">Descrição</label>
          <input type="text" class="form-control form-control-sm" name="descricao" value="{{ $servprod->descricao ?? '' }}">
        </div>
      </div>

      <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="form-group">
          <label class="col-form-label">Duração</label>
          <input type="time" class="form-control form-control-sm" name="duracao" value="{{ $servprod->duracao ?? '' }}">
        </div>
      </div>
      
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 produto d-none">
        <div class="form-group">
          <label class="col-form-label">Marca</label>
          <input type="text" class="form-control form-control-sm" name="marca" value="{{ $servprod->marca ?? '' }}">
        </div>
      </div>
      
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 produto d-none">
        <div class="form-group">
          <label class="col-form-label">Código da Nota Fiscal</label>
          <input type="text" class="form-control form-control-sm" name="cod_nota" value="{{ $servprod->cod_nota ?? '' }}">
        </div>
      </div>
      
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 produto d-none">
        <div class="form-group">
          <label class="col-form-label">Código de Barras</label>
          <input type="text" class="form-control form-control-sm" name="cod_barras" value="{{ $servprod->cod_barras ?? '' }}">
        </div>
      </div>

    </div>
  </div>
</div>

@push('js')
<script>
var url = "{{ route('cat.categorias.plucar') }}";

axios.get(url)
.then(function(response)
{
  // console.log(response.data)
  $('[name="id_categoria"]').empty().append('<option>Selecione ...</option>')
  collect(response.data).each((value, key) =>
  {
    $('[name="id_categoria"]').append('<option value="'+key+'">'+value+'</option>')
  })
})
@include('includes.catch', [ 'codigo_erro' => '321571a' ] )
// .then(function()
// {
  // $('[name="id_categoria"]').select2()
// })
</script>
@endpush
