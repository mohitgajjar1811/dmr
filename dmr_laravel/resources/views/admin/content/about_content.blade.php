@extends('layouts.admin')

@section('title', 'About Page Content | DMR Admin')



@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">About Page <span
                class="text-red-600">Content</span></h1>
        <p class="text-gray-500 text-sm">Manage the detailed story and CTA on the about us page.</p>
    </div>

    <form action="{{ route('admin.about.content.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <!-- Main Story -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Main Story
                    </h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Subtitle
                                    (e.g. Our Story)</label>
                                <input type="text" name="subtitle" value="{{ $content->subtitle }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Main
                                    Title</label>
                                <input type="text" name="title" value="{{ $content->title }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Detailed
                                Content</label>
                            <textarea name="content" id="editor"
                                class="rich-editor w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">{{ $content->content }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">Quote
                                Text</label>
                            <textarea name="quote" rows="3"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">{{ $content->quote }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <!-- CTA Section -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-6 border-b pb-2">Call to Action
                        (Bottom)</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-700 mb-2">CTA
                                Title</label>
                            <input type="text" name="cta_title" value="{{ $content->cta_title }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-red-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-red-700 transition shadow-lg">
                    Save About Content
                </button>
            </div>
        </div>
    </form>

@push('scripts')
    @include('admin.partials.ckeditor')
@endpush
@endsection