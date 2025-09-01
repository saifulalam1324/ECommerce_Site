@extends('ADMIN.Admin')
@section('title', 'Admin Vendors')
@section('content')
    <div class="container-fluid pl-5 pt-3 ml-3 justify-content-center align-items-center overflow-hidden">

        <div class="card-header" style="background-color: #7a4eb0;">
            <h5 class="text-center text-white">Vendors</h5>
        </div>

        <table class="table table-bordered table-striped shadow-lg" style="table-layout: fixed;">
            <thead style="background-color: #7a4eb0; color: white; text-align: center;">
                <tr>
                    <th style="inline-size:20%;">Company Name</th>
                    <th style="inline-size:20%;">E-mail</th>
                    <th style="inline-size:20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $data)
                    <tr>
                        <td>{{ $data->company_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('Each vendors', $data->vendor_id) }}" class="btn text-white"
                                style="background-color:#7a4eb0">
                                More..
                            </a>
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