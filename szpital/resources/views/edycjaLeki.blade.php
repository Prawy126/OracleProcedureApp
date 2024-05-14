<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container mb-12" style="padding-bottom: 50px;">
        <h2 class="mt-4">Edytuj dane: Leki</h2>
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

    @include('shared.footer')

</body>

</html>
