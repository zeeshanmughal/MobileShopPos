@extends('layouts.retailer')

@section('content')
    <!-- resources/views/subscribe.blade.php -->

    <form action="{{ route('subscribe') }}" method="post" id="subscription-form">
        @csrf
        <div class="form-group">
            <label for="cardholder-name">Cardholder Name</label>
            <input type="text" id="cardholder-name" name="cardholder_name" required>
        </div>
        <div class="form-group">
            <label for="card-element">Card Details</label>
            <div id="card-element"></div>
        </div>
        <!-- Additional input fields for card details -->
        <div class="form-group">
            <label for="card-expiry">Expiration Date</label>
            <div id="card-expiry"></div>
        </div>
        <div class="form-group">
            <label for="card-cvc">CVC</label>
            <div id="card-cvc"></div>
        </div>
        <button type="submit">Subscribe</button>
    </form>
@endsection


@push('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ config('cashier.key') }}');
    var elements = stripe.elements();

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                lineHeight: '40px',
                fontWeight: 300,
                fontFamily: 'Helvetica Neue, Helvetica, sans-serif',
                fontSize: '18px',
                '::placeholder': {
                    color: '#CFD7E0',
                },
            },
        },
    });

    // Add an instance of the card Element into the `card-element` div.
    card.mount('#card-element');

    // Create an instance of the exp-date Element.
    var expDate = elements.create('cardExpiry', {
        style: {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                lineHeight: '40px',
                fontWeight: 300,
                fontFamily: 'Helvetica Neue, Helvetica, sans-serif',
                fontSize: '18px',
                '::placeholder': {
                    color: '#CFD7E0',
                },
            },
        },
    });

    // Add an instance of the exp-date Element into the `card-expiry` div.
    expDate.mount('#card-expiry');

    // Create an instance of the cvc Element.
    var cvc = elements.create('cardCvc', {
        style: {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                lineHeight: '40px',
                fontWeight: 300,
                fontFamily: 'Helvetica Neue, Helvetica, sans-serif',
                fontSize: '18px',
                '::placeholder': {
                    color: '#CFD7E0',
                },
            },
        },
    });

    // Add an instance of the cvc Element into the `card-cvc` div.
    cvc.mount('#card-cvc');

    // Handle form submission.
    var form = document.getElementById('subscription-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent repeated clicks.
        form.querySelector('button').disabled = true;

        // Create a PaymentMethod using the card Element.
        stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: document.getElementById('cardholder-name').value,
            },
        }).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

                // Enable the submit button.
                form.querySelector('button').disabled = false;
            } else {
                // Send the PaymentMethod ID to your server.
                stripeTokenHandler(result.paymentMethod);
            }
        });
    });

    // Submit the form with the PaymentMethod ID.
    function stripeTokenHandler(paymentMethod) {
        // Insert the PaymentMethod ID into the form so it gets submitted to the server.
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', paymentMethod.id);
        form.appendChild(hiddenInput);

        // Submit the form.
        form.submit();
    }

</script>
@endpush
