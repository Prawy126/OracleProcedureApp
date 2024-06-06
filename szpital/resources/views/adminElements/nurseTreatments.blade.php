<div class="col-md-12">
    <form action="" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nurseId">Id pielęgniarki</label>
                <select id="nurseId" class="form-select" name="nurse_id">
                    @foreach($nurses as $nurse)
                        <option value="{{ $nurse->id }}">{{ $nurse->id }} {{ $nurse->name }} {{ $nurse->surname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="procedureId">Id zabiegu</label>
                <select id="procedureId" class="form-select" name="procedure_id">
                    @foreach($procedures as $procedure)
                        <option value="{{ $procedure->id }}">{{ $procedure->id }} {{ $procedure->procedure_name }} {{ $procedure->date }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Prześlij</button>
    </form>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Stan leków:</h5>
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th scope="col">Nurse ID</th>
                        <th scope="col">Procedure ID</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($treatmentNurses as $treatmentNurse)
                        <tr>
                            <td>{{ $treatmentNurse->nurse_id }}</td>
                            <td>{{ $treatmentNurse->procedure_id }}</td>
                            <td><a href="" class="btn btn-warning">Edytuj</a></td>
                            <td>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
                            </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Brak danych.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
