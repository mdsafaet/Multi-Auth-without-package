<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-500">Admin Dashboard</h1>
            <nav>
                <a href="{{ url('home') }}" class="text-white px-4">Homepage</a>
                <a href="{{ route('admin.logout') }}" class="text-white px-4">Logout</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto py-10">
        <h2 class="text-3xl font-semibold mb-6">Welcome to Your Dashboard</h2>

        <!-- Product Section -->
        <div class="mb-8">
            <h3 class="text-2xl font-semibold mb-4">Product List</h3>

            <div class="mb-4">
    <!-- Bootstrap Modal Trigger -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Product
    </button>
</div>



<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 

 <script> 
    $(document).ready(function () {
        // Handle form submission via AJAX
        console.log("kajj kore");
        $('#productForm').submit(function (e) {
            console.log("kaj");
            e.preventDefault(); // Prevent the default form submission

            // Gather form data
            let formData = {
                name: $('#productName').val(),
                price: $('#productPrice').val(),
                image: $('#productimage').val(),
                quantity: $('#productquantity').val(),
                _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
            };

            console.log(formData);

            // Send AJAX request
            $.ajax({
                url: '', // Laravel route for storing products
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#formResponse').html('<div class="alert alert-success">Product added successfully!</div>');
                    $('#productForm')[0].reset(); // Clear form inputs
                    setTimeout(() => $('#exampleModal').modal('hide'), 1500); // Hide modal after success
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function (key, value) {
                        errorMsg += '<li>' + value + '</li>';
                    });
                    errorMsg += '</ul></div>';
                    $('#formResponse').html(errorMsg);
                }
            });
        });
    });
</script>  -->

@if($products->isEmpty())
    <p>No products found.</p>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th> <!-- Added ID column -->
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td> <!-- Displaying Product ID -->
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('images/uploads/' . $product->image) }}" alt="Product Image" width="100">
                    @else
                        No image available
                    @endif
                </td>
                <td>
                    <!-- Action buttons or links go here -->
    <!-- Edit Button -->
    <button class="btn btn-primary btn-sm editProduct" data-bs-toggle="modal" data-bs-target="#upexampleModal" data-id="{{ $product->id }}"  
    data-name="{{ $product->name }}"
    data-quantity="{{ $product->quantity }}"
    data-price="{{ $product->price }}"
    data-image="{{ $product->image }}">
    Edit
</button>

    <!-- Delete Button -->
    <button class="btn btn-danger btn-sm delete_product" data-id="{{ $product->id }} ">Delete</button>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </main>

   @include('add_Product_modal')
   @include('products_js')
   @include('edit_modal')
   @include('delete_modal')
</body>
</html>
