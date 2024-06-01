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
                        <th scope="col"></th>
                        <th scope="col"></th>
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
                            <td><a href="{{ route('medicinEdit',$med->id) }}" class="btn btn-warning">Edytuj</a></td>
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
                            <th scope="row" colspan="6">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mb-12" style="padding-bottom: 50px;"> <!--naprawa problemu nie bootstrapowym podejściem-->
        <h2 class="mt-4">Dodawanie leku</h2>
        <form method="POST" action="{{ route('medicinStore') }}">
            @csrf
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputNazwaLeku">Nazwa leku</label>
                        <input type="text" class="form-control" id="inputNazwaLeku" name="name" placeholder="Nazwa leku">
                    </div>
                    <div class="form-group">
                        <label for="inputInstrukcja">Instrukcja</label>
                        <textarea class="form-control" id="inputInstrukcja" name="instruction" rows="6" placeholder="Instrukcja"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputFormaLeku">Forma leku</label>
                        <input type="text" class="form-control" id="inputFormaLeku" name="drug_category" placeholder="Forma leku">
                    </div>
                    <div class="form-group">
                        <label for="inputIloscMagazyn">Ilość w magazynie</label>
                        <input type="number" class="form-control" id="inputIloscMagazyn" name="warehouse_quantity" placeholder="Ilość w magazynie">
                    </div>
                    <div class="form-group">
                        <label for="inputKategoriaLeku">Kategoria Leku</label>
                        <input type="text" class="form-control" id="inputKategoriaLeku" name="drug_category" placeholder="Kategoria Leku">
                    </div>
                    <div class="form-group">
                        <label for="inputCena">Cena</label>
                        <input type="number" class="form-control" id="inputCena" name="price" placeholder="Cena">
                    </div>
                    <div class="form-group">
                        <label for="inputDawkaJednostka">Dawka jednostka</label>
                        <input type="text" class="form-control" id="inputDawkaJednostka" name="dose_unit" placeholder="Dawka jednostka">
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
