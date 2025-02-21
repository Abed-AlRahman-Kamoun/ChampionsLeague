<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::selectRaw('*, (goals_for - goals_against) as goal_difference')
            ->orderBy('points', 'desc')
            ->orderByRaw('(goals_for - goals_against) DESC')
            ->get();
        return view('players.index', compact('players'));
    }

    public function create()
    {
        return view('players.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:players|max:255',
            'team' => 'required',
        ]);

        Player::create($request->all());

        return redirect()->route('players.create')->with('success', 'Player added successfully.');
    }
}
