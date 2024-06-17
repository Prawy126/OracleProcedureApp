<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Leki</h2>
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
                        <th scope="col">Nazwa</th>
                        <th scope="col">Instrukcja</th>
                        <th scope="col">Ilość w magazynie</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Dawka jednostka</th>
                        <th scope="col">Edytuj</th>
                        <th scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($medicines as $med)
                        <tr>
                            <th scope="row">{{ $med->id }}</th>
                            <td>{{ $med->name }}</td>
                            <td>{{ $med->instruction }}</td>
                            <td>{{ $med->warehouse_quantity }}</td>
                            <td>{{ $med->drug_category }}</td>
                            <td>{{ $med->price }}</td>
                            <td>{{ $med->dose_unit }}</td>
                            <td><a href="{{ route('medicinEdit', $med->id) }}" class="btn btn-warning">Edytuj</a></td>
                            <td>
                                <form action="{{ route('medicinDelete', $med->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="9">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mb-12" style="padding-bottom: 50px;">
        <h2 class="mt-4">Dodawanie leku</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('medicinStore') }}">
            @csrf
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputNazwaLeku">Nazwa leku</label>
                        <input type="text" class="form-control" id="inputNazwaLeku" name="name"
                            placeholder="Nazwa leku" required>
                    </div>
                    <div class="form-group">
                        <label for="inputInstrukcja">Instrukcja</label>
                        <textarea class="form-control" id="inputInstrukcja" name="instruction" rows="6" placeholder="Instrukcja" required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputFormaLeku">Forma leku</label>
                        <select class="form-select" id="inputFormaLeku" name="drug_form" required>
                            <option value="tabletki">Tabletki</option>
                            <option value="syrop">Syrop</option>
                            <option value="zastrzyk">Zastrzyk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputIloscMagazyn">Ilość w magazynie</label>
                        <input type="number" class="form-control" id="inputIloscMagazyn" name="warehouse_quantity"
                            placeholder="Ilość w magazynie" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="inputKategoriaLeku">Kategoria Leku</label>
                        <select class="form-select" id="inputKategoriaLeku" name="drug_category" required>
                            <option value="przeciwbólowe">Przeciwbólowe</option>
                            <option value="antybiotyki">Antybiotyki</option>
                            <option value="przeciwwirusowe">Przeciwwirusowe</option>
                            <option value="przeciwzapalne">Przeciwzapalne</option>
                            <option value="przeciwgorączkowe">Przeciwgorączkowe</option>
                            <option value="przeciwhistaminowe">Przeciwhistaminowe</option>
                            <option value="diuretyki">Diuretyki</option>
                            <option value="leki_na_nadciśnienie">Leki na nadciśnienie</option>
                            <option value="leki_na_cukrzycę">Leki na cukrzycę</option>
                            <option value="leki_na_choroby_serca">Leki na choroby serca</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputCena">Cena</label>
                        <input type="number" class="form-control" id="inputCena" name="price" placeholder="Cena"
                            min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="inputDawkaJednostka">Dawka jednostka</label>
                        <select class="form-select" id="inputDawkaJednostka" name="dose_unit" required>
                            <option value="" disabled selected>Wybierz jednostkę</option>
                            <option value="mililitr">Mililitr</option>
                            <option value="tabletka">Tabletka</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>

</html>
