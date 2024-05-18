<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.nav')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Lekarze</h2>
        <form method="POST" action="{{ route('doctorUpdate') }}">
            @method('PUT')
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" value="{{ $doctors->id }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputImie" class="col-md-2 col-form-label">Imię:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputImie" value="{{ $doctors->name }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNazwisko" class="col-md-2 col-form-label">Nazwisko:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNazwisko" value="{{ $doctors->surname }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputSpecjalizacja" class="col-md-2 col-form-label">Specjalizacja:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputSpecjalizacja" value="{{ $doctors->specialization }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNumerLicencji" class="col-md-2 col-form-label">Numer licencji:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNumerLicencji" value="{{ $doctors->license_number }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDKonta" class="col-md-2 col-form-label">ID konta:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputIDKonta" value="{{ $doctors->user_id }}">
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
