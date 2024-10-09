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
                        <h3 class="text-3xl font-bold text-white bg-red-700 p-3 rounded mb-4">Ini User Kelola Produk</h3>
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
                            
                        </table>
            
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{-- {{ $products->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
