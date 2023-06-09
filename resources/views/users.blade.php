@extends('./layouts/main-layout')
@section('main')
    <div class="container mt-3 mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="search-bar">
                    <form action="{{ route('searchUsers') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search by name">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                    <table class="table manage-candidates-top mb-0">
                        <thead>
                            <tr>
                                <th>Clientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <x-user-tile :user="$user" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
