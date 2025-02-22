<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FC25 Champions League</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
        }
        .champions-gradient {
            background: linear-gradient(135deg, #001838 0%, #022B5E 100%);
        }
        .champions-card {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }
        .champions-table th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }
        /* .champions-table tr:nth-child(even) {
            background: #f8fafc;
        } */
        .champions-table tr:hover {
            background: #edf2f7;
        }
        /* .champions-border-gradient {
            border-left: 4px solid;
            border-image: linear-gradient(to bottom, #001838, #022B5E) 1;
        } */
    </style>
</head>
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="champions-gradient">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-bold text-white">
                        FC25
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Table</a>
                    <a href="{{ route('matches.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Matches</a>
                    <a href="{{ route('players.create') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Players</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1  mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
</body>
</html>