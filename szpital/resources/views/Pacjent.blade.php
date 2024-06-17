<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')


    <div class="container mt-5 mb-4">
        <div class="row">
            <h2 class="mb-4">Witaj Pacjent!</h2>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Planowane zabiegi:</h2>
        @foreach($procedures as $procedure)
            <div class="card p-3 mb-3">
                <div class="row">
                    <span>Rodzaj zabiegu: {{ $procedure->treatment_type_name }}</span>
                </div>
                <div class="row">
                    <span>Sala: {{ $procedure->room_number }}</span>
                </div>
                <div class="row">
                    <span>Data zabiegu: {{ $procedure->date }}</span>
                </div>
                <div class="row">
                    <span>Zalecenia przed zabiegiem: {{ $procedure->recommendations_before_surgery }}</span>
                </div>
                <div class="row">
                    <span>Zalecenia po zabiegu: {{ $procedure->recommendations_after_surgery }}</span>
                </div>
            </div>
        @endforeach
    </div>


    <div class="container-fluid mt-4" style="margin-bottom: 100px">
        <h2>Przypisania leki:</h2>
        <div class="table-responsive">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Instrukcja</th>
                        <th>Ilość w magazynie</th>
                        <th>Kategoria</th>
                        <th>Forma</th>
                        <th>Cena</th>
                        <th>Dawka</th>
                        <th>Data rozpoczęcia</th>
                        <th>Data zakończenia</th>
                        <th>Data ważności</th>
                        <th>Dostępność</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $medicine)
                        <tr>
                            <td>{{ $medicine->name }}</td>
                            <td>{{ $medicine->instruction }}</td>
                            <td>{{ $medicine->warehouse_quantity }}</td>
                            <td>{{ $medicine->drug_category }}</td>
                            <td>{{ $medicine->drug_form }}</td>
                            <td>{{ $medicine->price }}</td>
                            <td>{{ $medicine->dose }}</td>
                            <td>{{ $medicine->date_start }}</td>
                            <td>{{ $medicine->date_end }}</td>
                            <td>{{ $medicine->expiration_date }}</td>
                            <td>{{ $medicine->availability }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>

      @include('shared.footer' )

</body>

</html>
