@extends('layouts.admin')

@section('title', 'Newsletter Subscribers | DMR Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Newsletter <span class="text-red-600">Subscribers</span></h1>
        <p class="text-gray-500 text-sm">Emails collected via the footer subscription form.</p>
    </div>
    <button class="bg-gray-900 text-white px-6 py-2.5 rounded shadow-lg font-bold text-sm uppercase tracking-widest hover:bg-gray-800 transition flex items-center gap-2">
        <i class="fas fa-file-export"></i> Export CSV
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Email Address</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-center">Date</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($subscribers as $subscriber)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $subscriber->email }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $subscriber->subscribed_at ? \Carbon\Carbon::parse($subscriber->subscribed_at)->format('d M Y') : 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.newsletter.delete', $subscriber->id) }}" method="POST" onsubmit="return confirm('Remove this subscriber?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Remove">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-paper-plane text-4xl mb-4 opacity-20"></i>
                        <p class="font-medium">No subscribers yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-gray-100 bg-gray-50/30">
        {{ $subscribers->links() }}
    </div>
</div>
@endsection
