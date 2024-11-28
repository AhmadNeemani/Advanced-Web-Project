@extends('layout')

@section('title', 'Your Cart')

@section('content')
<div class="orders-container">
    <h1>Your Cart</h1>

    <div class="order-list">
        @foreach ($cartItems as $item)
            <div class="order-item" data-id="{{ $item->product_id }}">
                <div class="img_container"
                    style="background-image: url('{{ $item->image ? asset('storage/' . $item->image) : asset('pics/default.jpg') }}');">
                </div>
                <div>
                    <div class="item-details">
                        <h3>{{ $item->name }}</h3>
                        <span class="price_quant">
                            <p><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                        </span>
                        <p>
                            <strong>Availability:</strong>
                            @if ($item->stock > 0)
                                <span style="color: green;">In Stock</span>
                            @else
                                <span style="color: red;">Out of Stock</span>
                            @endif
                        </p>
                    </div>
                    <div class="item-quantity">
                        <button class="decrease-qty">-</button>
                        <p class="quantity-display" data-id="{{ $item->product_id }}" data-stock="{{ $item->stock }}">
                            {{ $item->cart_quantity }}
                        </p>
                        <button class="increase-qty">+</button>

                        <button class="removeBtn" data-id="{{ $item->product_id }}">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="checkout-button-container">
    <a href="{{ route('checkout') }}" class="checkout-button">Proceed to Checkout</a>
</div>



@endsection

<style>
    .checkout-button-container {
        margin-top: 10px; /* Reduce the space above the button */
        display: flex;
        justify-content: center; /* Center-align the button */
    }
    
    .checkout-button {
        display: inline-block;
        padding: 15px 30px;
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #ff4c61;
        color: white;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }
    
    .checkout-button:hover {
        background-color: #e04356;
    }
    </style>
    
    

@push('scripts')
    @vite('resources/js/orders.js')
@endpush
