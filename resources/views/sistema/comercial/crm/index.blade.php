@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-md-3" id="1_empresas">
    @include('sistema.comercial.crm.partes.1_empresas')
  </div>
  
  <div class="col-md-3" id="3_leads">
    @include('sistema.comercial.crm.partes.3_leads')
  </div>
  
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-7" id="4_leads_detalhes">
        @include('sistema.comercial.crm.partes.4_leads_detalhes')
      </div>

      <div class="col-md-5" id="2_produtos">
        @include('sistema.comercial.crm.partes.2_produtos')
      </div>
    </div>
    
    <div class="row">
      {{--
        <div class="col-md-5">
          @include('sistema.comercial.crm.partes.6_')
        </div>
        --}}
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    clientes_listar();
    
    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      clientes_listar(page);
    });
  });

  function clientes_listar(page)
  {
    $('#overlay-leads').show();
  
    var url = "{{ route('com.leads.1_empresas') }}";
    var params   = url+'?filtro=Clientes';

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#1_empresas').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '1312354a' ] )
    .then( function(response)
    {
      $('#overlay-leads').hide();
    })
  }

  function leads_adicionar()
  {
    var url = "{{ route('com.leads.adicionar') }}";
        
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#offcanva-geral-'+id_cnv).css('width', '100%')      
      $('#offcanva-geral-'+id_cnv).empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '3134621a' ] )
    .then( function(response)
    {
      $('#offcanva-geral-'+id_cnv).offcanvas('show');
      clientes_listar()
    })
  }
  
  function leads_excluir(id)
  {
    $('#overlay-leads').show();

    var url = "{{ route('com.leads.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '32135543a' ] )
    .then( function(response)
    {
      clientes_listar()
    })
    .then( function(response)
    {
      $('#overlay-leads').hide();
    })
  }

  function leads_restaurar(id)
  {
    $('#overlay-leads').show();

    var url = "{{ route('com.leads.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '13543548a' ] )
    .then( function(response)
    {
      clientes_listar()
    })
    .then( function(response)
    {
      $('#overlay-leads').hide();
    })
  }

</script>
@endsection

@section('css')
<style>
  /* custom macos scrollbar */
  .card-body::-webkit-scrollbar {
    background-color: #fff;
    width: 6px;
  }
  
  /* background of the scrollbar except button or resizer */
  .card-body::-webkit-scrollbar-track {
    background-color: rgba(245,245,245,0.5);
  }
  
  /* scrollbar itself */
  .card-body::-webkit-scrollbar-thumb {
    background-color: rgb(186,186,192);
    border-radius: 5px;
    border: 0.5px solid rgb(186,186,192, 0.8);
    -webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.2);
  }
  
  /* set button(top and bottom of the scrollbar) */
  .card-body::-webkit-scrollbar-button {
    display: none;
  }
</style>
@endsection