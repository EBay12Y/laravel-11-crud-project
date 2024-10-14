<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Show Products</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="mx-auto">
            <div class="rounded-lg bg-white p-6 shadow-md">
                <img
                    src="{{ asset('/storage/products/' . $product->image) }}"
                    class="mb-4 h-20 rounded object-cover"
                />
                <h3 class="mb-4 text-2xl font-semibold">{{ $product->title }}</h3>
                <hr class="mb-4" />
                <div class="mb-4 flex gap-4">
                    <!-- Tombol Beli Sekarang -->
                    <a href="#beli" class="rounded-lg bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600">
                        Beli Sekarang
                    </a>

                    <!-- Tombol Bagikan -->
                    <a
                        href="#bagikan"
                        class="rounded-lg bg-gray-300 px-4 py-2 text-gray-700 transition hover:bg-gray-400"
                    >
                        Bagikan
                    </a>
                </div>
                <hr class="mb-4" />
                <p class="text-xl font-semibold text-gray-700">
                    {{ 'Rp ' . number_format($product->price, 2, ',', '.') }}
                </p>
                <p class="mb-4 text-gray-600">{!! $product->description !!}</p>
                <hr class="mb-4" />
                <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
            </div>
        </div>
    </body>
</html>
