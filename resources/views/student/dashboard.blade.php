@extends('layouts.student-app')

@section('title', 'My Schedule')

@section('content')
    <h1 class="text-2xl font-bold mb-4">My Schedule</h1>
    <p class="text-gray-600 mb-6">View your upcoming lectures and hall locations</p>

    @if($lectures->isEmpty())
        <div class="text-center text-gray-500 mt-20">
            <svg class="mx-auto mb-4 h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z" />
            </svg>
            <p class="text-lg font-semibold">No upcoming lectures</p>
            <p>Check back later for new schedule updates</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($lectures as $lecture)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold text-purple-700">{{ $lecture->subject }}</h2>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($lecture->start_time)->format('D, M j, Y g:i A') }} - {{ \Carbon\Carbon::parse($lecture->end_time)->format('g:i A') }}</p>
                    <p class="text-gray-600">Hall: {{ $lecture->hall ? $lecture->hall->name : 'N/A' }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection
