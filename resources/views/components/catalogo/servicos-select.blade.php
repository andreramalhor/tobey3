<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($servicos as $servico)
        <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
    @endforeach
</x-adminlte.form.input.select>
