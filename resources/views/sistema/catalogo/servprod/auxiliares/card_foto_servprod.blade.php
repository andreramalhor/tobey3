<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Foto do {{ $tipo == 'produtos' ? 'Produto' : 'Serviço' }}</h3>
  </div>
  <div class="card-body d-flex flex-column">
    <form id="form_clientes_adicionar_avatar" onsubmit="return false">
    @csrf
      <div id="actions" class="row">
        <div class="row" style="margin-bottom: 20px;">
          <div class="col-12">
            <div class="widget-user-header">
              <div class="widget-user-image text-center">
                @php $url = asset('img/catalogo/servsprods/0.png') @endphp
                <input type="hidden" name="imagem_padrao" id="imagem_padrao" value="{{ $url }}">
                <img class="img-circle elevation-1" src="{{ asset('img/catalogo/servsprods/'.($servprod->id ?? 0).'.png') }}" height="155px" id="profile_picture">
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
          <div class="col-lg-12">
            <div class="btn-group w-100">
              <span class="btn btn-success col fileinput-button dz-clickable" onchange="servprod_avatar_gravar('{{ $tipo }}')" id="imagem_enviar">
                <input type="file" name="image" id="image" class="btn btn-success col fileinput-button dz-clickable">
                {{-- <i class="fas fa-plus"></i> --}}
              </span>
            </div>
            
            {{-- <span class="btn btn-primary col start" onclick="servprod_gravar_avatar()"> --}}
              {{-- <i class="fas fa-upload"></i> --}}
            {{-- </span> --}}
              
            <div class="btn-group w-100">
              <button type="reset" class="btn btn-warning col cancel" id="imagem_cancelar" onclick="servprod_avatar_remove('{{ $tipo }}')" style="display:none;">
                <i class="fas fa-times-circle"></i>
              </button>
            </div>
          </div>
        </div>
{{--               <div class="row" style="margin-bottom: 20px;">
          <div class="col-lg-12 d-flex align-items-center">
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

<script>
function servprod_avatar_gravar(tipo)
{
  const formData = new FormData();
  const imagefile = document.querySelector('#image');
  formData.append("image", imagefile.files[0]);
  
  var url = "{{ route('cat.servprod.avatar', ':tipo') }}";
  var url = url.replace(':tipo', tipo);

  let dados = $('#form_clientes_adicionar_avatar');
  // let dados = $('#form_clientes_adicionar_avatar').serialize();

  axios.post(url, formData,
  {
    headers:
    {
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(function(response)
  {
    // console.log(response)
    $('#imagem_temp').val(response.data);
    $("#profile_picture").attr('src', response.data );
  })
@include('includes.catch', [ 'codigo_erro' => '1755920a' ] )
  .then()
  {
    $('#imagem_enviar').hide();
    $('#imagem_cancelar').show();
  }
}

function pessoas_avatar_remove()
{
  foto = {
    temp_foto: $('#imagem_temp').val()
  };

  axios.post('{{ route('atd.pessoas.avatar_remove') }}', foto)
  .then(function(response)
  {
    // console.log(response)
    $('#imagem_servprod').val('');
    $("#profile_picture").attr('src', $('#imagem_padrao').val() );
  })
@include('includes.catch', [ 'codigo_erro' => '6210462a' ] )
  .then()
  {
    $('#imagem_enviar').show();
    $('#imagem_cancelar').hide();
  }
}

function servprod_avatar_gravar2(tipo)
{
  const formData = new FormData();
  const imagefile = document.querySelector('#image');
  
  formData.append("image", imagefile.files[0]);

  var url = "{{ route('cat.servprod.avatar', ':tipo') }}";
  var url = url.replace(':tipo', tipo);

  let dados = $('#form_servsprods_adicionar_avatar');
  // let dados = $('#form_servsprods_adicionar_avatar').serialize();

  axios.post(url, formData,
  {
    headers:
    {
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(function(response)
  {
    // console.log(response)
    $('#imagem_temp').val(response.data);
    $("#servprod_picture").attr('src', response.data );
  })
@include('includes.catch', [ 'codigo_erro' => '4892180a' ] )
  .then()
  {
    $('#imagem_enviar').hide();
    $('#imagem_cancelar').show();
  }
}

function servprod_avatar_remove(tipo)
{
  var url = "{{ route('cat.servprod.avatar_remove', ':tipo') }}";
  var url = url.replace(':tipo', tipo);

  foto = {
    temp_foto: $('#imagem_temp').val()
  };

  axios.post(url, foto)
  .then(function(response)
  {
    // console.log(response)
    $('#imagem_temp').val('');
    $("#servprod_picture").attr('src', $('#imagem_padrao').val() );
  })
@include('includes.catch', [ 'codigo_erro' => '7542171a' ] )
  .then()
  {
    $('#imagem_enviar').show();
    $('#imagem_cancelar').hide();
  }
}
</script>