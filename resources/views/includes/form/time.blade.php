<div class="col-{{ $colunas ?? 12 }}">
  <div class="form-group">
    <label>{{ $label ?? 'LABEL' }}</label>
    <input type="time" class="form-control form-control-sm" name="{{ $name ?? 'NAME' }}" id="{{ $id ?? 'ID' }}" value="{{ $value ?? $default_value ?? null }}">
  </div>
</div>
