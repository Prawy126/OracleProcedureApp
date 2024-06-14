<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Lekarze</h2>
        <form method="POST" action="{{ route('doctorUpdate', $doctor['ID']) }}">
            @csrf
            @method('PUT')

            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" name="id" value="{{ $doctor['ID'] }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputImie" class="col-md-2 col-form-label">Imię:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputImie" name="name" value="{{ $doctor['NAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNazwisko" class="col-md-2 col-form-label">Nazwisko:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNazwisko" name="surname" value="{{ $doctor['SURNAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputSpecjalizacja" class="col-md-2 col-form-label">Specjalizacja:</label>
                <div class="col-md-4">
                    <select class="form-control" id="inputSpecjalizacja" name="specialization">
                        <option value="kardiologia" {{ $doctor['SPECIALIZATION'] == 'kardiologia' ? 'selected' : '' }}>Kardiologia</option>
                        <option value="neurologia" {{ $doctor['SPECIALIZATION'] == 'neurologia' ? 'selected' : '' }}>Neurologia</option>
                        <option value="ortopedia" {{ $doctor['SPECIALIZATION'] == 'ortopedia' ? 'selected' : '' }}>Ortopedia</option>
                        <option value="pediatria" {{ $doctor['SPECIALIZATION'] == 'pediatria' ? 'selected' : '' }}>Pediatria</option>
                        <option value="dermatologia" {{ $doctor['SPECIALIZATION'] == 'dermatologia' ? 'selected' : '' }}>Dermatologia</option>
                        <option value="ginekologia" {{ $doctor['SPECIALIZATION'] == 'ginekologia' ? 'selected' : '' }}>Ginekologia</option>
                        <option value="radiologia" {{ $doctor['SPECIALIZATION'] == 'radiologia' ? 'selected' : '' }}>Radiologia</option>
                        <option value="urologia" {{ $doctor['SPECIALIZATION'] == 'urologia' ? 'selected' : '' }}>Urologia</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNumerLicencji" class="col-md-2 col-form-label">Numer licencji:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNumerLicencji" name="license_number" value="{{ $doctor['LICENSE_NUMBER'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIDKonta" class="col-md-2 col-form-label">ID konta:</label>
                <div class="col-md-4">
                    <select class="form-control" id="inputIDKonta" name="user_id">
                        @foreach($user_ids as $user_id)
                            <option value="{{ $user_id }}" {{ $doctor['USER_ID'] == $user_id ? 'selected' : '' }}>{{ $user_id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <div class="offset-md-2 col-md-1">
                    <button type="submit" class="btn btn-primary mb-2">Zatwierdź</button>
                </div>
                <div class="offset-md-1 col-md-1">
                    <button type="button" class="btn btn-primary">Wyjście</button>
                </div>
            </div>
        </form>

    </div>

    @include('shared.footer')

</body>

</html>
