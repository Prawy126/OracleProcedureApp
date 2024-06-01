<div class="col-md-12">
    <form action="" method="POST">
        <div class="form-group col-md-3">
            <input type="text" class="form-control" name="login" placeholder="login">
        </div>
        <div class="form-group col-md-3">
            <input type="password" class="form-control" name="password" placeholder="password">
        </div>
        <div class="form-group col-md-3">
            <label for="roleSelect">Wybierz poziom uprawnień:</label>
            <select class="form-select" id="roleSelect" name="account_type">
                <option value="lekarz">Lekarz</option>
                <option value="pielegniarka">Pielęgniarka</option>
                <option value="pacjent">Pacjent</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-group col-md-1">
            <button type="submit" class="btn btn-primary">Dodaj</button>
        </div>
    </form>
    <div class="card">
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
                    <!--TODO: implement this 🧟-->
                    <td><a href="" class="btn btn-warning">Edytuj</a></td>
                    <td>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Usuń</button>
                        </form>
                    </td>
                </tbody>
            </table>
        </div>
    </div>
</div>
