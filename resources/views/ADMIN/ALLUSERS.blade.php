@extends('ADMIN.Admin')
@section('title', 'Admin Users')

@section('content')
    <div class="container-fluid pl-5 mt-5 pt-3 ml-3 justify-content-center align-items-center overflow-hidden">
        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #7a4eb0;">
            <h2 class="text-white text-center">All Users</h2>
        </div>

        <table class="table table-bordered table-striped mt-5" style="table-layout: fixed;">
            <thead style="background-color: #7a4eb0; color: white; text-align: center;">
                <tr>
                    <th style="inline-size:20%;">Name</th>
                    <th style="inline-size:20%;">E-mail</th>
                    <th style="inline-size:20%;">Phone</th>
                    <th style="inline-size:20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $id => $data)
                    <tr>
                        <td>{{ $data->full_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone_number }}</td>
                        <td class="text-center">
                            <a href="#" class="btn text-white" style="background-color:#7a4eb0">
                                More..
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
