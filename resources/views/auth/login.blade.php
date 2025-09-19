<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - IdentifiGen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .auth-bg { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
        .form-input { transition: all 0.3s ease; }
        .form-input:focus { box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5); }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center">
    <div class="w-full max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row shadow-2xl rounded-xl overflow-hidden">
            <div class="md:w-1/2 auth-bg text-white p-12 hidden md:flex flex-col justify-center">
                <div class="text-center">
                    <!-- Logo de la Communauté Internationale de la Rédemption -->
        <div class="mb-8">
            <img src="{{ asset('images/images.jpg') }}" 
                 alt="Communauté Internationale de la Rédemption" 
                 class="w-40 h-40 mx-auto mb-4 object-contain rounded-2xl shadow-lg">
        </div>
                    <h1 class="text-3xl font-bold mb-4">IdentifiGen</h1>
                    <p class="text-blue-100 text-lg font-medium mb-2">Communauté Internationale de la Rédemption</p>
                    <p class="text-blue-100">Plateforme sécurisée d'identification et de gestion des données personnelles.</p>
                </div>
            </div>
            <div class="md:w-1/2 bg-white p-12">
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">{{ session('status') }}</div>
                @endif
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Connexion</h2>
                    <p class="text-gray-600">Accédez à votre tableau de bord d'administration</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="mail" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                        </div>
                        @error('email')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                        </div>
                        @error('password')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="ml-2 block text-sm text-gray-700">Se souvenir de moi</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-bold hover:bg-blue-700 transition flex items-center justify-center">
                        <i data-feather="log-in" class="w-5 h-5 mr-2"></i> Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>feather.replace();</script>
</body>
</html>
