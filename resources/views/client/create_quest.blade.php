@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/client_style.css') }}">

    <div class="client-container">

        <h1 class="page-title">Post New Bounty</h1>

        <div class="quest-form-card">
            <form action="/client/create-quest" method="POST">
                @csrf

                <input type="text" name="title" placeholder="Quest Title" required>

                <textarea name="description" placeholder="Full quest description..." rows="5" required></textarea>

                <select name="difficulty" required>
                    <option value="">Select Difficulty Rank</option>
                    @foreach(['F', 'E', 'D', 'C', 'B', 'A', 'S'] as $d)
                        <option value="{{ $d }}">{{ $d }} Rank</option>
                    @endforeach
                </select>

                <input type="number" name="xp_reward" placeholder="XP Reward" min="10" required>

                <input type="number" name="gold_reward" placeholder="Gold Reward" min="50" required>

                <button type="submit" class="primary-btn">
                    Post Quest
                </button>
            </form>
        </div>

    </div>
@endsection