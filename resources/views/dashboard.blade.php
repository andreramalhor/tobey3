<x-app-layout>
     <x-slot name="heaer">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="row">
        <div class="col-3">
            <livewire:Ferramenta.Tarefa />
        </div>
    </div>

    <!-- can('Financeiro.Visualizar') -->
    @can('Saócios')
    <div class="row">
        <div class="col-12">
            <livewire:Financeiro.Lancamento.ChartAnual />
        </div>
    </div>
    @endcan

    <div class="row">
        <div class="col-6">
            <livewire:Comercial.Lead.Graficos.ChartCadastro />
        </div>
        <div class="col-6">
            <livewire:Comercial.Lead.Graficos.ChartAtendimento />
        </div>
    </div>

</x-app-layout>
