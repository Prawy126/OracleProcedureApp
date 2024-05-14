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
        <div class="card p-3">
            <div class="row">
                <span>Rodzaj zabiegu: </span>
            </div>
            <div class="row">
                <span>Sala: </span>
            </div>
            <div class="row">
                <span>Data zabiegu: </span>
            </div>
            <div class="row">
                <span>Zalecenia przed zabiegiem: </span>
            </div>
            <div class="row">
                <span>Zalecenia po zabiegu: </span>
            </div>
        </div>
    </div>


    <div class="container mt-4">
        <h2>Przypisania leki:</h2>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kolumna 0</th>
                <th scope="col">Kolumna 1</th>
                <th scope="col">Kolumna 2</th>
                <th scope="col">Kolumna 3</th>
                <th scope="col">Kolumna 4</th>
                <th scope="col">Kolumna 5</th>
                <th scope="col">Kolumna 6</th>
                <th scope="col">Kolumna 7</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Akcje</td>
                <td>Dane 1</td>
                <td>Dane 2</td>
                <td>Dane 3</td>
                <td>Dane 4</td>
                <td>Dane 5</td>
                <td>Dane 6</td>
                <td>Dane 7</td>
              </tr>
              <tr>
                <th scope="row">1</th>
                <td>Akcje</td>
                <td>Dane 1</td>
                <td>Dane 2</td>
                <td>Dane 3</td>
                <td>Dane 4</td>
                <td>Dane 5</td>
                <td>Dane 6</td>
                <td>Dane 7</td>
              </tr>
              <tr>
                <th scope="row">1</th>
                <td>Akcje</td>
                <td>Dane 1</td>
                <td>Dane 2</td>
                <td>Dane 3</td>
                <td>Dane 4</td>
                <td>Dane 5</td>
                <td>Dane 6</td>
                <td>Dane 7</td>
              </tr>
              <tr>
                <th scope="row">1</th>
                <td>Akcje</td>
                <td>Dane 1</td>
                <td>Dane 2</td>
                <td>Dane 3</td>
                <td>Dane 4</td>
                <td>Dane 5</td>
                <td>Dane 6</td>
                <td>Dane 7</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

      @include('shared.footer')

</body>

</html>
