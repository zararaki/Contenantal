@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/client_style.css') }}">

    <div class="client-container">

        <h1 class="page-title">Client Dashboard</h1>

        <div class="dashboard-actions">
            <a href="/client/create-quest" class="primary-btn">
                Post New Quest
            </a>
        </div>

        <div class="quest-grid">
            @forelse($postedQuests as $q)
                <div class="quest-card  
                                                {{ $q->status == 'pending_approval' ? 'status-pending' : 'status-approved' }}">

                    <h3 class="quest-title">{{ $q->title }}</h3>

                    <p class="quest-status">
                        Status:
                        <span>{{ ucwords(str_replace('_', ' ', $q->status)) }}</span>
                    </p>

                    @if($q->hunter)
                        <p class="quest-meta">Hunter: {{ $q->hunter->name }}</p>
                    @endif

                    @if($q->status == 'submitted' && $q->proof_image)
                        <img src="{{ asset('storage/' . $q->proof_image) }}" alt="Proof Image">
                    @endif
                </div>
            @empty
                <p> </p>
                <p class="empty-state">You haven't posted any quests yet.</p>
            @endforelse
        </div>

    </div>
@endsection