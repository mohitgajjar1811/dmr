@extends('layouts.admin')

@section('title', 'Home Page Content | DMR Admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Home Page <span
                class="text-red-600">Content</span></h1>
        <p class="text-gray-500 text-sm">Manage hero sections, about text, and CTA areas.</p>
    </div>

    <form action="{{ route('admin.home.content.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <!-- About Section -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">About Section
                        (Our Heritage)</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">About
                                Title</label>
                            <input type="text" name="about_title" value="{{ $content->about_title }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">About
                                Content</label>
                            <textarea name="about_content" class="rich-editor w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">{{ $content->about_content }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="space-y-6">
                <!-- About Images -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">About Images
                        (Overlapping)</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Image 1
                                (Left-Top Side)</label>
                            @if($content->about_image_1)
                                <img src="{{ asset('storage/' . $content->about_image_1) }}"
                                    class="w-full h-32 object-cover rounded mb-2 border">
                            @endif
                            <input type="file" name="about_image_1" class="text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Image 2
                                (Right-Bottom Side)</label>
                            @if($content->about_image_2)
                                <img src="{{ asset('storage/' . $content->about_image_2) }}"
                                    class="w-full h-32 object-cover rounded mb-2 border">
                            @endif
                            <input type="file" name="about_image_2" class="text-xs">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-red-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-red-700 transition shadow-lg">
                    Save Content
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    @include('admin.partials.ckeditor')
@endpush