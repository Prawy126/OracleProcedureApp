<nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-5">
    <a class="navbar-brand" href="#">Szpital</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin') }}">Dashboard</a>
            </li>
            @can('access-admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zarządzaj pracownikami</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="{{ route('doctorIndex') }}">Lekarze</a>
                        <a class="dropdown-item" href="{{ route('nurseIndex') }}">Pielęgniarki</a>
                    </div>
                </li>
            @endcan
            @can('access-admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Zarządzaj szpitalem
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item" href="{{ route('patientIndex') }}">Pacjenci</a>
                    <a class="dropdown-item" href="{{ route('medicinIndex') }}">leki</a>
                    <a class="dropdown-item" href="{{ route('roomIndex') }}">Sale</a>
                </div>
            </li>
            @endcan
        </ul>

        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                @csrf
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Wyloguj się</button>
            </form>
        @else
            <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('login') }}">Zaloguj się</a>
        @endif
    </div>
</nav>
