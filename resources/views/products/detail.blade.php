<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot> --}}
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white bg-red-700 p-3 rounded mb-4">Detail Produk</h3>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded h-20 object-cover mb-4">
                        <h3 class="text-2xl font-semibold mb-4">{{ $product->title }}</h3>
                        <hr class="mb-4"/>

                        <!-- Bagian Tombol Beli Sekarang, Bagikan, dan Kembali -->
                        <div class="flex mb-4 gap-4">
                            <!-- Tombol Beli Sekarang -->
                            <a href="#beli" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                Lihat List Pembeli
                            </a>

                            <!-- Tombol Kembali -->
                            <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                                Kembali
                            </a>
                        </div>

                        <hr class="mb-4"/>
                        <p class="text-xl font-semibold text-gray-700">{{ "Rp " . number_format($product->price, 2, ',', '.') }}</p>
                        <p class="text-gray-600 mb-4">{!! $product->description !!}</p>
                        <hr class="mb-4"/>
                        <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>