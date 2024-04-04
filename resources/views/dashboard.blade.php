<x-app-layout>
     <x-slot name="header">
<<<<<<< HEAD
        {{ __('DashboZard') }}
        ssd
    </x-slot>

    aa
{{--
=======
        {{ __('Dashboard') }}
    </x-slot>
{{-- 
>>>>>>> 8428816add10968a479eabcad98f2b865b768ead
    <div class="row">
        <div class="col-4">
            <livewire:Ferramenta.Tarefa />
        </div>
        
        <div class="col-8">
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
    

    <div class="row">
        <div class="card card-secondary card-outline card-outline-tabs p-0">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="col-2 pt-2">
                        <h3 class="card-title">Card Title</h3>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-bs-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-bs-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-bs-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-bs-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-3">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}

</x-app-layout>
