@extends('layout')

@section('title', 'Admin Panel')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Admin Panel</h1>
    

    <!-- Add Product -->
    <div class="mb-5">
        <h2 class="mb-4 text-center">Add Product</h2>

        <form action="/add-product" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="productName" class="form-label d-block text-left">Product Name</label>
                <input type="text" name="name" id="productName" class="form-control w-75 mx-auto" required>
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-label d-block text-left">Price</label>
                <input type="number" name="price" id="productPrice" class="form-control w-75 mx-auto" required>
            </div>

            <div class="mb-3">
                <label for="productDescription" class="form-label d-block text-left">Description</label>
                <textarea name="description" id="productDescription" class="form-control w-75 mx-auto"></textarea>
            </div>

            <div class="mb-3">
                <label for="productCategory" class="form-label d-block text-left">Category</label>
                <select name="category_id" id="productCategory" class="form-control w-75 mx-auto" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="productQuantity" class="form-label d-block text-left">Quantity</label>
                <input type="number" name="quantity" id="productQuantity" class="form-control w-75 mx-auto" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label d-block text-left">Product Image</label>
                <input type="file" name="image" id="imageInput" class="form-control w-75 mx-auto">
                <img id="imagePreview" src="#" alt="Image Preview" width="100" class="mt-3 d-none">
            </div>

            <script>
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

            <button type="submit" class="btn" style="background-color: #FFC0CB; width: 200px; border: none; color: white;">Add Product</button>
        </form>
    </div>

    <!-- Product List -->
    <div class="mb-5">
    <h2 class="mb-4">Manage Products</h2>

    <!-- Search Product -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search products by name...">
    </div>

    <table class="table table-striped" id="productsTable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td class="product-name">{{ $product->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="{{ route('edit-product', $product->id) }}" class="btn" style="background-color: #FFB6C1; border: none; color: white;">Edit</a>

                        <form action="{{ route('delete-product', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn" style="background-color: #D5006D; border: none; color: white;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#productsTable tbody tr');

        rows.forEach(row => {
            const productName = row.querySelector('.product-name').textContent.toLowerCase();
            if (productName.includes(filter)) {
                row.style.display = ''; 
            } else {
                row.style.display = 'none'; 
            }
        });
    });
</script>
@endsection
