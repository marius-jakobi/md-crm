<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link @if(Route::is($route)) active @endif">
        {{ $slot }}
    </a>
</li>
