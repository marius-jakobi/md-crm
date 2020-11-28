<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'md-crm')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('scripts')
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        {{-- Session flash messages --}}
        @foreach(['error', 'warning', 'info', 'success'] as $type)
            @if(session($type))
                <x-alert :type="$type" message="{{ session($type) }}" :dismissible="true" />
            @endif
        @endforeach

        {{--Content--}}
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
