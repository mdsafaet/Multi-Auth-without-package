<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard (){
        
        $products = Product::paginate(3);
        return view ('admin.dashboard', compact('products'));
    }
}
