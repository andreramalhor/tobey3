<div class="col-{{ $colunas ?? 12 }}">
  <div class="form-group">
    <label>{{ $label ?? 'LABEL' }}</label>
    <input type="number" class="form-control form-control-sm" name="{{ $name ?? 'NAME' }}" id="{{ $id ?? 'ID' }}" value="{{ $value ?? $default_value ?? null }}" step="0.01">
  </div>
</div>
