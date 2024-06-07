<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edycja Pacjenta</h2>
        <form action="{{ route('patientsUpdate', $patient['ID']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" placeholder="ID"
                        value="{{ $patient['ID'] }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDRodzajZabiegu" class="col-md-2 col-form-label">Imię:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputName" placeholder="Imię" name="name"
                        value="{{ $patient['NAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDSala" class="col-md-2 col-form-label">Nazwisko:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Nazwisko"
                        value="{{ $patient['SURNAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputData" class="col-md-2 col-form-label">Id pielęgniarki:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputNurseID" name="nurse_id"
                        placeholder="Id pielęgniarki" value="{{ $patient['NURSE_ID'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputCzasTrwania" class="col-md-2 col-form-label">Id konta</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputUserId" name="user_id" placeholder="Id konta"
                        value="{{ $patient['USER_ID'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputKoszt" class="col-md-2 col-form-label">Czas pobytu:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputTimeVisut" name="time_visit"
                        placeholder="Czas pobytu" value="{{ $patient['TIME_VISIT'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputStatus" class="col-md-2 col-form-label">Id sali:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputRoomId" name="room_id" placeholder="Id sali"
                        value="{{ $patient['ROOM_ID'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <div class="offset-md-2 col-md-1">
                    <button type="submit" class="btn btn-primary mb-2">Zatwierdź</button>
                </div>
                <div class="offset-md-1 col-md-1">
                    <button class="btn btn-primary">Wyjście</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>

</html>
