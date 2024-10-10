<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        // Mengirim data produk ke view dashboard
        return view('dashboard', compact('products'));
    }
}
