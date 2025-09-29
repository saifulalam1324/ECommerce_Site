@extends('ADMIN.Admin')
@section('title', 'Vendors Requests')

@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        <!-- Fixed header bar -->
        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #7a4eb0;">
            <h2 class="text-white text-center">Vendors Requests</h2>
        </div>

        @if ($vendors->isEmpty())
            <div class="alert alert-danger mt-5">
                No vendor requests found.
            </div>
        @endif

        @foreach ($vendors as $vendor)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color: #7a4eb0;">
                    <strong>Vendor ID:</strong> {{ $vendor->vendor_id ?? 'N/A' }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Company Name:</strong> {{ $vendor->company_name }}</li>
                    </ul>
                    <div class="text-end mt-3">
                        <form action="{{ route('ApproveRequest', $vendor->vendor_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success text-white">Accept</button>
                        </form>
                        <form action="{{ route('DeleteRequest', $vendor->vendor_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger text-white">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $vendors->links() }}
        </div>
    </div>
@endsection
