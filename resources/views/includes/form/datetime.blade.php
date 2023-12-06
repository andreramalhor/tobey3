<div class="col-{{ $colunas ?? 12 }}">
  <div class="form-group">
    <label>{{ $label ?? 'LABEL' }}</label>
    <input type="datetime-local" class="form-control form-control-sm" name="{{ $name ?? 'NAME' }}" id="{{ $id ?? 'ID' }}" value="{{ $value ?? null }}">
  </div>
</div>
