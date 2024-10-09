<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data produk, bisa menggunakan pagination juga
        $products = Product::latest()->paginate(10);

        // Mengirim data produk ke view dashboard
        return view('dashboard', compact('products'));
    }
}
