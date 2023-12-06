
<h3>{{ $curso->where('caracteristica', '=', 'Título')->first()->descricao }}</h3><br>
<div class="row">
  <div class="col-12">
    <div class="row invoice-info">
      @foreach($curso as $informacao)
      <div class="col-sm-3 invoice-col pb-3">
        <strong class="text-muted">{{ $informacao->caracteristica }}</strong><br>
      </div>
      <div class="col-sm-9 invoice-col pb-3">
        {!! $informacao->descricao !!}
      </div>
      <hr>
      @endforeach
    </div>
  </div>
</div>
