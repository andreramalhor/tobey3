<div class="{{ $cols ?? col-12 }}">
  <div class="form-group">
    <label for="col-form-label">{{ $label ?? 'LABEL' }}</label>
    <div class="input-group">
      @if(isset($prepend))
      <div class="input-group-prepend">
        <span class="input-group-text" onclick="{{ $click ?? '' }}"><i class="{{ $prepend['icon'] ?? 'fas fa-square' }}"></i></span>
      </div>
      @endif
      <select class="form-control form-control-sm selec-2" name="{{ $name ?? 'NAME' }}" id="{{ $id ?? $name ?? 'ID' }}">
        <option>Carregando . . .</option>
      </select>
      @if(isset($append))
      <div class="input-group-append">
        <span class="input-group-text" onclick="{{ $click ?? '' }}"><i class="{{ $append['icon'] ?? 'fas fa-square' }}"></i></span>
      </div>
      @endif
    </div>
  </div>
</div>

@push('js')
<script>
  var url = "{{ route("$rota") }}";

  axios.get(url)
  .then(function(response)
  {
    console.log(response.data)
    $('#{{ $id ?? $name ?? "ID" }}').empty().append('<option value="0">Selecione ...</option>')
    
    collect(response.data).each((value, key) =>
    {
      $('#{{ $id ?? $name ?? "ID" }}').append('<option value="'+key+'">'+value+'</option>')
    })
    
    $('#{{ $id ?? $name ?? "ID" }}').val('{{ $value ?? "" }}').trigger('change');
    $('#{{ $id ?? $name ?? "ID" }}').val('{{ $value ?? "" }}').trigger('change');
    $('#{{ $id ?? $name ?? "ID" }}').select2({width: '80%'});
  })
@include('includes.catch', [ 'codigo_erro' => '5340470a' ] )
</script>
@endpush