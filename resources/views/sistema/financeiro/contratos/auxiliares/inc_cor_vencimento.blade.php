
@if( isset($cliente['01']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['01']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['01']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['01']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['01']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['02']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['02']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['02']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['02']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['02']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['03']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['03']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['03']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['03']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['03']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif


@if( isset($cliente['04']) )
  @if( $cliente['04']->first()->status == 'Confirmado' )
    <td class="text-right bg-green">{{ number_format($cliente['04']->sum('vlr_final'), 2, ',', '.')}}</td>
  @else
    @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['04']->first()->dt_vencimento) < \Carbon\Carbon::today() )   {{-- //  menor que hoje  --}}
      {{-- <td class="text-right bg-red">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['04']->first()->dt_vencimento) }}</td> --}}
      <td class="text-right bg-red">{{ number_format($cliente['04']->sum('vlr_final'), 2, ',', '.')}}</td>
    @else
      {{-- <td class="text-right bg-yellow">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['04']->first()->dt_vencimento) }}</td> --}}
      <td class="text-right bg-yellow">{{ number_format($cliente['04']->sum('vlr_final'), 2, ',', '.') }}</td>
    @endif
  @endif
@else
  <td class="text-right">-</td>
@endif

{{-- 
@if( isset($cliente['04']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['04']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['04']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['04']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['04']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif --}}

@if( isset($cliente['05']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['05']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['05']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['05']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['05']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['06']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['06']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['06']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['06']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['06']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['07']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['07']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['07']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['07']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['07']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['08']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['08']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['08']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['08']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['08']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['09']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['09']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['09']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['09']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['09']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['10']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['10']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['10']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['10']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['10']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['11']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['11']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['11']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['11']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['11']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif

@if( isset($cliente['12']) )
  <td class="text-right 
  @if( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['12']->first()->dt_vencimento) < \Carbon\Carbon::today() )
    bg-green
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['12']->first()->dt_vencimento) == \Carbon\Carbon::today() )
    bg-yellow
  @elseif( \Carbon\Carbon::createFromFormat('Y-m-d', $cliente['12']->first()->dt_vencimento) > \Carbon\Carbon::today() )
    bg-red
  @endif
  ">{{ number_format($cliente['12']->sum('vlr_final'), 2, ',', '.')}}</td>
@else
  <td class="text-right">-</td>
@endif
