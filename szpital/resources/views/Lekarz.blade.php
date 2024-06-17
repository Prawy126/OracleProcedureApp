<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="container mt-5 mb-4">
        <h2 class="mb-4">Witaj Lekarz!</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba zabiegów na dziś:</h5>
                        <p class="card-text">{{ $proceduresCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Planowane zabiegi:</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nazwa Zabiegu</th>
                        <th scope="col">Numer Sali</th>
                        <th scope="col">Data</th>
                        <th scope="col">Czas</th>
                        <th scope="col">Koszt</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($procedures as $procedure)
                        <tr>
                            <th>{{ $procedure->id }}</th>
                            <td>{{ $procedure->treatment_name }}</td>
                            <td>{{ $procedure->room_number }}</td>
                            <td>{{ \Carbon\Carbon::parse($procedure->date)->format('Y-m-d') }}</td>
                            <td>{{ $procedure->time }}</td>
                            <td>{{ $procedure->cost }}</td>
                            <td>
                                @switch($procedure->status)
                                    @case(1)
                                        <span class="badge bg-warning">Przed zabiegiem</span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-danger">W trakcie zabiegu</span>
                                    @break

                                    @case(3)
                                        <span class="badge bg-success">Po zabiegu</span>
                                    @break

                                    @default
                                        <span class="badge bg-secondary">Nieznany</span>
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('shared.footer')

</body>

</html>
