@extends('ADMIN.Admin')
@section('title', 'vendors requests')

@section('content')
    <div class="container-fluid pl-5 mt-5 pt-3 ml-3 justify-content-center align-items-center overflow-hidden">

        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #7a4eb0;">
            <h2 class="text-white text-center">Vendors Requests</h2>
        </div>
        <table class="table table-bordered mt-5 table-striped" style="table-layout: fixed;">
            <thead style="background-color: #7a4eb0; color: white; text-align: center;">
                <tr>
                    <th style="inline-size:35%;">Company Name</th>
                    <th style="inline-size:20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $data)
                    <tr>
                        <td>{{ $data->company_name }}</td>
                        <td class="text-center">
                            <form action="{{ route('ApproveRequest', $data->vendor_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success text-white">Accept</button>
                            </form>
                            <form action="{{ route('DeleteRequest', $data->vendor_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="d-flex justify-content-center mt-3">
            {{ $vendors->links() }}
        </div>
    </div>
@endsection
