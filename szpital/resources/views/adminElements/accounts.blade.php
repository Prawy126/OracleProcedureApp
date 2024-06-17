<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container mt-3">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group col-md-3 mb-2">
                <input type="text" class="form-control" name="login" placeholder="login" required>
            </div>
            <div class="form-group col-md-3 mb-2">
                <input type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <div class="form-group col-md-3 mb-2">
                <label for="roleSelect">Wybierz poziom uprawnień:</label>
                <select class="form-select" id="roleSelect" name="account_type" required>
                    <option value="3">Lekarz</option>
                    <option value="2">Pielęgniarka</option>
                    <option value="4">Pacjent</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <div class="form-group col-md-1 mb-2">
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </div>
        </form>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title mb-4">Konta:</h5>
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Login</th>
                            <th scope="col">Rodzaj</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->login }}</td>
                                <td>{{ $user->account_type }}</td>
                                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edytuj</a>
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
    </div>

    @include('shared.footer')

</html>
