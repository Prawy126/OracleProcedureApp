<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')
    <div class="container mt-3">
        <form action="{{ route('users.update', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group col-md-3 mb-2">
                <input type="text" class="form-control" name="login" value="{{ $user->login }}" required>
            </div>
            <div class="form-group col-md-3 mb-2">
                <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <div class="form-group col-md-3 mb-2">
                <label for="roleSelect">Wybierz poziom uprawnień:</label>
                <select class="form-select" id="roleSelect" name="account_type" required>
                    <option value="3" {{ $user->account_type == '3' ? 'selected' : '' }}>Lekarz</option>
                    <option value="2" {{ $user->account_type == '2' ? 'selected' : '' }}>Pielęgniarka</option>
                    <option value="4" {{ $user->account_type == '4' ? 'selected' : '' }}>Pacjent</option>
                    <option value="1" {{ $user->account_type == '1' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="form-group col-md-1 mb-2">
                <button type="submit" class="btn btn-primary">Aktualizuj</button>
            </div>
        </form>
    </div>
    @include('shared.footer')

</body>

</html>
