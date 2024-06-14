<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Sale</h2>

        <form method="GET" action="{{ route('roomIndex') }}">
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="search" id="inputWyszukiwanie" placeholder="Wyszukaj">
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
                        <th scope="col">Numer sali</th>
                        <th scope="col">Lokalizacja</th>
                        <th scope="col">Status</th>
                        <th scope="col">Typ sali</th>
                        <th scope="col">Miejsca</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $r)
                        <tr>
                            <th scope="row">{{ $r->id }}</th>
                            <td>{{ $r->rnumber }}</td>
                            <td>{{ $r->rlocation }}</td>
                            <td>{{ $r->status }}</td>
                            <td>{{ $r->type_room }}</td>
                            <td>{{ $r->seats }}</td>
                            <td><a href="{{ route('roomsShow', $r->id) }}" class="btn btn-warning">Edytuj</a></td>
                            <td>
                                <form action="{{ route('roomsDestroy', $r->id) }}" method="POST">
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
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <h2 class="mt-4">Dodawanie sal</h2>
        <form action="{{ route('roomsStore') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="rnumber" id="inputNumerSali" placeholder="Numer sali" required>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="rlocation" id="inputLokalizacja" placeholder="Lokalizacja" required>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="status" id="inputStatusSali" placeholder="Status sali" required>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="type_room" id="inputTypSali" placeholder="Typ sali" required>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="seats" id="inputTypSali" placeholder="Liczba ludzi" required>
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
