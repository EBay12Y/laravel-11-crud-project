<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white bg-red-700 p-3 rounded mb-4">Admin Kelola Produk</h3>
                    </div>
            
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <a href="{{ route('products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">ADD PRODUCT</a>
            
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="text-left bg-gray-100">
                                    <th class="px-4 py-2">IMAGE</th>
                                    <th class="px-4 py-2">TITLE</th>
                                    <th class="px-4 py-2">PRICE</th>
                                    <th class="px-4 py-2">STOCK</th>
                                    <th class="px-4 py-2">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr class="border-t hover:bg-gray-100" onclick="window.location='{{ route('products.show', $product->id) }}'" style="cursor: pointer;">
                                        <td class="px-4 py-2 text-center">
                                            <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td class="px-4 py-2">{{ $product->title }}</td>
                                        <td class="px-4 py-2">{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                                        <td class="px-4 py-2">{{ $product->stock }}</td>
                                        <td class="px-4 py-2">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-2 text-center text-red-500">Data Products belum Tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
            
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
