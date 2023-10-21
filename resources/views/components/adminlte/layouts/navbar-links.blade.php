@if($slot->isempty())
<li class="nav-item d-none d-sm-inline-block">
    <a href="{{ $href ?? '#' }}" class="nav-link" @if(isset($tooltip)) data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $tooltip }}" @endif>{!! $icon !!}</a>
</li>
@else
    <li class="nav-item d-none d-sm-inline-block dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar_menu_{{ $menu ?? $tooltip ?? '111' }}" role="button" data-bs-toggle="dropdown" aria-expanded="false" @if(isset($tooltip)) data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $tooltip }}" @endif>{!! $icon !!}</a>
        <ul class="dropdown-menu" aria-labelledby="navbar_menu_{{ $menu ?? $tooltip ?? '111' }}">
            {{ $slot }}
        </ul>    
    </li>
@endif

