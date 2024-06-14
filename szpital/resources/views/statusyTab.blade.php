<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
@include('shared.head')
<body>
    @include('shared.navbar')
    @include('shared.scripts')



    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opis</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statuses as $status)
                        <tr>
                            <th scope="row">{{ $status->id }}</th>
                            <td>{{ $status->status }}</td>
                            <td>{{ $status->description }}</td>

                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    @include('shared.footer')
</body>
</html>
