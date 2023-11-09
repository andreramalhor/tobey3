<x-app-layout>
     <x-slot name="heaer">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="row">
        <div class="col-3">
            <livewire:Ferramenta.Tarefa />
        </div>

        <div class="col-9">
            @can('Saócios')
            <livewire:Financeiro.Lancamento.ChartAnual />
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <livewire:Comercial.Lead.Graficos.ChartCadastro />
        </div>
        <div class="col-6">
            <livewire:Comercial.Lead.Graficos.ChartAtendimento />
        </div>
    </div>


    <div class="row">
        <x-adminlte.card.card>
            <x-slot name="overlay">

            <div class="overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
                <h3 class="card-title">Loading state</h3>
            </div>
            <div class="card-body">
                The body of the card
            </div>
            <div class="card-footer">
                footer
            </div>
        </x-adminlte.card.card>
    </div>

    @php($mensagem=2734)
    <x-beerandcode texto="O texto do alerta" :mensagem="$mensagem" class="text-right" tipo="success">
        <strong>Esse é um slot</strong>
        <x-slot name=novoslot>
            Esse é o segundo slot
        </x-slot>
    </x-beerandcode>

</x-app-layout>
