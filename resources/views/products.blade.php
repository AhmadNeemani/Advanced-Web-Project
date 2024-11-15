@extends('layout')

@section('title', 'Products')

@section('content')
<div class="container">
    <header>
        <div class="title">
            <h5>Product List</h5>
        </div>
        <div class="icon-cart">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
            </svg>
            <span>0</span>
        </div>
    </header>
    
    <div class="listProduct">
        <img src="{{ asset('pics/back1.png') }}" alt="" class="back1">
        <img src="{{ asset('pics/back2.png') }}" alt="" class="back2">
        <img src="https://static.vecteezy.com/system/resources/previews/010/832/908/original/tropical-green-palm-leaf-tree-isolated-on-white-background-free-png.png" alt="" class="tropical">
        <img src="{{ asset('pics/back3.png') }}" alt="" class="back3">
    </div>
</div>

<div class="cartTab">
    <h1>Shopping Cart</h1>
    <div class="listCart"></div>
    <div class="btn">
        <button class="close">Close</button>
        <button class="checkOut">Check Out</button>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('resources/js/products.js') }}"></script>
@endpush
