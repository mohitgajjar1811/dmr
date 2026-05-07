@extends('layouts.admin')

@section('title', 'Edit Feature | DMR Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.feature.list') }}" class="text-sm font-bold text-red-600 uppercase tracking-widest flex items-center gap-2 mb-4 hover:text-red-700 transition">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
    <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Edit <span class="text-red-600">Feature</span></h1>
</div>

<div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <form action="{{ route('admin.feature.update', $feature->id) }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Icon Class (FontAwesome)</label>
                <div class="flex gap-4 items-center">
                    <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-gray-400">
                        <i class="{{ $feature->icon }} fa-lg"></i>
                    </div>
                    <input type="text" name="icon" value="{{ $feature->icon }}" required placeholder="e.g. fas fa-shipping-fast" 
                        class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ $feature->title }}" required placeholder="e.g. Quality Assurance" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Subtitle / Description</label>
                <input type="text" name="subtitle" value="{{ $feature->subtitle }}" placeholder="e.g. We ensure the best materials." 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Display Order</label>
                <input type="number" name="order" value="{{ $feature->order }}" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-red-700 transition">
                Update Feature
            </button>
        </div>
    </form>
</div>
@endsection
