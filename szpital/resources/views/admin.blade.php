<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>

    @include('shared.navbar')

    @include('shared.scripts')

    <div class="container mt-5 mb-4">
        <h2 class="mb-4">Statystyki:</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba pacjentów:</h5>
                        <p class="card-text">{{$stats['patient_count']}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Zaplanowanych zabiegów: </h5>
                        <p class="card-text">{{$stats['procedure_count']}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba lekarzy:</h5>
                        <p class="card-text">{{$stats['doctor_count']}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba pielęgniarek:</h5>
                        <p class="card-text">{{$stats['nurse_count']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{route('accounts')}}">Konta</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('treatmentDoctor.index')}}">Zabiegi-Lekarze</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('assigmentMedicin.index')}}">Przypisania leków</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('treatmentNurses.index')}}">Zabiegi-Pielęgniarki</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h2>Zabiegi:</h2>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{route('proceduresIndex')}}">Zabiegi tab</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('treatmentTypes.index')}}">Typy zabiegów</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('statusIndex')}}">Statusy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-5 mb-4">
        <div class="row">

        </div>

        @include('shared.footer')
    </div>

</body>

</html>
