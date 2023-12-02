<div class="col-sm-{{ $col ?? 12 }}" {{ $attributes }}>
    <div class="form-group">
        @if(isset($label))
        <label for="{{ $name }}">{{ $label ?? '' }}</label>
        @endif
        <select class="form-control form-control-sm {{ $select2 ?? '' }} @error('{{ $name }}') is-invalid @enderror" wire:model="{{ $name }}" {{ $attributes }} id="{{ $name }}">
            <option>{{ $placeholder ?? 'Selecione. . .'}}</option>
            {{ $slot }}
        </select>
        @error('{{ $name }}')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
    </div>
</div>
