<form @if(env('APP_DEBUG') == 'true') novalidate @endif action="{{ $attributes['action'] }}" method="{{ $attributes['method'] }}">
    {{ $slot }}
</form>
