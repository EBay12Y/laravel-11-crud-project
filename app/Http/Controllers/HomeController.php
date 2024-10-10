<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        $products = Product::all();
        return view('index', compact('products'));
    }
}
