<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Pacjenci</h2>
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
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">ID Pielęgniarki</th>
                        <th scope="col">ID Konta</th>
                        <th scope="col">Czas Pobytu</th>
                        <th scope="col">ID Sali</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <th scope="row">{{ $patient->id }}</th>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->surname }}</td>
                        <td>{{ $patient->nurse_id }}</td>
                        <td>{{ $patient->user_id }}</td>
                        <td>{{ $patient->time_visit }}</td>
                        <td>{{ $patient->room_id }}</td>
                        <td><a href="{{ route('patientsShow', $patient->id) }}">Edytuj</a></td>
                        <td>
                            <form action="{{ route('patientsDestroy', $patient->id) }}" method="POST">
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

    <div class="container" style="margin-bottom: 60px;">
        <h2 class="mt-4">Dodawanie pacjenta</h2>
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('patientsStore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" name="name" placeholder="Imię" required>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" class="form-control" name="surname" placeholder="Nazwisko" required>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-select" name="nurse_id" required>
                            <option value="" disabled selected>Wybierz pielęgniarkę</option>
                            @foreach($nurses as $nurse)
                                <option value="{{ $nurse->id }}">{{ $nurse->id }} - {{ $nurse->name }} {{ $nurse->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-select" name="user_id" required>
                            <option value="" disabled selected>Wybierz konto</option>
                            @foreach($user_ids as $user)
                                <option value="{{ $user->id }}">{{ $user->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="number" class="form-control" name="time_visit" placeholder="Czas pobytu" required>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-select" name="room_id" required>
                            <option value="" disabled selected>Wybierz salę</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->id }} - Sala nr: {{ $room->rnumber }}</option>
                            @endforeach
                        </select>
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
