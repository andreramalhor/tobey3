<div class="col-{{ $colunas ?? 12 }}">
  <div class="form-group">
    <label>{{ $label ?? 'LABEL' }}</label>
    <select class="form-control form-control-sm {{ isset($slc2) ? 'select2' : '' }} select2" name="{{ $name ?? 'NAME' }}" id="{{ $id ?? 'ID' }}">
      <option>Selecione . . .</option>
      @if(!is_array($options))
        @foreach($options as $option)
          <option value="{{ $option->id }}">{{ $option->nome }}</option>
        @endforeach
      @else
        @foreach($options as $key => $option)
          <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
      @endif
    </select>
  </div>
</div>