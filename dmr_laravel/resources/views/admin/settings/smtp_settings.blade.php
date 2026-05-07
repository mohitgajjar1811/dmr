@extends('layouts.admin')

@section('title', 'SMTP Settings | DMR Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">SMTP <span class="text-red-600">Settings</span></h1>
    <p class="text-gray-500 text-sm">Configure email delivery settings.</p>
</div>

<div class="max-w-4xl bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <form action="{{ route('admin.settings.smtp.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">SMTP Host</label>
                <input type="text" name="email_host" value="{{ $settings->email_host }}" placeholder="smtp.mailtrap.io" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">SMTP Port</label>
                <input type="number" name="email_port" value="{{ $settings->email_port }}" placeholder="587" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Default From Email</label>
                <input type="email" name="default_from_email" value="{{ $settings->default_from_email }}" placeholder="no-reply@dmr.com" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">SMTP Username</label>
                <input type="text" name="email_host_user" value="{{ $settings->email_host_user }}" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">SMTP Password</label>
                <input type="password" name="email_host_password" value="{{ $settings->email_host_password }}" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="email_use_tls" value="1" {{ $settings->email_use_tls ? 'checked' : '' }} class="w-4 h-4 text-red-600 rounded">
                    <span class="text-xs font-bold uppercase tracking-widest text-gray-700">Use TLS</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="email_use_ssl" value="1" {{ $settings->email_use_ssl ? 'checked' : '' }} class="w-4 h-4 text-red-600 rounded">
                    <span class="text-xs font-bold uppercase tracking-widest text-gray-700">Use SSL</span>
                </label>
            </div>
        </div>

        <div class="flex justify-between items-center border-t pt-8">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest max-w-sm">
                * Note: Changes to these settings will affect all outgoing emails immediately.
            </p>
            <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-black transition shadow-lg">
                Save Configurations
            </button>
        </div>
    </form>
</div>
@endsection
