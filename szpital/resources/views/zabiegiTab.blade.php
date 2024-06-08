<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Zabiegi</h2>
        <form action="{{ route('proceduresIndex') }}" method="GET">
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="search" placeholder="Wyszukaj">
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
                        <th scope="col">ID Rodzaju zabiegu</th>
                        <th scope="col">ID Sali</th>
                        <th scope="col">Data</th>
                        <th scope="col">Czas trwania</th>
                        <th scope="col">Koszt</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($procedures as $procedure)
                    <tr>
                        <th scope="row">{{ $procedure->id }}</th>
                        <td>{{ $procedure->treatment_type_id }}</td>
                        <td>{{ $procedure->room_id }}</td>
                        <td>{{ $procedure->date }}</td>
                        <td>{{ $procedure->time }}</td>
                        <td>{{ $procedure->cost }}</td>
                        <td>{{ $procedure->status }}</td>
                        <td><a href="{{ route('proceduresShow', $procedure->id) }}">Edytuj</a></td>
                        <td>
                            <form action="{{ route('proceduresDestroy', $procedure->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-4">Dodawanie zabiegu</h2>
        <form action="{{ route('proceduresStore') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" name="treatment_type_id" placeholder="ID Rodzaju zabiegu">
                </div>
                <div class="form-group col-md-1">
                    <input type="number" class="form-control" name="room_id" placeholder="ID Sali">
                </div>
                <div class="form-group col-md-2">
                    <input type="datetime" class="form-control" name="date" placeholder="Data">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="time" placeholder="Czas trwania">
                    <!--Domyślnie zero i będzie liczony do momentu zmiany statusu na "zakończony"-->
                </div>
                <div class="form-group col-md-1">
                    <input type="number" class="form-control" name="cost" placeholder="Koszt">
                </div>
                <div class="form-group col-md-1">
                    <input type="number" class="form-control" name="status" placeholder="Status">
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>

</html>
