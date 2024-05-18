<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

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
                        <th scope="col">IMIĘ</th>
                        <th scope="col">NAZWISKO</th>
                        <th scope="col">SPECJALIZACJA</th>
                        <th scope="col">LICENCJA</th>
                        <th scope="col">ID KONTA</th>

                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($doctors as $doc)
                        <tr>
                            <th scope="row">{{ $doc->id }}</th>
                            <td>{{ $doc->name }}</td>
                            <td>{{ $doc->surname }}</td>
                            <td>{{ $doc->specialization }}</td>
                            <td>{{ $doc->license_number }}</td>
                            <td>{{ $doc->user_id }}</td>
                            <td><a href="#">Edytuj</a></td>
                            <td><button type="button" class="btn btn-danger">Usuń</button></td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-4">Dodawanie lekarzy</h2>
        <form method="POST" action="">
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
