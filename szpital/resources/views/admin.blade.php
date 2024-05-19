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
  </div>

  <div class="container mt-5 mb-4">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Dostępne Sale:</h5>
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
            <a href="{{ route('roomIndex') }}" class="btn btn">Zarządzaj</a>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Stan leków:</h5>
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
            <a href="{{ route('medicinIndex') }}" class="btn btn">Zarządzaj</a>
          </div>
        </div>
      </div>

    </div>

    @include('shared.footer')

</body>

</html>
