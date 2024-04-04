<section class="w-1/2 p-4 mx-auto space-y-4 shadow">
  <h2 class="text-sm text-indigo-500 uppercase">
    criar lançamento
  </h2>

  <form wire:submit.prevent="store" class="space-y-4">
    <div class="space-y-4">
      <x-label form="informacao" value="{{ __('informacao') }}" />
      <x-input wire:model.debounce.500ms="informacao" class="block w-full" name="informacao" id="informacao" type="text" />
      <x-input-error for="informacao" />
    </div>

    <div class="space-y-4">
      <x-label form="tipo" value="{{ __('tipo') }}" />
      <x-input wire:model.debounce.500ms="tipo" class="block w-full" name="tipo" id="tipo" type="text" />
      <x-input-error for="tipo" />
    </div>

    <x-button wire:target="store" wire:loading.attr="disabled" type="submit" disabled='disabled' class="primary">
      Cadastrar
    </x-button>
  </form>
</section>