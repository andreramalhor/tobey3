<div {{ $attributes->merge(['class' => 'alert alert-'.$tipo]) }} role="alert">
    {{ $texto }}
    <p>{{ $mensagem }}</p>


    @if(isset($nomes))
        @forelse($nomes('rafael') as $nome)
            <p class="text-danger">{{ $nome }}</p>
        @empty
            <p>sem nomes</p>
        @endforelse
    @endif

    <p>{{ $slot }}</p>

    <p>{{ $novoslot ?? null }}</p>
</div>
