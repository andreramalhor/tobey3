<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-partials.head :title=" $title ?? '' " />
    </head>
    <body class="container mx-auto bg-gray-800">
        
        <x-banner />
        
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <x-partials.nav />
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <div class="grid grid-cols-3 gap-6 p-4">
                <div class="bg-blue-700 col-span-3">
                    @livewire('ferramenta.tarefa')
                </div>
                <div class="bg-red-700 p-4"></div>
                <div class="bg-orange-700 p-4"></div>
            </div>
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        @livewireScripts
    </body>
</html>
