<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($categorias as $categoria)
        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
    @endforeach
</x-adminlte.form.input.select>
