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
        <img src="{{ asset('pics/back1.png') }}" alt="" class="back1">
        <img src="{{ asset('pics/back2.png') }}" alt="" class="back2">
        <img src="https://static.vecteezy.com/system/resources/previews/010/832/908/original/tropical-green-palm-leaf-tree-isolated-on-white-background-free-png.png" alt="" class="tropical">
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
