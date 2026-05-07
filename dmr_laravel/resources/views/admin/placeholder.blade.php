@extends('layouts.admin')

@section('title', $title . ' | DMR Admin')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 text-center min-h-[400px] flex flex-col items-center justify-center">
    <div class="text-gray-300 mb-6">
        <i class="fas fa-tools text-6xl"></i>
    </div>
    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $title }} Management</h2>
    <p class="text-gray-500 mb-8 max-w-md">The <strong>{{ $title }}</strong> module is currently being migrated to the new Laravel system. It will be fully functional shortly.</p>
    
    <a href="{{ route('admin.home') }}" class="bg-gray-900 text-white px-6 py-3 rounded-md hover:bg-red-600 transition font-bold text-sm tracking-wide uppercase">
        <i class="fas fa-arrow-left mr-2"></i> Return to Dashboard
    </a>
</div>
@endsection
