<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- AdminLTE Template -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css"/>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/styles/overlayscrollbars.min.css"/> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"  rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,300,0,-25"  rel="stylesheet" />
        <link href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('assets/fullcalendar/lib/main.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fullcalendar-scheduler/lib/main.min.css') }}">
        
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <!-- Styles -->
        @stack('css')
        @livewireStyles
    </head>
    <body class="pace-done sidebar-collapse text-sm accent-dark vsc-initialized text-sm"> <!-- sidebar-mini adicionar essa classe para aparecer -->
        <x-banner />
        <div class="wrapper">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ url('stg/img/empresa/logo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div>
            @include('layouts.parts.navbar')
            @include('layouts.parts.aside')

            <div class="content-wrapper">
                <!-- <section class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{ $header ?? 'Definir Header' }}</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">{{ $header ?? 'Definir Header' }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section> -->

                <section class="content pt-3">
                    <div class="container-fluid">
                        @yield('content')

                        {{ $slot ?? '' }}
                    </div>
                </section>
            </div>
            {{-- <footer class="main-footer">
                <strong>Copyright &copy; 2023 <a href="https://instagram.com/andreramalhor">André Ramalho</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Versão </b>5.1.0
                </div>
            </footer> --}}
            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>

        <!-- AdminLTE Template-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script> -->
        <!-- <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/overlayscrollbars.cjs.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
        <!-- <script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script> -->
        <!-- <script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.1/accounting.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.34.3/collect.min.js"></script>

        <script src="{{ asset('assets/fullcalendar/lib/main.min.js') }}"></script>
        <script src="{{ asset('assets/fullcalendar/lib/locales/pt-br.js') }}"></script>
        <script src="{{ asset('assets/fullcalendar-scheduler/lib/main.min.js') }}"></script>
        <script src="{{ asset('assets/fullcalendar-scheduler/lib/locales/pt-br.js') }}"></script>
 
        <script>
            $(document).ready(function()
            {
                $('.select2').select2();
            });
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            function toastrjs(type = 'warning', msg = 'Mensagem master', confirm = false, title = null)
            {
                if(confirm)
                {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-bottom-full-width",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": 0,
                        "extendedTimeOut": 0,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        
                        "allowHtml": true,
                        "tapToDismiss": false,
                        // "onclick": function(toast) {
                        //     value = toast.target.id
                        //     if (value == 'yes')
                        //     {
                        //         console.log(toast.target.value, 'deu certo')
                        //         alert('onclick')
                        //         return 'deu certo';
                        //     }
                        // },
                        // "onCloseClick": function(toast)
                        // {
                        //     return false
                        // },
                    }
                }
                else
                {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "3000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                    }
                    
                }
                
                Command: toastr[type](msg, title)
            }
            
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
            
            function inputMasksActivate()
            {
                $(".cpf").inputmask(
                {
                    mask: ["999.999.999-99", "99.999.999/9999-99"],
                    keepStatic: true,
                    greedy: false
                })
                
                $(".dinheiro").inputmask(
                {
                    alias          : 'numeric',
                    digits         : 2,
                    groupSeparator : '.',
                    radixPoint     : ',',
                    digitsOptional : false,
                    allowPlus      : true,
                    allowMinus     : true,
                    prefix         : '',
                    placeholder    : '0,00',
                })
                
                $(".percentual").inputmask(
                {
                    alias          : 'numeric',
                    digits         : 2,
                    radixPoint     : ',',
                    digitsOptional : false,
                    prefix         : '',
                    placeholder    : '0'
                })
                
                $(".cep").inputmask(
                {
                    mask: ["99999-999"]
                })
                
                $(".ddd").inputmask(
                {
                    mask: ["99"]
                })
                
                $(".telefone").inputmask(
                {
                    mask: ["9999-9999", "[9]9999-9999"]
                })
                
                // alias: "percentage",
                // digits: "2",
                // rightAlign: false,
                // suffix: "%",
                // integerDigits: 5,
                // digitsOptional: true,
                // allowPlus: true,
                // allowMinus: true,
                // placeholder: "0",
                // min: -1000,
                // max: 1000,
                // numericInput: true // se o cursos vai pro inicio ou se fica após a virgula
            }

            window.addEventListener('swal:alert', event => {
                Swal.fire({
                    title              : event.detail[0].title,
                    text               : event.detail[0].text,
                    icon               : event.detail[0].icon,
                    iconColor          : event.detail[0].iconColor,
                    showConfirmButton  : false,
                    timer              : 1500,
                })
            });
            
            window.addEventListener("swal:confirm", event => {
                Swal.fire({
                    title              : event.detail[0].title,
                    text               : event.detail[0].text,
                    icon               : event.detail[0].icon,
                    iconColor          : event.detail[0].iconColor,
                    confirmButtonText  : 'Sim, remover!',
                    confirmButtonColor : '#3085d6',
                    cancelButtonText   : 'Cancelar',
                    cancelButtonColor  : '#d33',
                    showCancelButton   : true,
                }).then((result) => {
                    if (result.isConfirmed)
                    {
                        Livewire.dispatch(event.detail[0].function || 'chamarMetodo', { id: event.detail[0].idEvent });
                    }
                })
            });
            
            function aplicarMascaras()
            {
                var input_telefone = $('.telefone')
                var mask_telefone  = new Inputmask('(99) 99999-9999')
                for (const telefoneInput of input_telefone) {
                    mask_telefone.mask(telefoneInput)
                }
                
                var input_cep = $('.cep')
                var mask_cep  = new Inputmask('99.999-999')
                for (const cepInput of input_cep) {
                    mask_cep.mask(cepInput)
                }

                var input_tempo = $('.tempo')
                var mask_tempo  = new Inputmask({
                    mask: '99:99:99',
                    placeholder: 'hh:mm:ss',  // Substitua 'hh:mm:ss' pelo seu placeholder desejado                    
                })
                for (const tempoInput of input_tempo) {
                    mask_tempo.mask(tempoInput)
                }
                
                var input_percentual = $('.percentual')
                var mask_percentual  = new Inputmask({
                    alias: 'numeric',
                    suffix: '%',
                    groupSeparator: '.', 
                    radixPoint: ',',
                    rightAlign: false,
                    autoUnmask: true,
                    min: 0,
                    max: 100,
                    step: 0.01,  // Defina o passo desejado para valores decimais
                    allowMinus: false,
                    allowPlus: false,
                    placeholder: '0',
                });
                for (const percentualInput of input_percentual) {
                    mask_percentual.mask(percentualInput)
                }

                var input_dinheiro = $('.dinheiro')
                var mask_dinheiro  = new Inputmask({
                    alias: 'currency',
                    prefix: 'R$ ',        // ou o símbolo da moeda desejado
                    suffix: '',           // Sufixo opcional (por exemplo, para o Brasil, o padrão é uma string vazia)
                    groupSeparator: '.',  // Separador de milhares
                    radixPoint: ',',      // Ponto decimal
                    autoUnmask: true,     // Remove automaticamente os caracteres de máscara ao focar
                    rightAlign: false,    // Alinha o texto à esquerda
                });
                for (const dinheiroInput of input_dinheiro) {
                    mask_dinheiro.mask(dinheiroInput)
                }
                
                var input_data = $('.data')
                var mask_data = new Inputmask({
                    alias: "datetime",
                    inputFormat: "dd/mm/aaaa"
                })
                for (const dataInput of input_data) {
                    mask_data.mask(dataInput)
                }
            }
            
            document.addEventListener('DOMContentLoaded', function () {
                aplicarMascaras();
            });
            
            window.addEventListener('mask:apply', function (event)
            {
                setTimeout(function () {
                    aplicarMascaras();
                }, 100);
            });
            


        </script>
        
        @stack('modals')
        @stack('js')
        @yield('js') {{-- // feito por andre para adaptacao do sistema antigo tobey --}}

        
        @include('includes.modal.modal-geral-1')
        @include('includes.modal.modal-geral-2')
        @include('includes.modal.modal-geral-3')
        @include('includes.modal.modal-geral-4')
        @include('includes.modal.modal-geral-5')
        @include('includes.modal.modal-geral-6')
        @include('includes.modal.modal-geral-7')
        @include('includes.modal.modal-geral-8')
        @include('includes.modal.modal-geral-9')
        @include('includes.modal.modal-geral-10')

        @include('includes.offcanva.offcanva-geral-1')
        @include('includes.offcanva.offcanva-geral-2')
        @include('includes.offcanva.offcanva-geral-3')
        @include('includes.offcanva.offcanva-geral-4')
        @include('includes.offcanva.offcanva-geral-5')
        @include('includes.offcanva.offcanva-geral-6')
        @include('includes.offcanva.offcanva-geral-7')
        @include('includes.offcanva.offcanva-geral-8')
        @include('includes.offcanva.offcanva-geral-9')
        @include('includes.offcanva.offcanva-geral-10')
            
            <script>

                var id_mdl = 1

                $('.modal')
                .on({
                    'show.bs.modal': function()
                    {
                        id_mdl = document.getElementsByClassName('modal show').length + 1
                        console.log('show:' + id_mdl)
                        // var id_mdl = $('.modal:visible').length
                        // abrirModal(id_mdl)
                        // $(this).css('z-index', 1040 + (10 * id_mdl))
                    },
                    'shown.bs.modal': function()
                    {
                        id_mdl = id_mdl + 1
                        console.log('showN:' + id_mdl)
                        // var id_mdl = ($('.modal:visible').length) - 1 // raise backdrop after animation.
                        // $('.modal-backdrop').not('.stacked')
                        //      .css('z-index', 1039 + (10 * id_mdl))
                        //      .addClass('stacked')
                    },
                    'hidden.bs.modal': function()
                    {
                        id_mdl = id_mdl - 1
                        console.log('hidden:' + id_mdl)

                        // if ($('.modal:visible').length > 0)
                        // {
                            // restore the modal-open class to the body element, so that scrolling works
                            // properly after de-stacking a modal.
                            // setTimeout(function() {
                                // $(document.body).addClass('modal-open')
                            // }, 0)
                        // }
                    }
                })

                function vendas_mostrar_modal( id )
                {
                    var url = "{{ route('pdv.vendas.modal', ':idd') }}";
                    var url = url.replace(':idd', id);
                    
                    axios.get(url)
                    .then( function(response)
                    {
                        // console.log(response)
                        $('#modal-geral-'+id_mdl).empty().append(response.data)
                    })
                    @include('includes.catch', [ 'codigo_erro' => '4442629a' ] )
                    .then( function()
                    {
                        $('#modal-geral-'+id_mdl).modal('show')
                    })
                }

                function pessoas_mostrar( id )
                {
                    var url = "{{ route('atd.pessoas.modal', ':idd') }}";
                    var url = url.replace(':idd', id);
                    
                    axios.get(url)
                    .then( function(response)
                    {
                        // console.log(response)
                        $('#modal-geral-'+id_mdl).empty().append(response.data)
                    })
                    @include('includes.catch', [ 'codigo_erro' => '2197354a' ] )
                    .then( function()
                    {
                        $('#modal-geral-'+id_mdl).modal('show')
                    })
                }

            </script>

        @livewireScripts
    </body>
</html>
