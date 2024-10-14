<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('List Products') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto max-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <div class="text-center">
                        <h3 class="mb-4 rounded bg-red-700 p-3 text-3xl font-bold text-white">
                            Dashboard Kelola Semua Produk
                        </h3>
                    </div>
                    <div class="rounded-lg p-6 shadow-lg">
                        <div class="ml-2 md:-mb-12 z-50">
                            <!-- Tombol ADD PRODUCT -->
                            <a
                                href="{{ route('products.create') }}"
                                class="inline-block rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600"
                            >
                                ADD PRODUCT
                            </a>
                        </div>

                        <table id="selection-table" class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-4 py-2">IMAGE</th>
                                    <th class="px-4 py-2">TITLE</th>
                                    <th class="px-4 py-2">PRICE</th>
                                    <th class="px-4 py-2">STOCK</th>
                                    <th class="px-4 py-2">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="border-t hover:bg-gray-100">
                                        <td
                                            class="px-4 py-2 text-center"
                                            onclick="window.location='{{ route('products.detail', $product->id) }}'"
                                            style="cursor: pointer"
                                        >
                                            <img
                                                src="{{ asset('/storage/products/' . $product->image) }}"
                                                class="rounded"
                                                style="width: 150px"
                                            />
                                        </td>
                                        <td
                                            class="px-4 py-2"
                                            onclick="window.location='{{ route('products.detail', $product->id) }}'"
                                            style="cursor: pointer"
                                        >
                                            {{ $product->title }}
                                        </td>
                                        <td
                                            class="px-4 py-2"
                                            onclick="window.location='{{ route('products.detail', $product->id) }}'"
                                            style="cursor: pointer"
                                        >
                                            {{ 'Rp ' . number_format($product->price, 2, ',', '.') }}
                                        </td>
                                        <td
                                            class="px-4 py-2"
                                            onclick="window.location='{{ route('products.detail', $product->id) }}'"
                                            style="cursor: pointer"
                                        >
                                            {{ $product->stock }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <form
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('products.destroy', $product->id) }}"
                                                method="POST"
                                            >
                                                <button
                                                    type="button"
                                                    onclick="window.location.href='{{ route('products.edit', $product->id) }}'"
                                                    class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                                                >
                                                    EDIT
                                                </button>
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600"
                                                >
                                                    HAPUS
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-2 text-center text-red-500">
                                            Data Products belum Tersedia.
                                        </td>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById("selection-table") && typeof simpleDatatables.DataTable !== 'undefined') {

            let multiSelect = true;
            let rowNavigation = false;
            let table = null;

            const resetTable = function() {
                if (table) {
                    table.destroy();
                }

                const options = {
                    rowRender: (row, tr, _index) => {
                        if (!tr.attributes) {
                            tr.attributes = {};
                        }
                        if (!tr.attributes.class) {
                            tr.attributes.class = "";
                        }
                        if (row.selected) {
                            tr.attributes.class += " selected";
                        } else {
                            tr.attributes.class = tr.attributes.class.replace(" selected", "");
                        }
                        return tr;
                    }
                };
                if (rowNavigation) {
                    options.rowNavigation = true;
                    options.tabIndex = 1;
                }

                table = new simpleDatatables.DataTable("#selection-table", options);

                // Mark all rows as unselected
                table.data.data.forEach(data => {
                    data.selected = false;
                });

                table.on("datatable.selectrow", (rowIndex, event) => {
                    event.preventDefault();
                    const row = table.data.data[rowIndex];
                    if (row.selected) {
                        row.selected = false;
                    } else {
                        if (!multiSelect) {
                            table.data.data.forEach(data => {
                                data.selected = false;
                            });
                        }
                        row.selected = true;
                    }
                    table.update();
                });
            };

            // Row navigation makes no sense on mobile, so we deactivate it and hide the checkbox.
            const isMobile = window.matchMedia("(any-pointer:coarse)").matches;
            if (isMobile) {
                rowNavigation = false;
            }

            resetTable();
        }
    });
</script>
