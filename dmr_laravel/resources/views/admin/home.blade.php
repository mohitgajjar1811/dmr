@extends('layouts.admin')

@section('title', 'Overview | DMR Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 uppercase">
    <!-- Stat Card 1: Total Products -->
    <a href="{{ route('admin.product.list') }}"
        class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
            <i class="fas fa-box fa-lg"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Products</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_products'] }}</p>
        </div>
    </a>

    <!-- Stat Card 4: Newsletter -->
    <a href="{{ route('admin.newsletter.list') }}"
        class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
            <i class="fas fa-paper-plane fa-lg"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Newsletter</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['newsletter_count'] }}</p>
        </div>
    </a>

    <!-- Stat Card: Enquiries -->
    <a href="{{ route('admin.enquiry.list') }}"
        class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow relative overflow-hidden">
        @if($stats['new_enquiries'] > 0)
        <span class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg">NEW</span>
        @endif
        <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
            <i class="fas fa-envelope fa-lg"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">New Enquiries</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['new_enquiries'] }}</p>
        </div>
    </a>

    <!-- Stat Card: Banners -->
    <a href="{{ route('admin.banner.list') }}"
        class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
            <i class="fas fa-images fa-lg"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Active Banners</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_banners'] }}</p>
        </div>
    </a>

    <!-- Stat Card: Leads -->
    <a href="{{ route('admin.lead.list') }}"
        class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
            <i class="fas fa-bullhorn fa-lg"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Leads</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_leads'] }}</p>
        </div>
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('admin.product.create') }}" class="block p-4 border border-dashed border-gray-300 rounded hover:border-blue-500 hover:bg-blue-50 transition text-center group">
            <i class="fas fa-plus-circle text-gray-400 group-hover:text-blue-500 text-2xl mb-2"></i>
            <h3 class="font-medium text-gray-700 group-hover:text-blue-600">Add New Product</h3>
        </a>

        <a href="{{ route('admin.banner.create') }}" class="block p-4 border border-dashed border-gray-300 rounded hover:border-green-500 hover:bg-green-50 transition text-center group">
            <i class="fas fa-plus-circle text-gray-400 group-hover:text-green-500 text-2xl mb-2"></i>
            <h3 class="font-medium text-gray-700 group-hover:text-green-600">Add New Banner</h3>
        </a>
        <a href="{{ route('admin.enquiry.list') }}" class="block p-4 border border-dashed border-gray-300 rounded hover:border-orange-500 hover:bg-orange-50 transition text-center group">
            <i class="fas fa-envelope-open-text text-gray-400 group-hover:text-orange-500 text-2xl mb-2"></i>
            <h3 class="font-medium text-gray-700 group-hover:text-orange-600">View Enquiries</h3>
        </a>
    </div>
</div>
@endsection
