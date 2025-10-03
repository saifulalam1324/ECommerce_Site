@extends('ADMIN.Admin')
@section('title', 'Admin Vendors')

@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #081621;">
            <h2 class="text-white text-center">All Vendors</h2>
        </div>

        @if (session('info'))
            <div class="alert alert-info mt-5">
                {{ session('info') }}
            </div>
        @endif

        @if ($vendors->isEmpty())
            <div class="alert alert-danger mt-5">
                No vendors found.
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
                        <li class="list-group-item"><strong>Email:</strong> {{ $vendor->email }}</li>
                    </ul>
                    <div class="text-end mt-3">
                        <a href="{{ route('Each vendors', $vendor->vendor_id) }}" class="btn text-white" style="background-color:#081621">
                            More..
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $vendors->links() }}
        </div>
    </div>
@endsection
