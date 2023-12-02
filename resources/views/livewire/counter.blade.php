<div>
    <h1>{{ $count }}</h1>

    <div class="col-sm-2">
        <div class="form-group">
            <label>vlr_compra {{ $count }}</label>
            <input type="text" class="form-control form-control-sm" wire:model="count">

        </div>
    </div>


    <button wire:click="increment">+</button>
    <button wire:click="decrement">-</button>
</div>
