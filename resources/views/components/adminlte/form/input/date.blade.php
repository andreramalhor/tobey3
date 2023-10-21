<div class="col-sm-{{ $col ?? 12 }}">
    <div class="form-group">
        @if(isset($label))
        <label for="{{ $name }}">{{ $label ?? '' }}</label>
        @endif
        <input type="date" class="form-control form-control-sm @error('{{ $name }}') is-invalid @enderror" wire:model="{{ $name }}" {{ $attributes }} />
        @error('{{ $name }}')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
    </div>
</div>
