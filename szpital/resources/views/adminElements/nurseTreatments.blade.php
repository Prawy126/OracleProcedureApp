<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <form action="{{ route('treatmentNurses.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nurseId">Id pielęgniarki</label>
                    <select id="nurseId" class="form-select" name="nurse_id">
                        @foreach($data['nurses'] as $nurse)
                            <option value="{{ $nurse->id }}">{{ $nurse->id }} {{ $nurse->name }} {{ $nurse->surname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="procedureId">Id zabiegu</label>
                    <select id="procedureId" class="form-select" name="procedure_id">
                        @foreach($data['procedures'] as $procedure)
                            <option value="{{ $procedure->id }}">{{ $procedure->id }} {{ $procedure->date }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Prześlij</button>
        </form>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Stan pielęgniarki:</h5>
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th scope="col">Nurse ID</th>
                            <th scope="col">Procedure ID</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['treatmentNurses'] as $treatmentNurse)
                            <tr>
                                <td>{{ $treatmentNurse->nurse_id }}</td>
                                <td>{{ $treatmentNurse->procedure_id }}</td>
                                <td>
                                    <a href="{{ route('treatmentNurses.edit', $treatmentNurse->id) }}" class="btn btn-warning">Edytuj</a>
                                    <form action="{{ route('treatmentNurses.destroy', $treatmentNurse->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Brak danych.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('shared.footer')

</html>
