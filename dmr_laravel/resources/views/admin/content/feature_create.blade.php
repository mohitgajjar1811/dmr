@extends('layouts.admin')

@section('title', 'Add Feature | DMR Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.feature.list') }}" class="text-sm font-bold text-red-600 uppercase tracking-widest flex items-center gap-2 mb-4 hover:text-red-700 transition">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
    <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Add New <span class="text-red-600">Feature</span></h1>
</div>

<div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <form action="{{ route('admin.feature.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" required placeholder="e.g. fas fa-shipping-fast" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                <p class="mt-1 text-[10px] text-gray-400">Use FontAwesome classes like 'fas fa-check'.</p>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Title</label>
                <input type="text" name="title" required placeholder="e.g. Quality Assurance" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Subtitle / Description</label>
                <input type="text" name="subtitle" placeholder="e.g. We ensure the best materials." 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Display Order</label>
                <input type="number" name="order" value="0" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-red-700 transition">
                Save Feature
            </button>
        </div>
    </form>
</div>
@endsection
