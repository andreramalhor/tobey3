<x-adminlte.form.input.select {{ $attributes }} class="select2">
    @foreach($planocontas as $planoconta)
        <option value="{{ $planoconta->id }}">{{ $planoconta->titulo }}</option>
    @endforeach
</x-adminlte.form.input.select>
