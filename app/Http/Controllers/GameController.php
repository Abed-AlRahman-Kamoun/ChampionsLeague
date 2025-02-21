<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['homePlayer', 'awayPlayer'])->get();
        $players = Player::all();

        $organizedMatches = $this->organizeMatchesIntoRounds($games, $players);

        return view('matches.index', compact('organizedMatches'));
    }

    private function organizeMatchesIntoRounds($games, $players)
    {
        $playerCount = $players->count();
        $matchesPerRound = floor($playerCount / 2);
        $organizedMatches = [];

        foreach ($games as $game) {
            $round = 1;
            $placed = false;

            while (!$placed) {
                if (!isset($organizedMatches[$round])) {
                    $organizedMatches[$round] = [];
                }

                $playersInRound = collect($organizedMatches[$round])->flatMap(function ($match) {
                    return [$match->home_player_id, $match->away_player_id];
                });

                if (
                    !$playersInRound->contains($game->home_player_id) &&
                    !$playersInRound->contains($game->away_player_id) &&
                    count($organizedMatches[$round]) < $matchesPerRound
                ) {
                    $organizedMatches[$round][] = $game;
                    $placed = true;
                } else {
                    $round++;
                }
            }
        }

        ksort($organizedMatches);
        return $organizedMatches;
    }

    public function create()
    {
        $players = Player::all();
        return view('matches.create', compact('players'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0',
        ]);

        $match = Game::find($request->game_id);
        $match->update([
            'home_score' => $request->home_score,
            'away_score' => $request->away_score,
            'played' => 1
        ]);
        $this->updatePlayerStats($match);

        return redirect()->route('matches.index')->with('success', 'Match result added successfully.');
    }

    private function updatePlayerStats(Game $match)
    {
        $homePlayer = $match->homePlayer;
        $awayPlayer = $match->awayPlayer;

        $homePlayer->played++;
        $awayPlayer->played++;

        $homePlayer->goals_for += $match->home_score;
        $homePlayer->goals_against += $match->away_score;
        $awayPlayer->goals_for += $match->away_score;
        $awayPlayer->goals_against += $match->home_score;

        if ($match->home_score > $match->away_score) {
            $homePlayer->won++;
            $homePlayer->points += 3;
            $awayPlayer->lost++;
        } elseif ($match->home_score < $match->away_score) {
            $awayPlayer->won++;
            $awayPlayer->points += 3;
            $homePlayer->lost++;
        } else {
            $homePlayer->drawn++;
            $awayPlayer->drawn++;
            $homePlayer->points++;
            $awayPlayer->points++;
        }

        $homePlayer->save();
        $awayPlayer->save();
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);

        return view('matches.create', compact('game'));
    }

    public function generateMatches()
    {
        $players = Player::all();
        $playerCount = $players->count();

        for ($i = 0; $i < $playerCount; $i++) {
            for ($j = $i + 1; $j < $playerCount; $j++) {
                $homePlayer = $players[$i];
                $awayPlayer = $players[$j];

                $existingMatch = Game::where(function ($query) use ($homePlayer, $awayPlayer) {
                    $query->where('home_player_id', $homePlayer->id)
                        ->where('away_player_id', $awayPlayer->id);
                })->orWhere(function ($query) use ($homePlayer, $awayPlayer) {
                    $query->where('home_player_id', $awayPlayer->id)
                        ->where('away_player_id', $homePlayer->id);
                })->first();

                if (!$existingMatch) {
                    Game::create([
                        'home_player_id' => $homePlayer->id,
                        'away_player_id' => $awayPlayer->id,
                    ]);
                }
            }
        }

        return redirect()->route('matches.index')->with('success', 'Matches generated successfully.');
    }
}
