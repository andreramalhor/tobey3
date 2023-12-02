<div class="col-sm-{{ $col ?? 12 }}">
    <div class="form-group">
        <label>&nbsp;</label><br/>
        <div class="form-check">
            <input
                type="checkbox"
                {{ $attributes->merge(['class' => '']) }} @error('{{ $name }}') is-invalid @enderror
                id="{{ $name }}"
                wire:model.live="{{ $name }}"
                {{ $attributes }}
                @if(isset($valor)) value="{{ $valor }}" @endif
                @if(isset($checked)) checked="checked" @endif
            >
            <label class="" for="{{ $name }}">&nbsp;{{ $label ?? '' }}</label>
        </div>
    </div>
</div>
