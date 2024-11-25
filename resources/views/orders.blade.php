@extends('layout')

@section('title', 'Your Orders')

@section('content')
<div class="orders-container">
    <h1>Your Orders</h1>

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

    <div class="user-info">
        <h3>Shipping Information</h3>
        <form method="POST" action="{{ route('orders.place') }}">
            @csrf
            <span> 
                <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </span>
           
            <span>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            </span>
           
            <span>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
            </span>

            <span>
            <label for="address">Address (Building, street, city):</label>
            <textarea id="address" name="address" required></textarea>
            </span>
           <div class="placeorder_container">
           @if ($errors->any())
    <div class="error-messages">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
 
           <button type="submit">Place Order</button></div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/orders.js')
@endpush