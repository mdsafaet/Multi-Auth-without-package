<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <header class="bg-blue-500 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold text-red-500"> Admin Dashboard</h1>
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
      @if($products->isEmpty())
        <p>No products found.</p>
      @else
        <table class="table-auto w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="px-4 py-2 border">Name</th>
              <th class="px-4 py-2 border">Quantity</th>
              <th class="px-4 py-2 border">Price</th>
              <th class="px-4 py-2 border">Image</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr>
                <td class="px-4 py-2 border">{{ $product->name }}</td>
                <td class="px-4 py-2 border">{{ $product->quantity }}</td>
                <td class="px-4 py-2 border">${{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-2 border">
                  @if($product->image)
                    <img src="{{ asset('images/uploads/' . $product->image) }}" alt="Product Image" width="100">
                  @else
                    No image available
                  @endif
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
</body>
</html>
