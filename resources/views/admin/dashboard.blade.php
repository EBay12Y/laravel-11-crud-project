<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <div class="text-center">
                        <h3 class="mb-4 rounded bg-red-700 p-3 text-3xl font-bold text-white">
                            Ini Admin Kelola Produk
                        </h3>
                    </div>

                    <div class="rounded-lg bg-white p-6 shadow-lg">
                        <a
                            href="{{ route('products.create') }}"
                            class="mb-4 inline-block rounded bg-green-500 px-4 py-2 text-white"
                        >
                            ADD PRODUCT
                        </a>

                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left">
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
