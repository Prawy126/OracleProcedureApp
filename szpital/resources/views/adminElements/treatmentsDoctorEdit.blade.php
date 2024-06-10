<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
@include('shared.head')
<body>
@include('shared.navbar')
@include('shared.scripts')
<div class="container mt-5 mb-4">
    <h2 class="mb-4">Edytuj Przypisanie Lekarza</h2>
    <form action="{{ route('treatmentDoctors.update', $treatmentDoctor['PROCEDURE_ID']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="doctorId">Id lekarza</label>
                <select id="doctorId" class="form-select" name="doctor_id">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $doctor->id == $treatmentDoctor['DOCTOR_ID'] ? 'selected' : '' }}>
                            {{ $doctor->id }} {{ $doctor->name }} {{ $doctor->surname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="procedureId">Id zabiegu</label>
                <select id="procedureId" class="form-select" name="procedure_id" disabled>
                    @foreach($procedures as $procedure)
                        <option value="{{ $procedure->id }}" {{ $procedure->id == $treatmentDoctor['PROCEDURE_ID'] ? 'selected' : '' }}>
                            {{ $procedure->id }} {{ $procedure->date }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Zaktualizuj</button>
    </form>
</div>
@include('shared.footer')
</body>
</html>
