<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Lekarze</h2>
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Specjalizacja</th>
                        <th scope="col">Licencja</th>
                        <th scope="col">Id konta</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($doctors as $doc)
                        <tr>
                            <th scope="row">{{ $doc->id }}</th>
                            <td>{{ $doc->name }}</td>
                            <td>{{ $doc->surname }}</td>
                            <td>{{ $doc->specialization }}</td>
                            <td>{{ $doc->license_number }}</td>
                            <td>{{ $doc->user_id }}</td>
                            <td><a href="{{ route('doctorEdit',$doc->id) }}">Edytuj</a></td>
                            <td>
                                <form action="{{ route('doctorDelete', $doc->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="8">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-4">Dodawanie lekarzy</h2>
        <form method="POST" action="{{ route('doctorStore') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputImie" placeholder="Imię" name="name" required maxlength="255">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputNazwisko" placeholder="Nazwisko" name="surname" required maxlength="255">
                </div>
                <div class="form-group col-md-2">
                    <select class="form-select" id="inputSpecjalizacja" name="specialization" required>
                        <option value="kardiologia">Kardiologia</option>
                        <option value="neurologia">Neurologia</option>
                        <option value="ortopedia">Ortopedia</option>
                        <option value="pediatria">Pediatria</option>
                        <option value="dermatologia">Dermatologia</option>
                        <option value="ginekologia">Ginekologia</option>
                        <option value="radiologia">Radiologia</option>
                        <option value="urologia">Urologia</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputNumerLicencji" placeholder="Numer licencji" name="license_number" required >
                </div>
                <div class="form-group col-md-2">
                    <select class="form-select" id="inputIDKonta" name="user_id" required>
                        <option value="" disabled selected>Wybierz konto</option>
                        @foreach($user_ids as $user_id)
                            <option value="{{ $user_id->id }}">{{ $user_id->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>

    </div>

    @include('shared.footer')

</body>

</html>
