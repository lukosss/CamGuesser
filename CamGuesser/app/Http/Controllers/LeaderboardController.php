<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class LeaderboardController extends Controller
{
    public function index(): View
    {
        $leaderboard = Leaderboard::all();
        return view('leaderboard',compact('leaderboard'));
    }

    public function uploadScore(Request $request): Leaderboard
    {
        $newScore = new Leaderboard();
        $newScore->player_name = $request->post['player_name'];
        $newScore->score = $request->post['score'];
        $newScore->game_mode = $request->post['game_mode'];
        $newScore->save();

        return $newScore;
    }
}
