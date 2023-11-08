<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($pessoas as $comp_pessoa)
        <option {{ !is_null($selecionado) && $selecionado == $comp_pessoa->id ? 'selected' : '' }} value="{{ $comp_pessoa->id }}">{{ $comp_pessoa->apelido }}</option>
    @endforeach
</x-adminlte.form.input.select>
