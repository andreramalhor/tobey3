<div class="col-{{ $colunas ?? 12 }}">
	@if(!$sem_label)
		<div class="form-group" @if(isset($style)) style="{{ $style }}" @endif>
			<label></label>
	@endif
	<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
		<input type="checkbox" class="custom-control-input" id="{{ $id }}" name="{{ $name ?? null }}" @if($value ?? false) checked @endif value="1">
		<label class="custom-control-label" for="{{ $id }}" name="{{ $name ?? null }}">{{ $label ?? 'LABEL' }}</label>
	</div>
	@if(!$sem_label)
		</div>
	@endif
</div>


