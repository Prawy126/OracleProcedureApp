<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edycja Pielęgniarki</h2>
        <form action="{{ route('nursesUpdate', $nurse['ID']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="inputName">Imię</label>
                    <input type="text" class="form-control" name="name" id="inputName" placeholder="Imię" value="{{ $nurse['NAME'] }}" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputSurname">Nazwisko</label>
                    <input type="text" class="form-control" name="surname" id="inputSurname" placeholder="Nazwisko" value="{{ $nurse['SURNAME'] }}" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputNumber">Numer</label>
                    <input type="text" class="form-control" name="number_license" id="inputNumber_license" placeholder="Numer" value="{{ $nurse['NUMBER_LICENSE'] }}" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputUserID">ID Użytkownika</label>
                    <input type="number" class="form-control" name="user_id" id="inputUserID" placeholder="ID Użytkownika" value="{{ $nurse['USER_ID']}}" required>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Aktualizuj</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>
</html>
