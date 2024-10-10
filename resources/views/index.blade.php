<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div class="container max-w-6xl mx-auto p-6">
        <div class="h-20 bg-blue-500 text-center rounded-lg my-4 py-3">
            <h2 class="text-5xl font-extrabold text-white rounded">Selamat Datang di Toko Terang Jaya</h2>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 flex">
            <!-- Bagian Kiri: Daftar Produk -->
            <div class="w-1/3 p-4 border-r">
                <p class="mb-4">Total produk : {{ $products->count() }}</p>
                @foreach($products as $product)
                    <div class="card mb-4 cursor-pointer bg-gray-100 hover:bg-gray-200 border hover:border-gray-500 rounded p-4" onclick="loadProductDetail('{{ route('products.show', $product->id) }}')">
                        <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded w-full h-20 object-cover">
                        <h4 class="mt-2 text-lg font-semibold">{{ $product->title }}</h4>
                        <p>{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Bagian Kanan: Detail Produk -->
            <div class="w-2/3 p-4" id="product-detail">
                <p class="text-gray-400 text-lg text-center">Silakan pilih produk di sebelah kiri untuk melihat detailnya</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi untuk memuat detail produk secara dinamis
        function loadProductDetail(url) {
            console.log("Memuat detail produk dari URL: " + url); // Cek URL
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('product-detail').innerHTML = data;
                });
        }


        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
