@extends('layouts.app')
@section('content')
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold">Hunter Dashboard</h1>
        <div class="mt-4 text-2xl">
            Rank: <span class="text-red-400 font-bold">{{ auth()->user()->rank }}</span> |
            XP: {{ auth()->user()->xp }} |
            Gold: {{ auth()->user()->gold }}
        </div>
        <a href="/quests" class="mt-4 inline-block bg-red-600 hover:bg-red-700 px-6 py-3 rounded font-bold">Quest Board
            ({{ $availableQuests }} available)</a>
    </div>

    @if($activeQuest)
        <div class="bg-gray-800 p-8 rounded-lg border border-red-600 max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-red-400">Active Quest: {{ $activeQuest->title }}</h2>
            <p class="mt-4 text-lg">{{ $activeQuest->description }}</p>
            <div class="mt-4">
                Reward: {{ $activeQuest->xp_reward }} XP + {{ $activeQuest->gold_reward }} Gold
            </div>

            @if($activeQuest->status == 'in_progress')
                <form action="/quests/{{ $activeQuest->id }}/submit-proof" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <textarea name="proof_text" placeholder="Describe how you completed the quest..." required rows="4"
                        class="w-full p-3 bg-gray-700 rounded mb-4"></textarea>
                    <input type="file" name="proof_image" accept="image/*" class="mb-4">
                    <button class="bg-red-600 hover:bg-red-700 px-8 py-3 rounded font-bold text-xl">Submit Proof</button>
                </form>
            @else
                <p class="text-red-400 text-xl">Proof submitted! Waiting for Guild Master...</p>
            @endif
        </div>
    @else
        <p class="text-center text-2xl mt-10">No active quest. Visit the Quest Board!</p>
    @endif

    <h2 class="text-2xl font-bold mt-12 mb-4">Recent Completed Quests</h2>

    <div class="recent-quests-wrapper">
        <div class="grid gap-4">
            @forelse($completedQuests as $q)
                <div class="bg-gray-800 p-4 rounded">{{ $q->title }} - Completed!</div>
            @empty
                <p>No completed quests yet. Keep hunting!</p>
            @endforelse
        </div>
    </div>

@endsection