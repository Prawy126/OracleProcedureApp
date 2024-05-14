<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('shared.head')

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-5">
        <a class="navbar-brand" href="#">Szpital</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    @include('shared.scripts')

    <div class="container">
        <div class="row justify-content-center mt-5">
          <div class="col-md-6">
            <h2 class="text-center mb-4">Logowanie</h2>
            <form>
              <div class="form-group mb-4">
                <label for="exampleInputEmail1">Login</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <div class="form-group mb-4">
                <label for="exampleInputPassword1">Hasło</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
            </form>
          </div>
        </div>
      </div>

    @include('shared.footer')

</body>

</html>
