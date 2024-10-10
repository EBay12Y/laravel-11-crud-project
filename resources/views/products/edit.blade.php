<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>
<body class="bg-gray-200">

    <div class="container mx-auto mt-10 mb-10 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    
                        @csrf
                        @method('PUT')

                        <!-- Image -->
                        <div class="mb-5">
                            <label class="block text-sm font-bold mb-2">IMAGE</label>
                            <input type="file" class="w-full p-2 border rounded-lg @error('image') border-red-500 @enderror" name="image">
                        
                            <!-- error message untuk image -->
                            @error('image')
                                <div class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="mb-5">
                            <label class="block text-sm font-bold mb-2">TITLE</label>
                            <input type="text" class="w-full p-2 border rounded-lg @error('title') border-red-500 @enderror" name="title" value="{{ old('title', $product->title) }}" placeholder="Masukkan Judul Product">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-5">
                            <label class="block text-sm font-bold mb-2">DESCRIPTION</label>
                            <textarea class="w-full p-2 border rounded-lg @error('description') border-red-500 @enderror" name="editor" rows="7" placeholder="Masukkan Description Product">{{ old('description', $product->description) }}</textarea>
                        
                            <!-- error message untuk description -->
                            @error('description')
                                <div class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Price -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold mb-2">PRICE</label>
                                <input type="number" class="w-full p-2 border rounded-lg @error('price') border-red-500 @enderror" name="price" value="{{ old('price', $product->price) }}" placeholder="Masukkan Harga Product">
                            
                                <!-- error message untuk price -->
                                @error('price')
                                    <div class="text-red-500 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div class="mb-5">
                                <label class="block text-sm font-bold mb-2">STOCK</label>
                                <input type="number" class="w-full p-2 border rounded-lg @error('stock') border-red-500 @enderror" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Masukkan Stock Product">
                            
                                <!-- error message untuk stock -->
                                @error('stock')
                                    <div class="text-red-500 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">UPDATE</button>
                            <button type="reset" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">RESET</button>
                            <a href="{{ url()->previous() }}" class="bg-slate-700 text-white px-4 py-2 rounded-lg hover:bg-slate-500 transition">
                                Kembali
                            </a>
                        </div>

                    </form> 
                </div>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('textarea'), {
                ckfinder: {
                    uploadUrl: '{{ route('upload.image') }}?_token={{ csrf_token() }}'
                }
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    </script>
    
</body>
</html>
