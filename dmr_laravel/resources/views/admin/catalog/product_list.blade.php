@extends('layouts.admin')

@section('title', 'Product List | DMR Admin')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Product <span
                    class="text-red-600">Catalog</span></h1>
            <p class="text-gray-500 text-sm">Manage your industrial equipment inventory.</p>
        </div>
        <a href="{{ route('admin.product.create') }}"
            class="bg-red-600 text-white px-6 py-2.5 rounded shadow-lg shadow-red-500/30 font-bold text-sm uppercase tracking-widest hover:bg-red-700 transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Filters/Search -->
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <form action="{{ route('admin.product.list') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name or SKU..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all text-sm">
                </div>
                <select name="status"
                    class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-sm bg-white">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit"
                    class="bg-gray-900 text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-gray-800 transition">Filter</button>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Product</th>
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-center">Status
                        </th>
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded bg-gray-100 border border-gray-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        @if($product->main_image)
                                            <img src="{{ asset('storage/' . $product->main_image) }}" alt=""
                                                class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-box text-gray-300"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 leading-tight">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wider mt-1">SKU:
                                            DMR-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($product->is_active)
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase tracking-widest">Active</span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-black uppercase tracking-widest">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded transition"
                                            title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-box-open text-4xl mb-4 opacity-20"></i>
                                <p class="font-medium">No products found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-100 bg-gray-50/30">
            {{ $products->links() }}
        </div>
    </div>
@endsection