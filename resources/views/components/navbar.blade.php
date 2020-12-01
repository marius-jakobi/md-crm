<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="/" class="navbar-brand">Start</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        {{--Left side links--}}
        <ul class="navbar-nav mr-auto">
            <x-navbar.navlink route="welcome">Startseite</x-navbar.navlink>
        </ul>
        {{--Right side links--}}
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->fullname() }}</a>
                    <div class="dropdown-menu">
                        {{--Logout form--}}
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Abmelden</button>
                        </form>
                    </div>
                </li>
            @endauth
            @guest
                <x-navbar.navlink route="auth.login">Anmelden</x-navbar.navlink>
                <x-navbar.navlink route="auth.signup">Registrieren</x-navbar.navlink>
            @endguest
        </ul>
    </div>
</nav>
