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
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Zaplanowanych zabiegów: </h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba lekarzy:</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba pielęgniarek:</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="?view=accounts">Accounts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?view=doctorsTreatments">Doctors Treatments</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?view=medicineAssignment">Medicine Assignment</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?view=nurseAssignment">Nurse Assignment</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?view=nurseTreatments">Nurse Treatments</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if ($view == 'accounts')
                    @include('adminElements.accounts')
                @elseif($view == 'doctorsTreatments')
                    @include('adminElements.doctorsTreatments')
                @elseif($view == 'medicineAssignment')
                    @include('adminElements.medicineAssignment')
                @elseif($view == 'nurseAssignment')
                    @include('adminElements.nurseAssignment')
                @elseif($view == 'nurseTreatments')
                    @include('adminElements.nurseTreatments')
                @else
                    <p>Wybierz opcję z menu po lewej stronie.</p>
                @endif
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
