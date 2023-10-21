<div class="card">
  
  <x-adminlte.card.overlay />
  
  <x-adminlte.card.header titulo="{{ $titulo ?? Título }}" />
  
  <x-adminlte.card.body>
    {{ $slot }}
  </x-adminlte.card.body>
  
  @if(1==2)
  <x-adminlte.card.footer botao="Fechar" />
  @endif
  
</div>