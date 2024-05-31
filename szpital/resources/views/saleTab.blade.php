<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Sale</h2>
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
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $r)
                        <tr>
                            <th scope="row">{{ $r->id }}</th>
                            <td>{{ $r->number }}</td>
                            <td>{{ $r->location }}</td>
                            <td>{{ $r->status }}</td>
                            <td>{{ $r->type_room }}</td>
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
        <h2 class="mt-4">Dodawanie sal</h2>
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-1">
                    <input type="number" class="form-control" name="id" id="inputID" placeholder="ID">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" name="rnumber" id="inputNumerSali" placeholder="Numer sali">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="rlocation" id="inputLokalizacja" placeholder="Lokalizacja">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="status" id="inputStatusSali" placeholder="Status sali">
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" name="type_room" id="inputTypSali" placeholder="Typ sali">
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
