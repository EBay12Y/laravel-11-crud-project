<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'editor'        => 'required|min:10',
            'price'         => 'required|numeric|min:1',
            'stock'         => 'required|numeric|min:1'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //create product
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->editor,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        // Mengirimkan produk ke view
        return view('products.show', compact('product'));
    }

    /**
     * detail
     *
     * @param  Product $product
     * @return View
     */
    public function detail(Product $product): View
    {
        // Mengirimkan produk ke view
        return view('products.detail', compact('product'));
    }

    /**
     * edit
     *
     * @param  Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        //render view with product
        return view('products.edit', compact('product'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'editor'        => 'required|min:10',
            'price'         => 'required|numeric|min:1',
            'stock'         => 'required|numeric|min:1'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');

            if ($image && $image->isValid()) {
                $image->storeAs('public/products', $image->hashName());
            } else {
                return back()->withErrors(['image' => 'Gambar tidak valid atau gagal diupload!']);
            }

            //delete old image
            Storage::delete('public/products/' . $product->image);

            //update product with new image
            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->editor,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        } else {
            //update product without image
            $product->update([
                'title'         => $request->title,
                'description'   => $request->editor,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        //delete image
        Storage::delete('public/products/' . $product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    /**
     * validateProduct
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return response()->json(['success' => 'Valid']);
    }
}
