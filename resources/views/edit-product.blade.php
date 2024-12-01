@extends('layout')

@section('title', 'Edit Product')

@section('content')
<div class="container my-5" style="padding-bottom:20rem ;">
    <h1 class="mb-4 text-center">Edit Product</h1>
    <form action="{{ route('update-product', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label d-block text-left">Product Name</label>
            <input type="text" name="name" class="form-control w-75 mx-auto" value="{{ $product->name }}" required>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label d-block text-left">Price</label>
            <input type="number" name="price" class="form-control w-75 mx-auto" value="{{ $product->price }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label d-block text-left">Description</label>
            <textarea name="description" class="form-control w-75 mx-auto">{{ $product->description }}</textarea>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category_id" class="form-label d-block text-left">Category</label>
            <select name="category_id" class="form-control w-75 mx-auto" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantity" class="form-label d-block text-left">Quantity</label>
            <input type="number" name="quantity" class="form-control w-75 mx-auto" value="{{ $product->quantity }}"
                required>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="image" class="form-label d-block text-left">Product Image</label>
            <input type="file" name="image" id="imageInput" class="form-control w-75 mx-auto">
            @if($product->image)
                <img id="imagePreview" src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100"
                    class="mt-3">
            @else
                <img id="imagePreview" src="#" alt="Image Preview" width="100" class="mt-3 d-none">
            @endif
        </div>


        <script>
            // Image preview on file selection
            document.getElementById('imageInput').addEventListener('change', function (event) {
                const imagePreview = document.getElementById('imagePreview');
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

        <button type="submit" class="btn"
            style="background-color: #FFC0CB; width: 200px; border: none; color: white; z-index: 100000;">Update Product</button>
    </form>
</div>
@endsection