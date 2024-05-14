<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-5">
    <a class="navbar-brand" href="#">Szpital</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Dashboard</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Zarządzaj pracownikami</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="#">Lekarze</a>
            <a class="dropdown-item" href="#">Pielęgniarki</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Zarządzaj szpitalem
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="#">Pacjenci</a>
            <a class="dropdown-item" href="#">Leki</a>
            <a class="dropdown-item" href="#">Sale</a>
          </div>
        </li>
      </ul>
      <button class="btn btn-outline-success" type="submit">Wyloguj się</button>

    </div>
  </nav>


  <div class="container">
    <h2 class="mt-4">Edytuj dane</h2>
    <form>
        <div class="form-group row mb-4">
            <label for="inputID" class="col-md-2 col-form-label">ID:</label>
            <div class="col-md-4">
                <input type="number" class="form-control" id="inputID" placeholder="ID">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputNazwaLeku" class="col-md-2 col-form-label">Nazwa leku:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputNazwaLeku" placeholder="Nazwa leku">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputInstrukcja" class="col-md-2 col-form-label">Instrukcja:</label>
            <div class="col-md-4">
                <textarea class="form-control" id="inputInstrukcja" rows="6" placeholder="Instrukcja"></textarea>
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputFormaLeku" class="col-md-2 col-form-label">Forma leku:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputFormaLeku" placeholder="Forma leku">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputIloscMagazyn" class="col-md-2 col-form-label">Ilość w magazynie:</label>
            <div class="col-md-4">
                <input type="number" class="form-control" id="inputIloscMagazyn" placeholder="Ilość w magazynie">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputKategoriaLeku" class="col-md-2 col-form-label">Kategoria Leku:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputKategoriaLeku" placeholder="Kategoria Leku">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputCena" class="col-md-2 col-form-label">Cena:</label>
            <div class="col-md-4">
                <input type="number" class="form-control" id="inputCena" placeholder="Cena">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="inputDawkaJednostka" class="col-md-2 col-form-label">Dawka jednostka:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputDawkaJednostka" placeholder="Dawka jednostka">
            </div>
        </div>
        <div class="form-group row mb-4">
            <div class="offset-md-2 col-md-1">
                <button type="submit" class="btn btn-primary mb-2">Zatwierdź</button>
            </div>
            <div class="offset-md-1 col-md-1">
                <button class="btn btn-primary">Wyjście</button>
            </div>
        </div>
    </form>
</div>







  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




  <footer class="footer fixed-bottom bg-body-tertiary">
    <div class="row text-center pt-2">
      <p>&copy; &ndash; 2024</p>
    </div>
  </footer>
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>