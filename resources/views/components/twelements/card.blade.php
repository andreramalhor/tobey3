<div class="block rounded-lg bg-white text-center text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white">
  <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">
    @if (isset($cabecalho))
      {{  $cabecalho ?? 'Cabeçalho' }}
    @endif
  </div>
  <div class="p-6">
    {{  $slot }}
  </div>
  <div class="border-t-2 border-neutral-100 px-6 py-3 text-surface/75 dark:border-white/10 dark:text-neutral-300">
    {{  $rodape ?? 'Rodapé' }}
  </div>
</div>
