@extends('layouts.admin')

@section('title', 'Leads | DMR Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Project <span class="text-red-600">Leads</span></h1>
        <p class="text-gray-500 text-sm">Leads generated via brochure downloads or quote requests.</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Name</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Contact</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Type</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($leads as $lead)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900 leading-tight">{{ $lead->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600 font-medium">{{ $lead->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                            {{ str_contains($lead->message, 'Downloaded') ? 'Brochure' : 'Quote' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $lead->created_at->format('d M Y') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-bullhorn text-4xl mb-4 opacity-20"></i>
                        <p class="font-medium">No leads found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-gray-100 bg-gray-50/30">
        {{ $leads->links() }}
    </div>
</div>
@endsection
