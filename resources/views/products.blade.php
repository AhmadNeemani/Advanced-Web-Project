@extends('layout')

@section('title', 'Products')

@section('content')
<div class="container_products_h">
    <div class="products_title">
        <div class="title">
            <h5>Product List</h5>
        </div>
    </div>

    <div class="listProduct">
        @if($products->count() > 0)
            @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-link">
                <div class="mycard" style="background-image: url('{{ asset('storage/' . ($product->image ?? 'product_images/default.jpg')) }}');">
                        <div class="heart-wrapper">
                            <div class="heart" data-id="{{ $product->id }}">
                                <img src="{{ $product->isFavorite ? asset('pics/heart_filled.png') : asset('pics/heart.png') }}"
                                    alt="Favorite">
                            </div>
                        </div>

                        <div class="mycardinfo">
                            <h2>{{ $product->name }}</h2>
                            <div class="cardprice">
                                <div>
                                    <p><span>${{ number_format($product->price, 2) }}</span> USD</p>
                                </div>
                            </div>
                            <div class="add-cart-wrapper">
                                @if($product->quantity > 0)
                                    <button class="addCart" data-id="{{ $product->id }}">Add To Cart</button>
                                @else
                                    <button class="addCart" disabled>Out of Stock</button>
                                @endif
                            </div>
                            <span class="hidden-id" style="display:none;">{{ $product->id }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p>No products available at the moment. Check back later!</p>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/products.js')
@endpush
