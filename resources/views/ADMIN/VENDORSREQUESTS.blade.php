@extends('ADMIN.Admin')
@section('title', 'Vendors Requests')

@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        @if ($vendors->isEmpty())
            <div class="alert alert-danger mt-5">
                No vendor requests found.
            </div>
        @endif

        @foreach ($vendors as $vendor)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color: #081621;">
                    <strong>Vendor ID:</strong> {{ $vendor->vendor_id ?? 'N/A' }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Company Name:</strong> {{ $vendor->company_name }}</li>
                    </ul>
                    <div class="text-end mt-3">
                        <form action="{{ route('ApproveRequest', $vendor->vendor_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn text-white" style="background-color: #081621">Accept</button>
                        </form>
                        <form action="{{ route('DeleteRequest', $vendor->vendor_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn text-white" style="background-color: #081621">Delete</button>
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
