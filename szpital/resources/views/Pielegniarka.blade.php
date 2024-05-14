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
        <h2 class="mb-4">Witaj Pielęgniarka!</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba zabiegów na dziś:</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pacjentów pod nadzorem: </h5>
                        <p class="card-text">45</p>
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
                                    <th scope="col">Column 1</th>
                                    <th scope="col">Column 2</th>
                                    <th scope="col">Column 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1, Cell 1</td>
                                    <td>Row 1, Cell 2</td>
                                    <td>Row 1, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 2, Cell 1</td>
                                    <td>Row 2, Cell 2</td>
                                    <td>Row 2, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 3, Cell 1</td>
                                    <td>Row 3, Cell 2</td>
                                    <td>Row 3, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 4, Cell 1</td>
                                    <td>Row 4, Cell 2</td>
                                    <td>Row 4, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 5, Cell 1</td>
                                    <td>Row 5, Cell 2</td>
                                    <td>Row 5, Cell 3</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary">Zobacz więcej</a>
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
                                    <th scope="col">Column 1</th>
                                    <th scope="col">Column 2</th>
                                    <th scope="col">Column 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1, Cell 1</td>
                                    <td>Row 1, Cell 2</td>
                                    <td>Row 1, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 2, Cell 1</td>
                                    <td>Row 2, Cell 2</td>
                                    <td>Row 2, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 3, Cell 1</td>
                                    <td>Row 3, Cell 2</td>
                                    <td>Row 3, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 4, Cell 1</td>
                                    <td>Row 4, Cell 2</td>
                                    <td>Row 4, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 5, Cell 1</td>
                                    <td>Row 5, Cell 2</td>
                                    <td>Row 5, Cell 3</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary">Zobacz więcej</a>
                    </div>
                </div>
            </div>

        </div>


        @include('shared.footer')

</body>

</html>
