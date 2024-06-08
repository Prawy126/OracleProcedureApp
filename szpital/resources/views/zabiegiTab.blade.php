<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Rodzaje Zabiegów</h2>
        <form action="{{ route('treatmentTypes.index') }}" method="GET">
            <div class="row">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="search" placeholder="Wyszukaj">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Zatwierdź</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')

</body>

</html>
