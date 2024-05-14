<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

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

    @include('shared.footer')

</html>
