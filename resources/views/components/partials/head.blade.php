<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>
  {{ isset($title) ? config('app.name', 'Laravel') . ' | '. $title : '' }}
</title>

<!-- Fonts -->
@stack('stylesheet')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Styles -->
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

<!-- Scripts -->
{{-- <script src="{{  asset('js/app.js') }}" defer></script> --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

@livewireStyles
