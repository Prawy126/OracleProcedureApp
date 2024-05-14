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
    <h2 class="mt-4">Sale</h2>
    <form>
      <div class="row">
        <div class="form-group col-md-2">
          <input type="text" class="form-control" id="inputWyszukiwanie" placeholder="Wyszukaj">
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-primary">Zatwierdź</button>
        </div>
      </div>
    </form>
  </div>

  <div class="container mt-4">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kolumna 1</th>
            <th scope="col">Kolumna 2</th>
            <th scope="col">Kolumna 3</th>
            <th scope="col">Kolumna 4</th>
            <th scope="col">Kolumna 5</th>
            <th scope="col">Kolumna 6</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Dane 1</td>
            <td>Dane 2</td>
            <td>Dane 3</td>
            <td>Dane 4</td>
            <td>Dane 5</td>
            <td>Dane 6</td>
            <td><a href="#">Edytuj</a></td>
            <td><button type="button" class="btn btn-danger">Usuń</button></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Dane 7</td>
            <td>Dane 8</td>
            <td>Dane 9</td>
            <td>Dane 10</td>
            <td>Dane 11</td>
            <td>Dane 12</td>
            <td><a href="#">Edytuj</a></td>
            <td><button type="button" class="btn btn-danger">Usuń</button></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Dane 13</td>
            <td>Dane 14</td>
            <td>Dane 15</td>
            <td>Dane 16</td>
            <td>Dane 17</td>
            <td>Dane 18</td>
            <td><a href="#">Edytuj</a></td>
            <td><button type="button" class="btn btn-danger">Usuń</button></td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>Dane 19</td>
            <td>Dane 20</td>
            <td>Dane 21</td>
            <td>Dane 22</td>
            <td>Dane 23</td>
            <td>Dane 24</td>
            <td><a href="#">Edytuj</a></td>
            <td><button type="button" class="btn btn-danger">Usuń</button></td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>Dane 25</td>
            <td>Dane 26</td>
            <td>Dane 27</td>
            <td>Dane 28</td>
            <td>Dane 29</td>
            <td>Dane 30</td>
            <td><a href="#">Edytuj</a></td>
            <td><button type="button" class="btn btn-danger">Usuń</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="container">
    <h2 class="mt-4">Dodawanie sal</h2>
    <form>
      <div class="row">
        <div class="form-group col-md-1">
          <input type="number" class="form-control" id="inputID" placeholder="ID">
        </div>
        <div class="form-group col-md-2">
          <input type="number" class="form-control" id="inputNumerSali" placeholder="Numer sali">
        </div>
        <div class="form-group col-md-2">
          <input type="text" class="form-control" id="inputLokalizacja" placeholder="Lokalizacja">
        </div>
        <div class="form-group col-md-2">
          <input type="text" class="form-control" id="inputStatusSali" placeholder="Status sali">
        </div>
        <div class="form-group col-md-1">
          <input type="text" class="form-control" id="inputTypSali" placeholder="Typ sali">
        </div>
        <div class="form-group col-md-2">
          <input type="number" class="form-control" id="inputLiczbaMiejsc" placeholder="Liczba miejsc">
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-primary">Dodaj</button>
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