@extends('layouts.admin')

@section('title', 'Site Settings | DMR Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Site <span class="text-red-600">Settings</span></h1>
    <p class="text-gray-500 text-sm">Update company information and branding.</p>
</div>

<form action="{{ route('admin.settings.site.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Company Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Company Name</label>
                        <input type="text" name="name" value="{{ $settings->name }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Primary Phone</label>
                        <input type="text" name="phone" value="{{ $settings->phone }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Primary Email</label>
                        <input type="email" name="email" value="{{ $settings->email }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="2" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">{{ $settings->address }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Social Media Links</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['facebook', 'twitter', 'instagram', 'linkedin', 'youtube'] as $social)
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">{{ ucfirst($social) }} URL</label>
                        <input type="text" name="{{ $social }}" value="{{ $settings->$social }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Assets -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Branding Assets</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Main Logo</label>
                        @if($settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" class="h-12 mb-2 object-contain bg-gray-900 p-2 rounded">
                        @endif
                        <input type="file" name="logo" class="text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Favicon</label>
                        @if($settings->favicon)
                        <img src="{{ asset('storage/' . $settings->favicon) }}" class="w-8 h-8 mb-2 object-contain">
                        @endif
                        <input type="file" name="favicon" class="text-xs">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-red-700 transition">
                Save Settings
            </button>
        </div>
    </div>
</form>
@endsection
