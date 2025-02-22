@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="champions-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <img src="https://brandlogos.net/wp-content/uploads/2013/06/uefa-champions-league-eps-vector-logo-400x400.png" 
                     alt="Champions League" 
                     class="h-8">
                League Table
            </h1>
        </div>

        <!-- Fix for table overflow -->
        <div class="w-full overflow-x-auto">
            <table class="champions-table overflow-x-auto w-full" style="min-width: 600px">
                <thead>
                    <tr class="text-left">
                        <th class="sticky  px-2 py-4 text-sm font-semibold text-gray-600">#</th>
                        <th class="sticky left-0 px-2 py-4 text-sm font-semibold text-gray-600">Player</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">Played</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">Won</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">Drawn</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">Lost</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">GF</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">GA</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">GD</th>
                        <th class="px-2 py-4 text-sm font-semibold text-gray-600 text-center">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $index => $player)
                    <tr class="border-t border-gray-100">
                        <td class="sticky bg-white z-20 text-sm text-gray-600">
                            <div class="px-2 py-4 {{ $index < 8 ? 'border-l-4 border-l-green-500' : ($index >= count($players) - 2 ? 'border-l-4 border-l-red-500' : '') }}">{{ $index + 1 }}</div>
                        </td>
                        <td class="sticky left-0 bg-white z-10 px-2 py-4 ">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 font-medium mr-3">
                                    <img src="{{ env('APP_URL') . '/logos/'. $player->team . '.png' }}" alt="">
                                </div>
                                <span class="font-medium text-gray-800">{{ $player->name }}</span>
                            </div>
                        </td>
                        <td class="px-2 py-4 text-center text-gray-600">{{ $player->played }}</td>
                        <td class="px-2 py-4 text-center text-green-600 font-medium">{{ $player->won }}</td>
                        <td class="px-2 py-4 text-center text-gray-600">{{ $player->drawn }}</td>
                        <td class="px-2 py-4 text-center text-red-600 font-medium">{{ $player->lost }}</td>
                        <td class="px-2 py-4 text-center text-gray-600">{{ $player->goals_for }}</td>
                        <td class="px-2 py-4 text-center text-gray-600">{{ $player->goals_against }}</td>
                        <td class="px-2 py-4 text-center {{ $player->goal_difference > 0 ? 'text-green-600' : ($player->goal_difference < 0 ? 'text-red-600' : 'text-gray-600') }} font-medium">
                            {{ $player->goal_difference > 0 ? '+' : '' }}{{ $player->goal_difference }}
                        </td>
                        <td class="px-2 py-4 text-center">
                            <span class="font-bold text-gray-800 text-lg">{{ $player->points }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Legend -->
    <div class="champions-card p-4">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-green-500"></div>
                <span class="text-sm text-gray-600">Qualified</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-red-500"></div>
                <span class="text-sm text-gray-600">Relegated</span>
            </div>
        </div>
    </div>
</div>
@endsection