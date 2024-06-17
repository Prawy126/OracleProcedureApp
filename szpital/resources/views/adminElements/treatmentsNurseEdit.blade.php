<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
@include('shared.head')
<body>
@include('shared.navbar')
@include('shared.scripts')
<div class="container mt-5 mb-4">
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <h2 class="mb-4">Edytuj Przypisanie Pielęgniarki</h2>
    <form action="{{ route('treatmentNurses.update', $treatmentNurse['ID']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nurseId">Id pielęgniarki</label>
                <select id="nurseId" class="form-select" name="nurse_id">
                    @foreach($nurses as $nurse)
                        <option value="{{ $nurse->id }}" {{ $nurse->id == $treatmentNurse['NURSE_ID'] ? 'selected' : '' }}>
                            {{ $nurse->id }} {{ $nurse->name }} {{ $nurse->surname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="procedureId">Id zabiegu</label>
                <select id="procedureId" class="form-select" name="procedure_id">
                    @foreach($procedures as $procedure)
                        <option value="{{ $procedure->id }}" {{ $procedure->id == $treatmentNurse['PROCEDURE_ID'] ? 'selected' : '' }}>
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
