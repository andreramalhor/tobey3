<x-adminlte.form.input.select {{ $attributes }}>
    @foreach($formas as $forma)
        <option value="{{ $forma->id }}">{{ $forma->forma }}</option>
    @endforeach
</x-adminlte.form.input.select>
