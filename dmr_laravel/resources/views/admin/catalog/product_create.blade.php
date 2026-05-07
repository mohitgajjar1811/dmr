@extends('layouts.admin')

@section('title', 'Add Product | DMR Admin')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.product.list') }}"
            class="text-sm font-bold text-red-600 uppercase tracking-widest flex items-center gap-2 mb-4 hover:text-red-700 transition">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Add New <span
                class="text-red-600">Product</span></h1>
        <p class="text-gray-500 text-sm">Create a new entry in your industrial equipment catalog.</p>
    </div>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form Content -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Basic
                        Information</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Product
                                Name</label>
                            <input type="text" name="name" required placeholder="e.g. Industrial Centrifugal Pump"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all">
                        </div>

                        <div>
                            <label
                                class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="5"
                                placeholder="Enter detailed product description..."
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all"></textarea>
                        </div>

                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Product Media
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Main
                                Image</label>
                            <input type="file" name="main_image" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">PDF
                                Brochure</label>
                            <input type="file" name="pdf_brochure" accept=".pdf"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Options -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Visibility &
                        Tags</h2>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-700">Active Status</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500">
                                </div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-700">Featured Product</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-red-600 text-white py-4 rounded-xl shadow-lg shadow-red-500/30 font-black text-sm uppercase tracking-widest hover:bg-red-700 transition flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i> Save Product
                </button>
                <a href="{{ route('admin.product.list') }}"
                    class="w-full bg-gray-100 text-gray-600 py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-gray-200 transition flex items-center justify-center">
                    Cancel
                </a>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

    </script>
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush