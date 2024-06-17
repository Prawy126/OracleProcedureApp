<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container mt-5 mb-4">
        <h2 class="mb-4">Witaj Pielęgniarka!</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba zabiegów na dziś:</h5>
                        <p class="card-text">{{ $proceduresToday }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pacjentów pod nadzorem: </h5>
                        <p class="card-text">{{ $patientsUnderCare }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Zaplanowane zabiegi na dziś:</h5>
                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Typ Zabiegu</th>
                                    <th scope="col">Sala</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Czas</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayProcedures as $procedure)
                                    <tr>
                                        <td>{{ $procedure->id }}</td>
                                        <td>{{ $procedure->treatment_type_name }}</td>
                                        <td>{{ $procedure->room_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($procedure->date)->format('Y-m-d') }}</td>
                                        <td>{{ $procedure->time }}</td>
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
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Pacjenci pod nadzorem:</h5>
                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">Imię</th>
                                    <th scope="col">Nazwisko</th>
                                    <th scope="col">Pokój</th>
                                    <th scope="col">Czas Wizyty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->surname }}</td>
                                        <td>{{ $patient->room_number }}</td>
                                        <td>{{ $patient->time_visit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer')

</body>

</html>
