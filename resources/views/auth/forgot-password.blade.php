<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - IdentifiGen</title>
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
                    <h1 class="text-3xl font-bold mb-4">Réinitialisation du mot de passe</h1>
                    <p class="text-blue-100 text-lg font-medium mb-2">Communauté Internationale de la Rédemption</p>
                    <p class="text-blue-100">Nous vous enverrons un lien sécurisé pour réinitialiser votre mot de passe.</p>
                </div>
            </div>
            <div class="md:w-1/2 bg-white p-12">
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg p-3">
                        {{ session('status') }}
                    </div>
                @endif
                
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Mot de passe oublié</h2>
                    <p class="text-gray-600">Saisissez votre adresse email pour recevoir un lien de réinitialisation</p>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="mail" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                        </div>
                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-bold hover:bg-blue-700 transition flex items-center justify-center">
                        <i data-feather="send" class="w-5 h-5 mr-2"></i> Envoyer le lien de réinitialisation
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        <i data-feather="arrow-left" class="w-4 h-4 inline mr-1"></i>
                        Retour à la connexion
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>feather.replace();</script>
</body>
</html>
