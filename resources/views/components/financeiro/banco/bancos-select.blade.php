<x-adminlte.form.input.select {{ $attributes }} >
    @foreach($bancos as $banco)
        <option value="{{ $banco->id }}">{{ $banco->nome }}</option>
    @endforeach
</x-adminlte.form.input.select>