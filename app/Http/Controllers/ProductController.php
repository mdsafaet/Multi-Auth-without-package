<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::all();
        return response()->json([
            'status' => true,
            'message' => 'All product data',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validProduct = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric|min:0',  // Added price validation
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
    
        if ($validProduct->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Errors',
                'errors' => $validProduct->errors()->all(),
            ], 401);
        }
    
        // Handle image upload
        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('images/uploads'), $imageName);
    
        $product = Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,  // Save the price
            'image' => $imageName,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Product Created Successfully',
            'product' => $product,
        ], 200);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    
    {
        $data['product'] = Product::select('id', 'name', 'quantity', 'price', 'image')  // Added price
        ->where('id', $id)
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Single Product',
        'data' => $data,
    ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validProduct = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric|min:0',  // Added price validation
            'image' => 'nullable|mimes:jpeg,png,jpg',
        ]);
    
        if ($validProduct->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Errors',
                'errors' => $validProduct->errors()->all(),
            ], 401);
        }
    
        // Fetch the existing product
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }
    
        $imageName = $product->image; // Keep the old image by default
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $path = public_path('images/uploads');
    
            // Delete the old image if it exists
            if (!empty($product->image) && file_exists($path . '/' . $product->image)) {
                unlink($path . '/' . $product->image);
            }
    
            // Upload the new image
            $img = $request->file('image');
            $imageName = time() . '.' . $img->getClientOriginalExtension();
            $img->move($path, $imageName);
        }
    
        // Update the product
        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,  // Update the price
            'image' => $imageName,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Product Updated Successfully',
            'product' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }

        // Delete the image from the storage
        $imagePath = public_path('images/uploads') . '/' . $product->image;

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product Deleted Successfully',
        ], 200);
    }
}