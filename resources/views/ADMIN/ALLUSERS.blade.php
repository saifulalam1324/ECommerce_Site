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
         <div class="container">
            <h3>Total: {{ count($customers) }}</h3>
        </div>
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
                        <a href="javascript:void(0)" class="btn text-white" style="background-color:#081621" data-toggle="modal"
                            data-target="#userModal{{ $user->customer_id }}">
                            More..
                        </a>
                    </div>
                </div>
            </div>


            <div class="modal fade m-5" id="userModal{{ $user->customer_id }}" tabindex="-1" role="dialog"
                aria-labelledby="userModalLabel{{ $user->customer_id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#081621;">
                            <h5 class="modal-title text-white" id="userModalLabel{{ $user->customer_id }}">
                                User Details (ID: {{ $user->customer_id }})
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Full Name:</strong> {{ $user->full_name }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                                <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone_number }}</li>
                                <li class="list-group-item"><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</li>
                                <li class="list-group-item"><strong>Joined On:</strong> {{ $user->created_at ?? 'N/A' }}</li>
                            </ul>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
