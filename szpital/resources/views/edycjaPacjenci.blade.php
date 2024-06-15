<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edycja Pacjenta</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('patientsUpdate', $patient['ID']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" placeholder="ID" value="{{ $patient['ID'] }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputName" class="col-md-2 col-form-label">Imię:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputName" placeholder="Imię" name="name" value="{{ $patient['NAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputSurname" class="col-md-2 col-form-label">Nazwisko:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Nazwisko" value="{{ $patient['SURNAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNurseID" class="col-md-2 col-form-label">Id pielęgniarki:</label>
                <div class="col-md-4">
                    <select class="form-control" id="inputNurseID" name="nurse_id" required>
                        <option value="" disabled selected>Wybierz pielęgniarkę</option>
                        @foreach($nurses as $nurse)
                            <option value="{{ $nurse->id }}" {{ $patient['NURSE_ID'] == $nurse->id ? 'selected' : '' }}>
                                {{ $nurse->id }} - {{ $nurse->name }} {{ $nurse->surname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputUserID" class="col-md-2 col-form-label">Id konta:</label>
                <div class="col-md-4">
                    <select class="form-control" id="inputUserID" name="user_id" required>
                        <option value="" disabled selected>Wybierz konto</option>
                        <option value="{{$patient['USER_ID']}}">{{ $patient['USER_ID'] == $patient['USER_ID'] ? 'nie zmieniaj' : '' }}</option>
                        @foreach($user_ids as $user)
                            <option value="{{ $user->id }}" {{ $patient['USER_ID'] == $user->id ? 'selected' : '' }}>
                                {{ $user->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputTimeVisit" class="col-md-2 col-form-label">Czas pobytu:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputTimeVisit" name="time_visit" placeholder="Czas pobytu" value="{{ $patient['TIME_VISIT'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputRoomID" class="col-md-2 col-form-label">Id sali:</label>
                <div class="col-md-4">
                    <select class="form-control" id="inputRoomID" name="room_id" required>
                        <option value="" disabled selected>Wybierz salę</option>
                        @foreach($rooms as $room)
                            <option value="{{ $patient["ROOM_ID"]}}" {{ $patient['ROOM_ID'] == $room->id ? 'selected' : '' }}>
                                {{ $room->id }} - Sala nr: {{ $room->rnumber }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <div class="offset-md-2 col-md-1">
                    <button type="submit" class="btn btn-primary mb-2">Zatwierdź</button>
                </div>
                <div class="offset-md-1 col-md-1">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Wyjście</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>

</html>
