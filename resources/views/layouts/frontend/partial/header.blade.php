<header class="header">
    <nav class="container navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('public/backend/upload/logo.png') }}" height="40px" alt="Logo"> <span class="text-light h4">আল হেরা শিশু একাডেমী</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenu" aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="headerMenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('noticeboard') }}">Noticeboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('result') }}">Result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('online.admission') }}">Admission</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    @guest--}}
{{--                    <a class="nav-link" href="{{ route('login') }}">Login</a>--}}
{{--                    @else--}}
{{--                        <a class="nav-link" target="_blank" href="{{ route('home') }}">Admin Panel</a>--}}
{{--                    @endif--}}
{{--                </li>--}}
            </ul>
        </div>
    </nav>
</header>

