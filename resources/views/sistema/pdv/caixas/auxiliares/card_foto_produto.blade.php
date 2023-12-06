<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Foto do Produto</h3>
  </div>
  <div class="card-body d-flex flex-column">
    <form id="form_clientes_adicionar_avatar" onsubmit="return false">
          <div id="actions" class="row">
        <div class="row" style="margin-bottom: 20px;">
          <div class="col-12">
            <div class="widget-user-header">
              <div class="widget-user-image text-center">
                @php $url = asset('img/catalogo/produtos/0.png') @endphp
                <input type="hidden" name="imagem_padrao" id="imagem_padrao" value="{{ $url }}">
                <img class="img-circle elevation-1" src="{{ asset('img/catalogo/produtos/'.($produto->id ?? 0).'.png') }}" height="155px" id="produto_picture">
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
          <div class="col-lg-12">
            <div class="btn-group w-100">
              <span class="btn btn-success col fileinput-button dz-clickable" onchange="produto_avatar_gravar()" id="imagem_enviar">
                <input type="file" name="image" id="image" class="btn btn-success col fileinput-button dz-clickable">
                {{-- <i class="fas fa-plus"></i> --}}
              </span>
            </div>
            
            {{-- <span class="btn btn-primary col start" onclick="produto_gravar_avatar()"> --}}
              {{-- <i class="fas fa-upload"></i> --}}
            {{-- </span> --}}
            <div class="btn-group w-100">
              <button type="reset" class="btn btn-warning col cancel" id="imagem_cancelar" onclick="produtos_avatar_remove()" style="display:none;">
                <i class="fas fa-times-circle"></i>
              </button>
            </div>
          </div>
        </div>
        {{-- 
        <div class="row" style="margin-bottom: 20px;">
          <div class="col-lg-12 d-flex align-items-center">
            <div class="fileupload-process w-100">
              <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
              </div>
            </div>
          </div>
        </div>
        --}}
      </div>
      <div class="table table-striped files" id="previews"></div>
    </form>
  </div>
</div>