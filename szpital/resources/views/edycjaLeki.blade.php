<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container mb-12" style="padding-bottom: 50px;">
        <h2 class="mt-4">Edytuj dane: Leki</h2>
        <form method="POST" action="{{ route('medicinUpdate', $medicin['ID']) }}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            @method('PUT')
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" name="id"
                        value="{{ $medicin['ID'] }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNazwaLeku" class="col-md-2 col-form-label">Nazwa leku:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNazwaLeku" name="name"
                        value="{{ $medicin['NAME'] }}" required maxlength="200">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputInstrukcja" class="col-md-2 col-form-label">Instrukcja:</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="inputInstrukcja" rows="6" name="instruction" required>{{ $medicin['INSTRUCTION'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIloscMagazyn" class="col-md-2 col-form-label">Ilość w magazynie:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputIloscMagazyn" name="warehouse_quantity"
                        value="{{ $medicin['WAREHOUSE_QUANTITY'] }}" required min="0">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputFormaLeku" class="col-md-2 col-form-label">Forma leku:</label>
                <div class="col-md-4">
                    <select class="form-select" id="inputFormaLeku" name="drug_form" required>
                        <option value="tabletki" {{ $medicin['DRUG_FORM'] == 'tabletki' ? 'selected' : '' }}>Tabletki
                        </option>
                        <option value="syrop" {{ $medicin['DRUG_FORM'] == 'syrop' ? 'selected' : '' }}>Syrop</option>
                        <option value="zastrzyk" {{ $medicin['DRUG_FORM'] == 'zastrzyk' ? 'selected' : '' }}>Zastrzyk
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputKategoriaLeku" class="col-md-2 col-form-label">Kategoria Leku:</label>
                <div class="col-md-4">
                    <select class="form-select" id="inputKategoriaLeku" name="drug_category" required>
                        <option value="przeciwbólowe"
                            {{ $medicin['DRUG_CATEGORY'] == 'przeciwbólowe' ? 'selected' : '' }}>Przeciwbólowe</option>
                        <option value="antybiotyki" {{ $medicin['DRUG_CATEGORY'] == 'antybiotyki' ? 'selected' : '' }}>
                            Antybiotyki</option>
                        <option value="przeciwwirusowe"
                            {{ $medicin['DRUG_CATEGORY'] == 'przeciwwirusowe' ? 'selected' : '' }}>Przeciwwirusowe
                        </option>
                        <option value="przeciwzapalne"
                            {{ $medicin['DRUG_CATEGORY'] == 'przeciwzapalne' ? 'selected' : '' }}>Przeciwzapalne
                        </option>
                        <option value="przeciwgorączkowe"
                            {{ $medicin['DRUG_CATEGORY'] == 'przeciwgorączkowe' ? 'selected' : '' }}>Przeciwgorączkowe
                        </option>
                        <option value="przeciwhistaminowe"
                            {{ $medicin['DRUG_CATEGORY'] == 'przeciwhistaminowe' ? 'selected' : '' }}>
                            Przeciwhistaminowe</option>
                        <option value="diuretyki" {{ $medicin['DRUG_CATEGORY'] == 'diuretyki' ? 'selected' : '' }}>
                            Diuretyki</option>
                        <option value="leki_na_nadciśnienie"
                            {{ $medicin['DRUG_CATEGORY'] == 'leki_na_nadciśnienie' ? 'selected' : '' }}>Leki na
                            nadciśnienie</option>
                        <option value="leki_na_cukrzycę"
                            {{ $medicin['DRUG_CATEGORY'] == 'leki_na_cukrzycę' ? 'selected' : '' }}>Leki na cukrzycę
                        </option>
                        <option value="leki_na_choroby_serca"
                            {{ $medicin['DRUG_CATEGORY'] == 'leki_na_choroby_serca' ? 'selected' : '' }}>Leki na
                            choroby serca</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputCena" class="col-md-2 col-form-label">Cena:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputCena" name="price"
                        value="{{ $medicin['PRICE'] }}" required min="0" step="0.01">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputDawkaJednostka" class="col-md-2 col-form-label">Dawka jednostka:</label>
                <div class="col-md-4">
                    <select class="form-select" id="inputDawkaJednostka" name="dose_unit" required>
                        <option value="mililitr" {{ $medicin['DOSE_UNIT'] == 'mililitr' ? 'selected' : '' }}>Mililitr</option>
                        <option value="tabletka" {{ $medicin['DOSE_UNIT'] == 'tabletka' ? 'selected' : '' }}>Tabletka</option>
                    </select>
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
