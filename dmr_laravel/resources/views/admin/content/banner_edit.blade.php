@extends('layouts.admin')

@section('title', 'Edit Banner | DMR Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.banner.list') }}" class="text-sm font-bold text-red-600 uppercase tracking-widest flex items-center gap-2 mb-4 hover:text-red-700 transition">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
    <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Edit <span class="text-red-600">Banner</span></h1>
    <p class="text-gray-500 text-sm">Update the carousel slide details.</p>
</div>

<form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Banner Image</h2>
                
                <div class="space-y-4">
                    <div class="w-full h-48 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Change Image (Recommended: 1920x800)</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Settings</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ $banner->order }}" 
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-700">Active Status</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-xl shadow-lg shadow-red-500/30 font-black text-sm uppercase tracking-widest hover:bg-red-700 transition flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Update Banner
            </button>
            <a href="{{ route('admin.banner.list') }}" class="w-full bg-gray-100 text-gray-600 py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-gray-200 transition flex items-center justify-center">
                Cancel
            </a>
        </div>
    </div>
</form>
@endsection
