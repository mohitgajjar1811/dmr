@extends('layouts.admin')

@section('title', 'Home Features | DMR Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Home <span class="text-red-600">Features</span></h1>
        <p class="text-gray-500 text-sm">Manage the key features displayed on the home page.</p>
    </div>
    <a href="{{ route('admin.feature.create') }}" class="bg-red-600 text-white px-6 py-2.5 rounded shadow-lg shadow-red-500/30 font-bold text-sm uppercase tracking-widest hover:bg-red-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Add Feature
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Icon</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Title</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Subtitle</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-center">Order</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($features as $feature)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-10 h-10 rounded bg-red-50 text-red-600 flex items-center justify-center">
                            <i class="{{ $feature->icon }} fa-lg"></i>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $feature->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $feature->subtitle }}</td>
                    <td class="px-6 py-4 text-center text-sm font-bold text-gray-400">{{ $feature->order }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.feature.edit', $feature->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.feature.delete', $feature->id) }}" method="POST" onsubmit="return confirm('Delete this feature?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded transition" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <p class="font-medium">No features found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
