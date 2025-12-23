@extends('layouts.app')

@section('content')
    <!-- Link to board-specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/board_style.css') }}">

    <!-- Page Title -->
    <h1 class="page-title">Quest Board</h1>

    <!-- Quests Grid -->
    <div class="quests-grid">
        @forelse($quests as $quest)
            <div class="quest-card">
                <h3 class="quest-title">{{ $quest->title }}</h3>
                <p class="quest-desc">{{ Str::limit($quest->description, 120) }}</p>

                <div class="quest-badges">
                    <span class="badge difficulty">Difficulty: {{ $quest->difficulty }}</span>
                    <span class="badge xp">XP: {{ $quest->xp_reward }}</span>
                    <span class="badge gold">Gold: {{ $quest->gold_reward }}</span>
                </div>

                <p class="posted-by">Posted by: {{ $quest->client?->name }}</p>

                <form action="/quests/{{ $quest->id }}/accept" method="POST">
                    @csrf
                    <button class="accept-btn">Accept Quest</button>
                </form>
            </div>
        @empty
            <p class="no-quests">No available quests. Check back later!</p>
        @endforelse
    </div>
@endsection