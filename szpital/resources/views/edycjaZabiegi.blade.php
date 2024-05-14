<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Zabiegi</h2>
        <form>
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" placeholder="ID">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDRodzajZabiegu" class="col-md-2 col-form-label">ID Rodzaju zabiegu:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputIDRodzajZabiegu"
                        placeholder="ID Rodzaju zabiegu">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDSala" class="col-md-2 col-form-label">ID Sali:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputIDSala" placeholder="ID Sali">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputData" class="col-md-2 col-form-label">Data:</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" id="inputData" placeholder="Data">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputCzasTrwania" class="col-md-2 col-form-label">Czas trwania:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputCzasTrwania" placeholder="Czas trwania">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputKoszt" class="col-md-2 col-form-label">Koszt:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputKoszt" placeholder="Koszt">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputStatus" class="col-md-2 col-form-label">Status:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputStatus" placeholder="Status">
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
