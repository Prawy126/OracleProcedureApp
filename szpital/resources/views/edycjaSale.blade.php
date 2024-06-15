<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Sale</h2>
        <form method="POST" action="{{ route('roomsUpdate', ['id' => $room['ID']]) }}">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" name="rnumber" placeholder="ID" value="{{ $room['ID']}}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNumerSali" class="col-md-2 col-form-label">Numer sali:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNumerSali" name="rnumber" placeholder="Numer sali" value="{{ $room['RNUMBER'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputLokalizacja" class="col-md-2 col-form-label">Lokalizacja:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputLokalizacja" name="rlocation" placeholder="Lokalizacja" value="{{ $room['RLOCATION'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputStatusSali" class="col-md-2 col-form-label">Status sali:</label>
                <div class="col-md-4">
                    <select class="form-select" id="inputStatusSali" name="status">
                        <option value="Wolna" {{ $room['STATUS'] == 'Wolna' ? 'selected' : '' }}>Wolna</option>
                        <option value="Zajęta" {{ $room['STATUS'] == 'Zajęta' ? 'selected' : '' }}>Zajęta</option>
                        <option value="Niedostępna" {{ $room['STATUS'] == 'Niedostępna' ? 'selected' : '' }}>Niedostępna</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputTypSali" class="col-md-2 col-form-label">Typ sali:</label>
                <div class="col-md-4">
                    <select class="form-select" id="inputTypSali" name="type_room">
                        <option value="Dla pacjentów" {{ $room['TYPE_ROOM'] == 'Dla pacjentów' ? 'selected' : '' }}>dla_pacjenta</option>
                        <option value="operacyjna" {{ $room['TYPE_ROOM'] == 'operacyjna' ? 'selected' : '' }}>operacyjna</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputLiczbaMiejsc" class="col-md-2 col-form-label">Liczba miejsc:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputLiczbaMiejsc" name="seats" placeholder="Liczba miejsc" value="{{ $room['SEATS'] }}">
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

</html>
