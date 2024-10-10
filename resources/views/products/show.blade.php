<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded h-20 object-cover mb-4">
            <h3 class="text-2xl font-semibold mb-4">{{ $product->title }}</h3>
            <hr class="mb-4"/>
            <div class="flex mb-4 gap-4">

                <!-- Tombol Beli Sekarang -->
                <a href="#beli" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Beli Sekarang
                </a>
                
                <!-- Tombol Bagikan -->
                <a href="#bagikan" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                    Bagikan
                </a>
            </div>
            <hr class="mb-4"/>
            <p class="text-xl font-semibold text-gray-700">{{ "Rp " . number_format($product->price, 2, ',', '.') }}</p>
            <p class="text-gray-600 mb-4">{!! $product->description !!}</p>
            <hr class="mb-4"/>
            <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
        </div>
    </div>
</body>
</html>
