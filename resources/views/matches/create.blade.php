@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="champions-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <img src="https://brandlogos.net/wp-content/uploads/2013/06/uefa-champions-league-eps-vector-logo-400x400.png" 
                     alt="Champions League" 
                     class="h-8">
                Add Match Result
            </h1>
        </div>

        <form method="POST" action="{{ route('matches.store') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="home_player_id" class="block text-sm font-medium text-gray-700 mb-2">Home Player</label>
                    {{ $game->homePlayer->name }}
                </div>

                <div>
                    <label for="away_player_id" class="block text-sm font-medium text-gray-700 mb-2">Away Player</label>
                    {{ $game->awayPlayer->name }}
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <div>
                    <label for="home_score" class="block text-sm font-medium text-gray-700 mb-2">Home Score</label>
                    <input type="number" name="home_score" id="home_score" required min="0" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="away_score" class="block text-sm font-medium text-gray-700 mb-2">Away Score</label>
                    <input type="number" name="away_score" id="away_score" required min="0" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
                    Add Match Result
                </button>
            </div>
        </form>
    </div>
</div>
@endsection