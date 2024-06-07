<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Pielęgniarki</h2>
        <form method="GET" action="{{ route('nurseIndex') }}">
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" name="search" id="inputWyszukaj" placeholder="Wyszukaj">
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
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Numer</th>
                        <th scope="col">ID Użytkownika</th>
                        <th scope="col">Edytuj</th>
                        <th scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nurses as $nur)
                        <tr>
                            <th scope="row">{{ $nur->id }}</th>
                            <td>{{ $nur->name }}</td>
                            <td>{{ $nur->surname }}</td>
                            <td>{{ $nur->number_license }}</td>
                            <td>{{ $nur->user_id }}</td>
                            <td><a href="{{ route('nursesShow', $nur->id) }}" class="btn btn-warning">Edytuj</a></td>
                            <td>
                                <form action="{{ route('nursesDestroy', $nur->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="7">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-4">Dodawanie pielęgniarek</h2>
        <form action="{{ route('nursesStore') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="name" id="inputName" placeholder="Imię">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="surname" id="inputSurname" placeholder="Nazwisko">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="number_license" id="inputNumber" placeholder="Numer">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" name="user_id" id="inputUserID" placeholder="ID Użytkownika">
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
