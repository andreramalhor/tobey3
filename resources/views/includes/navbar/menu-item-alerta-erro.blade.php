{{-- 
@if(\Schema::hasTable('frm_erros'))
<form id="informar_erro">
  <li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
      <i class="fa-solid fa-triangle-exclamation"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
      <input type="hidden" name="id_usuario" value="{{ \Auth::User()->id }}">
      <input type="hidden" name="lastCopiled" value="{{ json_encode($this->lastCompiled) }}">
      <input type="hidden" name="currentPath" value="{{ $this->currentPath }}">
      <input type="hidden" name="route" value="{{ url()->current() }}">
      <input type="hidden" name="status" value="Em Aberto">
      <div class="card-body p-2">
        <div class="form-group m-0">
          <label class="mb-1">Informar erro</label>
          <textarea class="form-control p-1" style="font-size: inherit;" rows="4" name="descricao" placeholder="Descreva o erro ..."></textarea>
        </div>
      </div>   
      <div class="card-footer">  
        <a class="btn btn-primary float-end" style="cursor:pointer;" onclick="informar_erro()">Reportar</a>
      </div>
    </div>
  </li>
</form>

@push('js')
<script type="text/javascript">
  function informar_erro()
  {    
    axios.post("{{ route('frm.erros.informar') }}", $('#informar_erro').serialize())
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message);
    })
@include('includes.catch', [ 'codigo_erro' => '3105399a' ] )
    .then( function()
    {
      $('#informar_erro')[0].reset()
    })
  }  
</script>
@endpush

@endif

 --}}