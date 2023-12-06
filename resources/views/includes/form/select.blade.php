<div class="col-{{ $colunas ?? 12 }}">
  <div class="form-group">
    <label>{{ $label ?? 'LABEL' }}</label>
    <select class="form-control form-control-sm" name="{{ $name ?? 'NAME' }}" id="{{ $id ?? 'ID' }}">
      <option>Selecione . . .</option>
      {{-- <option value="-1" selected="selected">Select an option</option> --}}
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