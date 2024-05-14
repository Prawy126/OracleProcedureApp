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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zarządzaj pracownikami</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="#">Lekarze</a>
                        <a class="dropdown-item" href="#">Pielęgniarki</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <h2 class="mt-4">Edytuj dane: Sale</h2>
        <form>
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" placeholder="ID">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNumerSali" class="col-md-2 col-form-label">Numer sali:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputNumerSali" placeholder="Numer sali">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputLokalizacja" class="col-md-2 col-form-label">Lokalizacja:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputLokalizacja" placeholder="Lokalizacja">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputStatusSali" class="col-md-2 col-form-label">Status sali:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputStatusSali" placeholder="Status sali">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputTypSali" class="col-md-2 col-form-label">Typ sali:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputTypSali" placeholder="Typ sali">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputLiczbaMiejsc" class="col-md-2 col-form-label">Liczba miejsc:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputLiczbaMiejsc" placeholder="Liczba miejsc">
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