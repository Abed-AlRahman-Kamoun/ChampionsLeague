@extends('layouts.app')

@section('content')
<div class="w-96 mx-auto">
    <div class="champions-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <img src="https://brandlogos.net/wp-content/uploads/2013/06/uefa-champions-league-eps-vector-logo-400x400.png" 
                     alt="Champions League" 
                     class="h-8">
                Add New Player
            </h1>
        </div>

        <form method="POST" action="{{ route('players.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Player Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    required 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter player name"
                >
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Player Team</label>
                <Select required class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="team">
                    <option value="RealMadrid">Real Madrid</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="AtleticoMadrid">Atletico Madrid</option>
                    <option value="ManchesterCity">Manchester City</option>
                    <option value="ManchesterUnited">Manchester United</option>
                    <option value="Arsenal">Arsenal</option>
                    <option value="Chelsea">Chelsea</option>
                    <option value="Liverpool">Liverpool</option>
                    <option value="Tottenham">Tottenham</option>
                    <option value="BayernMunich">Bayern Munich</option>
                    <option value="Dortmund">Dortmund</option>
                    <option value="BayerLeverkusen">Bayer Leverkusen</option>
                    <option value="ACMilan">AC Milan</option>
                    <option value="InterMilan">Inter Milan</option>
                    <option value="Juventus">Juventus</option>
                    <option value="PSG">Paris Saint German</option>
                </Select>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
                    Add Player
                </button>
            </div>
        </form>
    </div>
</div>
@endsection