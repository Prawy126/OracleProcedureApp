<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container mb-12" style="padding-bottom: 50px;">
        <h2 class="mt-4">Edytuj dane: Leki</h2>
        <form method="POST" action="{{ route('medicinUpdate', $medicin['ID']) }}">
            @csrf
            @method('PUT')
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" name="id" value="{{ $medicin['ID'] }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputNazwaLeku" class="col-md-2 col-form-label">Nazwa leku:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputNazwaLeku" name="name" value="{{ $medicin['NAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputInstrukcja" class="col-md-2 col-form-label">Instrukcja:</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="inputInstrukcja" rows="6" name="instruction">{{ $medicin['INSTRUCTION'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputIloscMagazyn" class="col-md-2 col-form-label">Ilość w magazynie:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputIloscMagazyn" name="warehouse_quantity" value="{{ $medicin['WAREHOUSE_QUANTITY'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputKategoriaLeku" class="col-md-2 col-form-label">Kategoria Leku:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputKategoriaLeku" name="drug_category" value="{{ $medicin['DRUG_CATEGORY'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputCena" class="col-md-2 col-form-label">Cena:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputCena" name="price" value="{{ $medicin['PRICE'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputDawkaJednostka" class="col-md-2 col-form-label">Dawka jednostka:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputDawkaJednostka" name="dose_unit" value="{{ $medicin['DOSE_UNIT'] }}">
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

