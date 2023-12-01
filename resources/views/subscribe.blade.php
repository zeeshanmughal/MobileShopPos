@extends('layouts.retailer')

@section('content')
    <!-- resources/views/subscribe.blade.php -->

    <form id="payment-form" action="{{ url('/subscribe') }}" method="post">
        @csrf
        <input id="card-holder-name" type="text">
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
        <button id="card-button">
            Update Payment Method
        </button>
    </form>
@endsection


@push('js')
    <!-- In your Blade view, e.g., subscribe.blade.php -->
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Include the script to initialize Stripe Elements -->
    <script>
        const stripe = Stripe('{{ config('cashier.key') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
    </script>
    <script>
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                // The card has been verified successfully...
            }
        });
    </script>
    <script>
// resources/js/your-stripe-js-file.js

document.addEventListener('DOMContentLoaded', function () {
    var stripe = Stripe('{{ config('cashier.key') }}');
    var elements = stripe.elements();

    // Create an instance of the card Element.
    var card = elements.create('card');

    // Add an instance of the card Element into the `card-element` div.
    card.mount('#card-element');

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createPaymentMethod('card', card).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the PaymentMethod ID to your server.
                stripeTokenHandler(result.paymentMethod);
            }
        });
    });

    function stripeTokenHandler(paymentMethod) {
        // Insert the token ID into the form so it gets submitted to the server.
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'paymentMethod');
        hiddenInput.setAttribute('value', paymentMethod.id);
        form.appendChild(hiddenInput);

        // Submit the form.
        form.submit();
    }
});


    </script>
@endpush
