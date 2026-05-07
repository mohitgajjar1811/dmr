@extends('layouts.admin')

@section('title', 'Enquiries | DMR Admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Contact <span class="text-red-600">Enquiries</span></h1>
        <p class="text-gray-500 text-sm">Direct messages from the Contact Us form.</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Sender</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Subject</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Date</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($enquiries as $enquiry)
                <tr class="hover:bg-gray-50 transition-colors {{ $enquiry->is_read ? 'opacity-60' : 'bg-blue-50/30' }}">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900 leading-tight">{{ $enquiry->name }}</div>
                        <div class="text-xs text-gray-400 font-medium lowercase tracking-wider mt-1">{{ $enquiry->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-600 font-medium">{{ $enquiry->subject ?? 'No Subject' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $enquiry->created_at->format('d M Y') }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <button class="p-2 text-primary hover:bg-gray-100 rounded transition" title="View Message">
                                <i class="fas fa-eye"></i>
                            </button>
                            <form action="{{ route('admin.enquiry.delete', $enquiry->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?')">
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
                        <i class="fas fa-envelope-open text-4xl mb-4 opacity-20"></i>
                        <p class="font-medium">No enquiries found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-gray-100 bg-gray-50/30">
        {{ $enquiries->links() }}
    </div>
</div>
@endsection
