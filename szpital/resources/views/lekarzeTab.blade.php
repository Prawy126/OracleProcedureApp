<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.script')

    <div class="container">
        <h2 class="mt-4">Lekarze</h2>
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
        <h2 class="mt-4">Dodawanie lekarzy</h2>
        <form>
            <div class="row">
                <div class="form-group col-md-1">
                    <input type="number" class="form-control" id="inputID" placeholder="ID">
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="inputImie" placeholder="Imię">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputNazwisko" placeholder="Nazwisko">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputSpecjalizacja" placeholder="Specjalizacja">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputNumerLicencji" placeholder="Numer licencji">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" id="inputIDKonta" placeholder="ID konta">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>
    </div>


    @include('shared.footer')

</body>

</html>
