@extends('layout')

@section('title', $product->name)

@section('content')
<div class="product-details-container">
    <div class="product-image"
        style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : asset('pics/default.jpg') }}'); background-size: cover; background-position: center;">
        <div class="heart" data-id="{{ $product->id }}">
            <img id="favorite-icon"
                src="{{ $product->isFavorite ? asset('pics/heart_filled.png') : asset('pics/heart.png') }}"
                alt="Favorite" style="cursor: pointer;">
        </div>
    </div>

    <div class="product-info">
        <h1>{{ $product->name }}</h1>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Category:</strong> {{ $product->category->name }}</p>
        <p>
            <strong>Availability:</strong>
            @if($product->quantity > 0)
                <span style="color: green;">In Stock</span>
            @else
                <span style="color: red;">Out of Stock</span>
            @endif
        </p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>In Cart:</strong> <span id="in-cart-quantity">{{ $cartQuantity }}</span></p>

        @if($product->quantity > 0)
            <div style="display: flex; align-items: center; margin-top: 20px;">
                <label for="product-counter" style="margin-right: 10px;">Quantity:</label>
                <input type="number" id="product-counter" name="quantity" value="{{ $cartQuantity }}" min="1"
                    max="{{ min(10, $product->quantity) }}" style="width: 50px; text-align: center; margin-right: 20px;">
                <button class="addCart" data-id="{{ $product->id }}">Add Cart</button>
            </div>
        @else
            <button class="addCart" disabled style="background: gray;">Out of Stock</button>
        @endif

    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/show.js')
@endpush