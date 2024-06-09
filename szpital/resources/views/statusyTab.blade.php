<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
@include('shared.head')
<body>
    @include('shared.navbar')
    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Statusy</h2>
        <form method="GET" action="{{ route('statusIndex') }}">
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="search" id="inputSearch" placeholder="Wyszukaj">
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
                        <th scope="col">Status</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Procedura</th>
                        <th scope="col">Edytuj</th>
                        <th scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statuses as $status)
                        <tr>
                            <th scope="row">{{ $status->id }}</th>
                            <td>{{ $status->status }}</td>
                            <td>{{ $status->description }}</td>
                            <td>{{ $status->procedure->name }}</td>
                            <td><a href="{{ route('statusesShow', $status->id) }}" class="btn btn-warning">Edytuj</a></td>
                            <td>
                                <form action="{{ route('statusesDestroy', $status->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
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
        <h2 class="mt-4">Dodawanie Statusów</h2>
        <form action="{{ route('statusesStore') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="status" id="inputStatus" placeholder="Status">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="description" id="inputDescription" placeholder="Opis">
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
