@foreach( $tasks as $task)
<li class="{{ $task->done }}">
  <div class="icheck-primary d-inline ml-2">
    <input type="checkbox" value="{{ $task->id }}"
      @if(isset($task->deleted_at))
        checked
      @endif
        name="deleted_at" id="todoCheck_{{ $task->id }}">

    <label for="todoCheck_{{ $task->id }}">{{ $task->nome }}</label>
  </div>
  <small class="badge {{ $task->badge }} text-right">
    <i class="far fa-clock"></i> 
    
    @if(!isset($task->deleted_at))
      {{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }} 
    @else
      {{ \Carbon\Carbon::parse($task->deleted_at)->diffForHumans() }}
    @endif

  </small>
  <div class="tools">
    <i class="fas fa-edit"></i>
    <i class="fas fa-trash-o"></i>
  </div>
</li>
@endforeach