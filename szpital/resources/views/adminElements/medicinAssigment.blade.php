<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="col-md-12">
        <form action="" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="medicinId">Id leku</label>
                    <select id="medicinId" class="form-select" name="medicin_id">
                        @foreach($medicins as $medicin)
                            <option value="{{ $medicin->id }}">{{ $medicin->id }} {{ $medicin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="patientId">Id pacjenta</label>
                    <select id="patientId" class="form-select" name="patient_id">
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->id }} {{ $patient->name }} {{ $patient->surname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dose">Dawka</label>
                    <input type="number" class="form-control" id="dose" name="dose" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateStart">Data rozpoczęcia</label>
                    <input type="date" class="form-control" id="dateStart" name="date_start" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateEnd">Data zakończenia</label>
                    <input type="date" class="form-control" id="dateEnd" name="date_end" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expirationDate">Data ważności</label>
                    <input type="date" class="form-control" id="expirationDate" name="expiration_date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="availability">Dostępność</label>
                    <select id="availability" class="form-select" name="availability">
                        <option value="1">Dostępny</option>
                        <option value="0">Niedostępny</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Prześlij</button>
        </form>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Przypisania leki:</h5>
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th scope="col">Id leku</th>
                            <th scope="col">Id pacjenta</th>
                            <th scope="col">Dawka</th>
                            <th scope="col">Data rozpoczęcia</th>
                            <th scope="col">Data zakończenia</th>
                            <th scope="col">Data ważności</th>
                            <th scope="col">Dostępność</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $assignment)
                            <tr>
                                <td>{{ $assignment->medicin_id }}</td>
                                <td>{{ $assignment->patient_id }}</td>
                                <td>{{ $assignment->dose }}</td>
                                <td>{{ $assignment->date_start }}</td>
                                <td>{{ $assignment->date_end }}</td>
                                <td>{{ $assignment->expiration_date }}</td>
                                <td>{{ $assignment->availability ? 'Dostępny' : 'Niedostępny' }}</td>
                                <td><a href="" class="btn btn-warning">Edytuj</a></td>
                                <td>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('shared.footer')

</html>
