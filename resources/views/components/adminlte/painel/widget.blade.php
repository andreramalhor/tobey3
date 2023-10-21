<div class="col-lg-3 col-6">
  <div class="small-box bg-{{ $tipo ?? 'info' }}">
    <div class="inner">
      <h3>{{ $valor ?? '0' }}</h3>
      <p>{{ $texto ?? 'texto' }}</p>
    </div>
    <div class="icon">
      <i class="{{ $icone ?? 'ion ion-bag' }}"></i>
    </div>
    <a href="{{ $href ?? '#' }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>