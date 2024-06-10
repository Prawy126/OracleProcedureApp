<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
@include('shared.head')
<body>
    @include('shared.navbar')
    @include('shared.scripts')

    <div class="container">
        <h2 class="mt-4">Edycja Statusu</h2>
        <form action="{{ route('statusesUpdate', $status['ID']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="inputStatus">Status</label>
                    <input type="text" class="form-control" name="status" id="inputStatus" placeholder="Status" value="{{ $status->['STATUS'] }}" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputDescription">Opis</label>
                    <input type="text" class="form-control" name="description" id="inputDescription" placeholder="Opis" value="{{ $status-['DESCRIPTION'] }}" required>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Aktualizuj</button>
                </div>
            </div>
        </form>
    </div>

    @include('shared.footer')
</body>
</html>
