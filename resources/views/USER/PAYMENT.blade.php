@extends('USER.User')
@section('title', 'Payment')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header text-white text-center h4" style="background-color: #7a4eb0;">
                        Payment Summary
                    </div>
                    <div class="card-body">
                        <p class="fs-5 text-center mb-4">
                            <strong>Grand Total: </strong>
                            <span class="text-success h4">{{ number_format($grand, 2) }}</span>
                        </p>
                        <form id="stripe-form" method="POST" action="{{ route('payment') }}">
                            @csrf
                            <input type="hidden" name="price" value="{{ $grand }}">
                            <input type="hidden" name="stripeToken" id="stripe-token">
                            <div id="card-element" class="mb-3"></div>
                            <button id="pay-button" type="button" class="btn btn-success btn-lg px-5">
                                Pay Now
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center small">
                        Your payment is processed securely by Stripe.
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        document.getElementById('pay-button').addEventListener('click', () => {
            stripe.createToken(card).then(res => {
                if (res.error) {
                    alert(res.error.message);
                } else {
                    document.getElementById('stripe-token').value = res.token.id;
                    document.getElementById('stripe-form').submit();
                }
            });
        });
    </script>
@endsection
