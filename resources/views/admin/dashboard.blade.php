@extends('layouts.app')

@section('content')
    <!-- Link to admin-specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">

    <h1 class="admin-title">Guild Master Dashboard</h1>

    <!-- Stats Grid -->
    <div class="stats-grid mb-10">
        <div class="stat-box">
            <p>{{ $totalHunters }}</p>
            <p>Hunters</p>
        </div>
        <div class="stat-box">
            <p>{{ $totalClients }}</p>
            <p>Clients</p>
        </div>
        <div class="stat-box">
            <p>{{ $totalCompleted }}</p>
            <p>Completed Quests</p>
        </div>
    </div>

    <!-- Pending Quest Approval -->
    <h2 class="section-title">Pending Quest Approval ({{ $pendingQuests->count() }})</h2>
    <div class="grid gap-4 mb-10">
        @forelse($pendingQuests as $q)
            <div class="quest-card">
                <h3>{{ $q->title }}</h3>
                <p>Client: {{ $q->client->name }}</p>
                <div class="mt-4 space-x-4">
                    <form action="/admin/approve-quest/{{ $q->id }}" method="POST" class="inline">@csrf
                        <button class="button button-green">Approve</button>
                    </form>
                    <form action="/admin/reject-quest/{{ $q->id }}" method="POST" class="inline">@csrf
                        <button class="button button-red">Reject</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No quests waiting for approval.</p>
        @endforelse
    </div>

    <!-- Submitted Proofs -->
    <h2 class="section-title">Submitted Proofs ({{ $submittedProofs->count() }})</h2>
    <div class="grid gap-6">
        @forelse($submittedProofs as $q)
            <div class="quest-card">
                <h3>{{ $q->title }}</h3>
                <p>Hunter: {{ $q->hunter->name }}</p>
                <p class="mt-2"><strong>Proof:</strong> {{ $q->proof_text }}</p>
                @if($q->proof_image)
                    <img src="{{ asset('storage/' . $q->proof_image) }}" alt="Proof">
                @endif
                <form action="/admin/complete-quest/{{ $q->id }}" method="POST" class="mt-4">
                    @csrf
                    <button class="button button-green">Complete Quest & Give Rewards</button>
                </form>
            </div>
        @empty
            <p>No proofs waiting.</p>
        @endforelse
    </div>
@endsection