<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Leki</h2>
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
                        <th scope="col">Kolumna 0</th>
                        <th scope="col">Kolumna 1</th>
                        <th scope="col">Kolumna 2</th>
                        <th scope="col">Kolumna 3</th>
                        <th scope="col">Kolumna 4</th>
                        <th scope="col">Kolumna 5</th>
                        <th scope="col">Kolumna 6</th>
                        <th scope="col">Kolumna 7</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Akcje</td>
                        <td>Dane 1</td>
                        <td>Dane 2</td>
                        <td>Dane 3</td>
                        <td>Dane 4</td>
                        <td>Dane 5</td>
                        <td>Dane 6</td>
                        <td>Dane 7</td>
                        <td><a href="#">Edytuj</a></td>
                        <td><button type="button" class="btn btn-danger">Usuń</button></td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Akcje</td>
                        <td>Dane 1</td>
                        <td>Dane 2</td>
                        <td>Dane 3</td>
                        <td>Dane 4</td>
                        <td>Dane 5</td>
                        <td>Dane 6</td>
                        <td>Dane 7</td>
                        <td><a href="#">Edytuj</a></td>
                        <td><button type="button" class="btn btn-danger">Usuń</button></td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Akcje</td>
                        <td>Dane 1</td>
                        <td>Dane 2</td>
                        <td>Dane 3</td>
                        <td>Dane 4</td>
                        <td>Dane 5</td>
                        <td>Dane 6</td>
                        <td>Dane 7</td>
                        <td><a href="#">Edytuj</a></td>
                        <td><button type="button" class="btn btn-danger">Usuń</button></td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Akcje</td>
                        <td>Dane 1</td>
                        <td>Dane 2</td>
                        <td>Dane 3</td>
                        <td>Dane 4</td>
                        <td>Dane 5</td>
                        <td>Dane 6</td>
                        <td>Dane 7</td>
                        <td><a href="#">Edytuj</a></td>
                        <td><button type="button" class="btn btn-danger">Usuń</button></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="container mb-12" style="padding-bottom: 50px;"> <!--naprawa problemu nie bootstrapowym podejściem-->
        <h2 class="mt-4">Dodawanie leku</h2>
        <form>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputID">ID</label>
                        <input type="number" class="form-control" id="inputID" placeholder="ID">
                    </div>
                    <div class="form-group">
                        <label for="inputNazwaLeku">Nazwa leku</label>
                        <input type="text" class="form-control" id="inputNazwaLeku" placeholder="Nazwa leku">
                    </div>
                    <div class="form-group">
                        <label for="inputInstrukcja">Instrukcja</label>
                        <textarea class="form-control" id="inputInstrukcja" rows="6" placeholder="Instrukcja"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputFormaLeku">Forma leku</label>
                        <input type="text" class="form-control" id="inputFormaLeku" placeholder="Forma leku">
                    </div>
                    <div class="form-group">
                        <label for="inputIloscMagazyn">Ilość w magazynie</label>
                        <input type="number" class="form-control" id="inputIloscMagazyn"
                            placeholder="Ilość w magazynie">
                    </div>
                    <div class="form-group">
                        <label for="inputKategoriaLeku">Kategoria Leku</label>
                        <input type="text" class="form-control" id="inputKategoriaLeku" placeholder="Kategoria Leku">
                    </div>
                    <div class="form-group">
                        <label for="inputCena">Cena</label>
                        <input type="number" class="form-control" id="inputCena" placeholder="Cena">
                    </div>
                    <div class="form-group">
                        <label for="inputDawkaJednostka">Dawka jednostka</label>
                        <input type="text" class="form-control" id="inputDawkaJednostka"
                            placeholder="Dawka jednostka">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>

</html>
