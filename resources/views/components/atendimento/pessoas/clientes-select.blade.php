<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($clientes as $cliente)
        <option value="{{ $cliente->id }}">{{ $cliente->apelido }}</option>
    @endforeach
</x-adminlte.form.input.select>
