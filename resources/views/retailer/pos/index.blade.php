@extends('layouts.retailer')
@push('styles')
<style>
    .item-list {
    display: flex;
    flex-wrap: wrap;
}

.item {
    border: 1px solid #ddd;
    margin: 10px;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.item-image {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.item-details {
    text-align: center;
}

.item-sku {
    font-size: 1rem;
    margin-bottom: 5px;
}

.item-name {
    font-size: 14px;
    margin-bottom: 5px;
}

.item-price {
    font-size: 14px;
    margin-bottom: 5px;
}
.small-numeric-input {
        width: 60px; /* Adjust the width as needed */
    }

    </style>
@endpush
@section('content')
    @include('retailer.partials.response_message')
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- List of Categories -->
                <div class="card">
                    <div class="card-header">
                        Categories
                    </div>
                    <ul class="nav nav-pills card-header-pills">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pos.index', ['category' => $category->id]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-8">
                <!-- Display Items -->
                <div class="card">
                    <div class="card-header">
                        Items
                    </div>
                    <div class="card-body">
                        @if(count($items) > 0)
                            <div class="row">
                                @foreach($items as $item)
                                    <div class="col-md-4 mb-4">
                                        @include('retailer.pos.product_card', ['item' => $item])
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No Items found.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Add to Cart Card -->
                @include('retailer.pos.add_to_cart_card')
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    // Initialize an empty cart array
    let cart = [];

    // Function to add items to the cart
    function addToCart(itemName, itemPrice) {
        const quantity = 1; // Default quantity

        // Create a new cart item object
        const cartItem = {
            name: itemName,
            price: itemPrice,
            quantity: quantity
        };

        // Add the item to the cart array
        cart.push(cartItem);

        // Update the cart display
        updateCartDisplay();

        // Optional: You can send the cart data to the server for further processing
        // sendCartToServer();
    }

    // Function to update the cart display
    function updateCartDisplay() {
        const cartList = document.getElementById('cart-list');
        const totalPriceElement = document.getElementById('total-price');

        // Clear the existing cart items
        cartList.innerHTML = '';

        // Calculate and update the total price
        let totalPrice = 0;

        // Iterate through each item in the cart
        cart.forEach((item, index) => {
            // Create a list item for each item in the cart
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.innerHTML = `
                <div>
                    ${item.name} - $${item.price} x 
                    <input type="number" value="${item.quantity}" class="form-control small-numeric-input" min="1" onchange="updateQuantity(${index}, this.value)">
                    $${(item.price * item.quantity).toFixed(2)}
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">X</button>
            `;

            // Append the list item to the cart list
            cartList.appendChild(listItem);

            // Update the total price
            totalPrice += item.price * item.quantity;
        });

        // Update the total price element
        totalPriceElement.textContent = `Total: $${totalPrice.toFixed(2)}`;
    }

    // Function to remove an item from the cart
    function removeFromCart(index) {
        // Remove the item at the specified index from the cart array
        cart.splice(index, 1);

        // Update the cart display
        updateCartDisplay();
    }

    function updateQuantity(index, newQuantity) {
        // Ensure the new quantity is a positive integer
        newQuantity = Math.max(1, Math.floor(newQuantity));

        // Update the quantity of the item at the specified index
        cart[index].quantity = newQuantity;

        // Update the cart display
        updateCartDisplay();
    }
</script>

@endpush
