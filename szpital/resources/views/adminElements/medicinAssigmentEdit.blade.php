<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="col-md-12">
        <form action="{{ route('assignmentMedicineUpdate', $assignment['patient_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="medicinId">Id leku</label>
                    <select id="medicinId" class="form-select" name="medicin_id">
                        @foreach($medicins as $medicin)
                            <option value="{{ $medicin->id }}" {{ $medicin->id == $assignment['medicin_id'] ? 'selected' : '' }}>
                                {{ $medicin->id }} {{ $medicin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="patientId">Id pacjenta</label>
                    <select id="patientId" class="form-select" name="patient_id" disabled>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $patient->id == $assignment['patient_id'] ? 'selected' : '' }}>
                                {{ $patient->id }} {{ $patient->name }} {{ $patient->surname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dose">Dawka</label>
                    <input type="number" class="form-control" id="dose" name="dose" value="{{ $assignment['dose'] }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateStart">Data rozpoczęcia</label>
                    <input type="date" class="form-control" id="dateStart" name="date_start" value="{{ $assignment['date_start'] }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateEnd">Data zakończenia</label>
                    <input type="date" class="form-control" id="dateEnd" name="date_end" value="{{ $assignment['date_end'] }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expirationDate">Data ważności</label>
                    <input type="date" class="form-control" id="expirationDate" name="expiration_date" value="{{ $assignment['expiration_date'] }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="availability">Dostępność</label>
                    <select id="availability" class="form-select" name="availability">
                        <option value="1" {{ $assignment['availability'] == '1' ? 'selected' : '' }}>Dostępny</option>
                        <option value="0" {{ $assignment['availability'] == '0' ? 'selected' : '' }}>Niedostępny</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Zaktualizuj</button>
        </form>
    </div>

    @include('shared.footer')

</html>
