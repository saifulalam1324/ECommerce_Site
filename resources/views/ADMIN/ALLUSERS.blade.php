@extends('ADMIN.Admin')
@section('title', 'Admin Users')

@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        @if (session('info'))
            <div class="alert alert-info mt-5">
                {{ session('info') }}
            </div>
        @endif

        @if ($customers->isEmpty())
            <div class="alert alert-danger mt-5">
                No users found.
            </div>
        @endif

        @foreach ($customers as $user)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color: #081621;">
                    <strong>User ID:</strong> {{ $user->customer_id ?? 'N/A' }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> {{ $user->full_name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone_number }}</li>
                    </ul>
                    <div class="text-end mt-3">
                        <a href="#" class="btn text-white" style="background-color:#081621">
                            More..
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
