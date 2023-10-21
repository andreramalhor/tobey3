<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($vendedores as $vendedor)
    <option value="{{ $vendedor->id }}">{{ $vendedor->apelido }}</option>
    @endforeach
</x-adminlte.form.input.select>
