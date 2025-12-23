<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\Custom_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestController extends Controller
{
    // Public Quest Board - Everyone logged in can see available quests
    public function board()
    {
        $quests = Quest::where('status', 'approved')
            ->whereNull('hunter_id')
            ->with('client')
            ->latest()
            ->get();

        return view('quests.board', compact('quests'));
    }

    // Client Dashboard
    public function clientDashboard()
    {
        if (!Auth::user()->isClient())
            abort(403);

        $postedQuests = Quest::where('client_id', Auth::id())->latest()->get();

        return view('client.dashboard', compact('postedQuests'));
    }

    // Client: Create Quest Form
    public function clientCreate()
    {
        if (!Auth::user()->isClient())
            abort(403);
        return view('client.create_quest');
    }

    // Client: Store Quest
    public function clientStore(Request $request)
    {
        if (!Auth::user()->isClient())
            abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:F,E,D,C,B,A,S',
            'xp_reward' => 'required|integer|min:10',
            'gold_reward' => 'required|integer|min:50',
        ]);

        Quest::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'difficulty' => $validated['difficulty'],
            'xp_reward' => $validated['xp_reward'],
            'gold_reward' => $validated['gold_reward'],
            'client_id' => Auth::id(),
            'status' => 'pending_approval',
        ]);

        return redirect('/client/dashboard')->with('success', 'Quest posted! Waiting for Admin approval.');
    }

    // Hunter Dashboard
    public function hunterDashboard()
    {
        if (!Auth::user()->isHunter())
            abort(403);

        $activeQuest = Quest::where('hunter_id', Auth::id())
            ->whereIn('status', ['in_progress', 'submitted'])
            ->first();

        $completedQuests = Quest::where('hunter_id', Auth::id())
            ->where('status', 'completed')
            ->latest()
            ->take(10)
            ->get();

        $availableQuests = Quest::where('status', 'approved')
            ->whereNull('hunter_id')
            ->count();

        return view('hunter.dashboard', compact('activeQuest', 'completedQuests', 'availableQuests'));
    }

    // Hunter: Accept Quest
    public function accept($id)
    {
        if (!Auth::user()->isHunter())
            abort(403);

        $quest = Quest::findOrFail($id);

        if ($quest->status !== 'approved' || $quest->hunter_id !== null) {
            return back()->with('error', 'Quest no longer available.');
        }

        $quest->update([
            'hunter_id' => Auth::id(),
            'status' => 'in_progress'
        ]);

        return redirect('/hunter/dashboard')->with('success', 'Quest accepted! Prove your worth.');
    }

    // Hunter: Submit Proof
    public function submitProof(Request $request, $id)
    {
        if (!Auth::user()->isHunter())
            abort(403);

        $quest = Quest::findOrFail($id);
        if ($quest->hunter_id != Auth::id() || $quest->status !== 'in_progress')
            abort(403);

        $validated = $request->validate([
            'proof_text' => 'required|string',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = ['proof_text' => $validated['proof_text'], 'status' => 'submitted'];

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('proofs', 'public');
            $data['proof_image'] = $path;
        }

        $quest->update($data);

        return redirect('/hunter/dashboard')->with('success', 'Proof submitted! Waiting for Guild Master approval.');
    }

    // Admin Dashboard
    public function adminDashboard()
    {
        if (!Auth::user()->isAdmin())
            abort(403);

        $pendingQuests = Quest::where('status', 'pending_approval')->with('client')->get();
        $submittedProofs = Quest::where('status', 'submitted')->with('hunter')->get();
        $totalHunters = Custom_user::whereHas('roles', fn($q) => $q->where('name', 'Hunter'))->count();
        $totalClients = Custom_user::whereHas('roles', fn($q) => $q->where('name', 'Client'))->count();
        $totalCompleted = Quest::where('status', 'completed')->count();

        return view('admin.dashboard', compact('pendingQuests', 'submittedProofs', 'totalHunters', 'totalClients', 'totalCompleted'));
    }

    // Admin: Approve Quest
    public function approveQuest($id)
    {
        if (!Auth::user()->isAdmin())
            abort(403);
        Quest::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Quest approved!');
    }

    // Admin: Reject Quest
    public function rejectQuest($id)
    {
        if (!Auth::user()->isAdmin())
            abort(403);
        Quest::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Quest rejected.');
    }

    // Admin: Complete Quest & Give Rewards
    public function completeQuest($id)
    {
        if (!Auth::user()->isAdmin())
            abort(403);

        $quest = Quest::findOrFail($id);
        if ($quest->status !== 'submitted')
            abort(403);

        $hunter = $quest->hunter;

        $hunter->xp += $quest->xp_reward;
        $hunter->gold += $quest->gold_reward;

        // Rank Up Logic
        $thresholds = ['F' => 0, 'E' => 200, 'D' => 500, 'C' => 1000, 'B' => 2000, 'A' => 4000, 'S' => 8000];
        foreach ($thresholds as $rank => $xp) {
            if ($hunter->xp >= $xp) {
                $hunter->rank = $rank;
            }
        }

        $hunter->save();
        $quest->update(['status' => 'completed']);

        return back()->with('success', "Quest completed! {$hunter->name} ranked up to {$hunter->rank}!");
    }

    // Admin: Ban/Unban User
    public function toggleBan($userId)
    {
        if (!Auth::user()->isAdmin())
            abort(403);

        $user = Custom_user::findOrFail($userId);
        $user->is_banned = !$user->is_banned;
        $user->save();

        return back()->with('success', $user->is_banned ? 'User banned.' : 'User unbanned.');
    }
}