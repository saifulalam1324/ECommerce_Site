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
            <div class="card-header shadow card-body" style="background-color: #081621;">
                <h2 class="text-white">Your Cart</h2>
            </div>
            <table class="table mb-5">
                <thead>
                    <tr class="text-center">
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grand = 0;
                        $grandDiscounted = 0;
                    @endphp
                    @foreach($cart as $pid => $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $discount = $item['discount'] ?? 0;
                            $discountedPrice = $item['price'] - ($item['price'] * $discount / 100);
                            $discountedTotal = $discountedPrice * $item['quantity'];

                            $grand += $total;
                            $grandDiscounted += $discountedTotal;
                        @endphp
                        <tr class="text-center">
                            <td>
                                <img src="{{ asset('storage/' . ($item['image'] ?? 'placeholder.png')) }}" alt="{{ $item['name'] }}"
                                    style="inline-size:100px; block-size:100px; object-fit:cover;">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ number_format($item['price'], 2) }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
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
                            <td>{{ number_format($total, 2) }}</td>
                            <td>
                                <form action="{{ route('Removecart', $pid) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container fixed-bottom bg-white border-top shadow-lg py-3">
                <div class="container d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        Grand Total: <strong>{{ number_format($grand, 2) }}</strong>
                        @if ($grandDiscounted < $grand) <br>
                            Discounted Total: <strong class="text-success">{{ number_format($grandDiscounted, 2) }}</strong>
                        @endif
                    </h6>
                    <form action="{{ route('Placeorder') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-lg text-white" style="background-color: #081621;">Place
                            Order</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
