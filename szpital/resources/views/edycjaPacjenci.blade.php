<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Zabiegi</h2>
        <form>
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" placeholder="ID" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDRodzajZabiegu" class="col-md-2 col-form-label">Imię:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputName"
                        placeholder="Imię">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDSala" class="col-md-2 col-form-label">Nazwisko:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="surname" placeholder="Nazwisko">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputData" class="col-md-2 col-form-label">Id pielęgniarki:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputNurseID" placeholder="Id pielęgniarki">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputCzasTrwania" class="col-md-2 col-form-label">Id konta</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputUserId" placeholder="Id konta">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputKoszt" class="col-md-2 col-form-label">Czas pobytu:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputTimeVisut" placeholder="Czas pobytu">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputStatus" class="col-md-2 col-form-label">Id sali:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputRoomId" placeholder="Id sali">
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
