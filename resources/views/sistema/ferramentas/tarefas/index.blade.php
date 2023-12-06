@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Lista de Tarefa</h3>
      </div>
      <div class="card-body">
        <ul class="todo-list ui-sortable" data-widget="todo-list" id="my-todo-list">
        </ul>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('tarefa.create') }}" class="btn btn-info btn-sm float-right"><i class="fas fa-plus"></i> Adicionar Novo Item</a>
        {{-- <button type="button" href="{{ route('tarefa.store') }}" class="btn btn-info btn-sm float-right"><i class="fas fa-plus"></i> Adicionar Novo Item</button> --}}
      </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function()
  {
    listar()
  });

  $.ajaxSetup(
  {
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function listar()
  {
    $.ajax(
    {
      type: 'get',
      url: "{{ route('tarefa.list') }}",
      beforeSend: function(response)
      {
        $('.overlay').show();
      },
      success: function(response)
      {
        $('#my-todo-list').empty().html(response);
      },
      error: function(response)
      {
        console.log(response)
      },
      failure: function (response)
      {
        console.log(response)
        alert('failure')
        // $('#result').html(response);
      },
      complete: function (response)
      {
        $('.overlay').hide();
        // setTimeout('$(".overlay").fadeOut(1500).css("display", "none");', 3000);
      }
    });
  }

  $('#my-todo-list').on('click', 'input[type="checkbox"]', function()
  {
    var task = $(this).parents('.task');
    var idd  = task.prevObject[0].value;
    var done = task.prevObject[0].checked;

    var url = "{{ route('tarefa.update', ':idd') }}";
    var url = url.replace(':idd', idd);

    $.ajax({
      url : url,
      method : 'PATCH', 
      data :
      {
        _token : $('meta[name="csrf-token"]').attr('content'),
        id : idd,
        done : done,
      },
      dataType : 'json',
      success : function(response)
      {
        if (response.typ == 'success')
        {
          Command: toastr["success"](response.msg)
        }
        else
        {
          Command: toastr["warning"](response.msg)
        }

        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "3000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
      },
      error : function(response)
      {
        console.log(response)
        Command: toastr["error"]('Houve algum erro e a operação não pode ser concluída!')

        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "3000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
      },
      complete : function(response)
      {
        listar();
      },
    });
  });

  // $("#form_task_create").on('submit', function (e)
  // {
  //   e.preventDefault();

  //   var form = $(this);

  //   $.ajax({
  {{-- //     url       : "{{ route('tarefa.store') }}", --}}
  //     method    : "POST", 
  //     data      : form.serialize(),
  //     dataType  : 'json',
  //     success   : function(data)
  //     {
  //       console.log(data)
  //       alert('Pessoa criado com sucesso');
  //     },
  //     error     : function(defeito)
  //     {
  //       console.log(defeito)
  //       alert('Houve algum erro e o cliente não foi criado.');
  //     },
  //     complete  : function(resulado)
  //     {
  //       alert('s')
  //       // $("#cancelar_pessoa_create").click();
  //     },
  //   });
  // });
</script>
@stop
