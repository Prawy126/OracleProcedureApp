<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edytuj dane: Typy Zabiegów</h2>
        <form method="POST" action="{{ route('treatmentTypes.update', $treatmentType['ID']) }}">
            @csrf
            @method('PUT')
            <div class="form-group row mb-4">
                <label for="inputID" class="col-md-2 col-form-label">ID:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="inputID" name="id" placeholder="ID" value="{{ $treatmentType['ID'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputName" class="col-md-2 col-form-label">Nazwa:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Nazwa" value="{{ $treatmentType['NAME'] }}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputDescription" class="col-md-2 col-form-label">Opis:</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="inputDescription" name="description" placeholder="Opis">{{ $treatmentType['DESCRIPTION'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputRecommendationsBefore" class="col-md-2 col-form-label">Zalecenia przed zabiegiem:</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="inputRecommendationsBefore" name="recommendations_before_surgery" placeholder="Zalecenia przed zabiegiem">{{ $treatmentType['RECOMMENDATIONS_BEFORE_SURGERY'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="inputRecommendationsAfter" class="col-md-2 col-form-label">Zalecenia po zabiegu:</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="inputRecommendationsAfter" name="recommendations_after_surgery" placeholder="Zalecenia po zabiegu">{{ $treatmentType['RECOMMENDATIONS_AFTER_SURGERY'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <div class="offset-md-2 col-md-1">
                    <button type="submit" class="btn btn-primary mb-2">Zatwierdź</button>
                </div>
                <div class="offset-md-1 col-md-1">
                    <a href="{{ route('treatmentTypes.index') }}" class="btn btn-secondary">Wyjście</a>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>
</html>
