<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.nav')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Lekarze</h2>
        <form>
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" placeholder="ID">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputImie" class="col-md-2 col-form-label">Imię:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputImie" placeholder="Imię">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNazwisko" class="col-md-2 col-form-label">Nazwisko:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNazwisko" placeholder="Nazwisko">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputSpecjalizacja" class="col-md-2 col-form-label">Specjalizacja:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputSpecjalizacja" placeholder="Specjalizacja">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNumerLicencji" class="col-md-2 col-form-label">Numer licencji:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNumerLicencji" placeholder="Numer licencji">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDKonta" class="col-md-2 col-form-label">ID konta:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputIDKonta" placeholder="ID konta">
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

    @include('shared.footer')

</body>

</html>
