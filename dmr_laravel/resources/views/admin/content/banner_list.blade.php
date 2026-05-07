@extends('layouts.admin')

@section('title', 'Banner Management | DMR Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Active <span class="text-red-600">Banners</span></h1>
        <p class="text-gray-500 text-sm">Manage the carousel slides on your homepage.</p>
    </div>
    <a href="{{ route('admin.banner.create') }}" class="bg-red-600 text-white px-6 py-2.5 rounded shadow-lg shadow-red-500/30 font-bold text-sm uppercase tracking-widest hover:bg-red-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Add Banner
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Preview</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Title</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-center">Status</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($banners as $banner)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-32 h-16 rounded bg-gray-100 border border-gray-200 overflow-hidden shadow-sm">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900 leading-tight text-sm">{{ $banner->title }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($banner->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase tracking-widest">Visible</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-black uppercase tracking-widest">Hidden</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.banner.edit', $banner->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.banner.delete', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?')">
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
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-images text-4xl mb-4 opacity-20"></i>
                        <p class="font-medium">No banners found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-gray-100 bg-gray-50/30">
        {{ $banners->links() }}
    </div>
</div>
@endsection
