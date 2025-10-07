@extends('ADMIN.Admin')
@section('title', 'Admin Vendors')

@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
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
                        <a href="javascript:void(0)" class="btn text-white" style="background-color:#081621" data-toggle="modal"
                            data-target="#productModal{{ $vendor->vendor_id }}">
                            More..
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal fade m-5" id="productModal{{ $vendor->vendor_id }}" tabindex="-1" role="dialog"
                aria-labelledby="productModalLabel{{ $vendor->vendor_id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#081621;">
                            <h5 class="modal-title text-white" id="productModalLabel{{ $vendor->vendor_id }}">
                                Vendor Details (ID: {{ $vendor->vendor_id }})
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Company Name:</strong> {{ $vendor->company_name }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $vendor->email }}</li>
                                <li class="list-group-item"><strong>Joined:</strong> {{ $vendor->created_at}}</li>
                                <li class="list-group-item"><strong>Totale Sale:</strong> {{ $vendor->total_sale }}</li>
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
            {{ $vendors->links() }}
        </div>
    </div>
@endsection
