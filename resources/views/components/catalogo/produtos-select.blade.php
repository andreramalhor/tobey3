<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($produtos as $produto)
        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
    @endforeach
</x-adminlte.form.input.select>
