<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Edit ' . $product->title }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-6 px-4">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-lg bg-white shadow-md">
                <div class="p-6">
                    <form
                        action="{{ route('products.update', $product->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')

                        <!-- Image -->
                        <div class="mb-5">
                            <label class="mb-2 block text-sm font-bold">IMAGE</label>
                            <input
                                type="file"
                                class="@error('image') border-red-500 @enderror w-full rounded-lg border p-2"
                                name="image"
                            />

                            <!-- error message untuk image -->
                            @error('image')
                                <div class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="mb-5">
                            <label class="mb-2 block text-sm font-bold">TITLE</label>
                            <input
                                type="text"
                                class="@error('title') border-red-500 @enderror w-full rounded-lg border p-2"
                                name="title"
                                value="{{ old('title', $product->title) }}"
                                placeholder="Masukkan Judul Product"
                            />

                            <!-- error message untuk title -->
                            @error('title')
                                <div class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-5">
                            <label class="mb-2 block text-sm font-bold">DESCRIPTION</label>
                            <textarea
                                class="@error('description') border-red-500 @enderror w-full rounded-lg border p-2"
                                name="editor"
                                rows="7"
                                placeholder="Masukkan Description Product"
                            >
{{ old('description', $product->description) }}</textarea
                            >

                            <!-- error message untuk description -->
                            @error('description')
                                <div class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Price -->
                            <div class="mb-5">
                                <label class="mb-2 block text-sm font-bold">PRICE</label>
                                <input
                                    type="number"
                                    class="@error('price') border-red-500 @enderror w-full rounded-lg border p-2"
                                    name="price"
                                    value="{{ old('price', $product->price) }}"
                                    placeholder="Masukkan Harga Product"
                                />

                                <!-- error message untuk price -->
                                @error('price')
                                    <div class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div class="mb-5">
                                <label class="mb-2 block text-sm font-bold">STOCK</label>
                                <input
                                    type="number"
                                    class="@error('stock') border-red-500 @enderror w-full rounded-lg border p-2"
                                    name="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    placeholder="Masukkan Stock Product"
                                />

                                <!-- error message untuk stock -->
                                @error('stock')
                                    <div class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3">
                            <button
                                type="submit"
                                class="rounded-lg bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600"
                            >
                                Simpan
                            </button>
                            <button
                                type="reset"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-white transition hover:bg-yellow-600"
                            >
                                Reset
                            </button>
                            <a
                                href="{{ url()->previous() }}"
                                class="rounded-lg bg-slate-700 px-4 py-2 text-white transition hover:bg-slate-500"
                            >
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('textarea'), {
            ckfinder: {
                uploadUrl: '{{ route('upload.image') }}?_token={{ csrf_token() }}',
            },
        })
            .then((editor) => {
                console.log('Editor was initialized', editor);
            })
            .catch((error) => {
                console.error('Error during initialization of the editor', error);
            });
    </script>
</x-app-layout>
