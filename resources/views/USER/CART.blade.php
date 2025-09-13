@extends('USER.User')
@section('title', 'Cart')
@section('content')
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @php $cart = session('cart', []); @endphp

        @if(count($cart) === 0)
            <h1>Your cart is empty.</h1>
        @else
            <div class="card-header" style="background-color: #7a4eb0;">
                <h2 class="text-white">Your Cart</h2>
            </div>
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grand = 0; @endphp
                    @foreach($cart as $pid => $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grand += $total;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . ($item['image'] ?? 'placeholder.png')) }}" alt="{{ $item['name'] }}"
                                    style="inline-size:100px; hblock-size:100px; object-fit:cover;">
                            </td>

                            <td class="justify-content-center align-content-center">{{ $item['name'] }}</td>
                            <td class="justify-content-center align-content-center">{{ number_format($item['price'], 2) }}</td>

                            <td class="justify-content-center align-content-center">
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('DEC', $pid) }}" method="POST" class="me-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="fa-solid fa-minus"></i></button>
                                    </form>

                                    <span class="mx-2">{{ $item['quantity'] }}</span>

                                    <form action="{{ route('INC', $pid) }}" method="POST" class="ms-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td class="justify-content-center align-content-center">{{ number_format($total, 2) }}</td>
                            <td class="justify-content-center align-content-center">
                                <form action="{{ route('Removecart', $pid) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                        <td colspan="2"><strong>{{ $grand }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
@endsection
