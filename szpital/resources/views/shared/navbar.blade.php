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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Zarządzaj pracownikami</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="{{ route('doctorIndex') }}">Lekarze</a>
            <a class="dropdown-item" href="{{ route('pielegniarkiTab') }}">Pielęgniarki</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Zarządzaj szpitalem
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="{{ route('pacjenciTab') }}" >Pacjenci</a>
            <a class="dropdown-item" href="{{ route('lekiTab') }}">leki</a>
            <a class="dropdown-item" href="{{ route('saleTab') }}">Sale</a>
          </div>
        </li>
      </ul>
      <button class="btn btn-outline-success" type="submit">Wyloguj się</button>

    </div>
  </nav>
