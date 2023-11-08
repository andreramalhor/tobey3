<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($pessoas as $pessoa)
        <option value="{{ $pessoa->id }}">{{ $pessoa->apelido }}</option>
    @endforeach
</x-adminlte.form.input.select>
