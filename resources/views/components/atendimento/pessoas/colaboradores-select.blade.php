<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($colaboradores as $colaborador)
    <option value="{{ $colaborador->id }}">{{ $colaborador->apelido }}</option>
    @endforeach
</x-adminlte.form.input.select>
