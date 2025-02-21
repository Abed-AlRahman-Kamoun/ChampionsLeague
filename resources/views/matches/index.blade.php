@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="champions-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <img src="https://brandlogos.net/wp-content/uploads/2013/06/uefa-champions-league-eps-vector-logo-400x400.png" 
                     alt="Champions League" 
                     class="h-8">
                Matches
            </h1>
            <form action="{{ route('matches.generate') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors">
                    Generate Matches
                </button>
            </form>
        </div>

        @foreach($organizedMatches as $round => $matches)
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Round {{ $round }}</h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($matches as $match)
                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="text-center space-y-4">
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 font-medium mx-auto mb-2">
                                    {{ strtoupper(substr($match->homePlayer->name, 0, 1)) }}
                                </div>
                                <div class="text-gray-800 font-medium">{{ $match->homePlayer->name }}</div>
                            </div>
                            @if($match->played)
                                <div class="px-6 py-3 bg-gray-50 rounded-lg mx-2">
                                    <span class="text-2xl font-bold text-gray-800">{{ $match->home_score }}</span>
                                    <span class="text-gray-400 mx-2">-</span>
                                    <span class="text-2xl font-bold text-gray-800">{{ $match->away_score }}</span>
                                </div>
                            @else
                                <div class="px-4 py-2 bg-gray-50 rounded-lg mx-2">
                                    <span class="text-sm text-gray-500">vs</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 font-medium mx-auto mb-2">
                                    {{ strtoupper(substr($match->awayPlayer->name, 0, 1)) }}
                                </div>
                                <div class="text-gray-800 font-medium">{{ $match->awayPlayer->name }}</div>
                            </div>
                        </div>
                        @if(!$match->played)
                        <div class="pt-2">
                            <a href="{{ route('matches.edit', $match) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Add Result
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection