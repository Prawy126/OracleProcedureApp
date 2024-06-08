<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Zalecenia przed operacją</th>
                    <th scope="col">Zalecenia po operacji</th>
                    <th scope="col">Utworzono</th>
                    <th scope="col">Zaktualizowano</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($treatmentTypes as $treatmentType)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $treatmentType->ID }}</td>
                    <td>{{ $treatmentType->NAME }}</td>
                    <td>{{ $treatmentType->DESCRIPTION }}</td>
                    <td>{{ $treatmentType->RECOMMENDATIONS_BEFORE_SURGERY }}</td>
                    <td>{{ $treatmentType->RECOMMENDATIONS_AFTER_SURGERY }}</td>
                    <td>{{ $treatmentType->CREATED_AT }}</td>
                    <td>{{ $treatmentType->UPDATED_AT }}</td>
                    <td><a href="{{ route('treatmentTypes.edit', $treatmentType->ID) }}">Edytuj</a></td>
                    <td>
                        <form action="{{ route('treatmentTypes.destroy', $treatmentType->ID) }}" method="POST">
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

<div class="container">
    <h2 class="mt-4">Dodawanie Rodzaju Zabiegu</h2>
    <form action="{{ route('treatmentTypes.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-1">
                <input type="number" class="form-control" name="id" placeholder="ID">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="name" placeholder="Nazwa">
            </div>
            <div class="form-group col-md-2">
                <textarea class="form-control" name="description" placeholder="Opis"></textarea>
            </div>
            <div class="form-group col-md-2">
                <textarea class="form-control" name="recommendations_before_surgery" placeholder="Zalecenia przed operacją"></textarea>
            </div>
            <div class="form-group col-md-2">
                <textarea class="form-control" name="recommendations_after_surgery" placeholder="Zalecenia po operacji"></textarea>
            </div>
            <div class="form-group col-md-1">
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </div>
        </div>
    </form>
</div>
