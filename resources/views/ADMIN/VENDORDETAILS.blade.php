@extends('ADMIN.Admin')
@section('title', 'Vendor Details')
@section('content')
    <div class="container-fluid pl-5 pt-4 ml-3 justify-content-center align-items-center">
        <div class="card text-left">
            <div class="card-body">
                @foreach ($vendors as $id => $data)
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">{{$data->company_name}}</p>
                    <p class="card-text">{{$data->email}}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection