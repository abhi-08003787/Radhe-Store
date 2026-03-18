@extends('layouts.app')

@section('title', $page->title . ' - Radhe Store')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="serif text-3xl md:text-4xl text-[#2b0505] mb-8 text-center">{{ $page->title }}</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <div class="prose max-w-none prose-headings:text-[#2b0505] prose-a:text-[#D4AF37] prose-a:no-underline prose-a:hover:underline">
                {!! $page->content !!}
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-[#D4AF37] hover:underline text-sm">
                ← Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
