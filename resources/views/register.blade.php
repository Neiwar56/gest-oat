<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - IdentifiGen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .auth-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center">
    <div class="w-full max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row shadow-2xl rounded-xl overflow-hidden">
            <!-- Left Side - Illustration -->
            <div class="md:w-1/2 auth-bg text-white p-12 hidden md:flex flex-col justify-center">
                <div class="text-center">
                    <i data-feather="user-plus" class="w-16 h-16 mx-auto mb-6"></i>
                    <h1 class="text-3xl font-bold mb-4">Rejoignez IdentifiGen</h1>
                    <p class="text-blue-100">Créez votre compte pour accéder à la plateforme d'identification sécurisée.</p>
                </div>
                <img src="http://static.photos/technology/640x360/4" alt="Registration" class="mt-12 rounded-lg">
            </div>

            <!-- Right Side - Form -->
            <div class="md:w-1/2 bg-white p-12">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Créer un compte</h2>
                    <p class="text-gray-600">Remplissez les informations pour créer votre compte</p>
                </div>

                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="firstname" class="block text-gray-700 font-medium mb-2">Prénom</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-feather="user" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" id="firstname" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Votre prénom">
                            </div>
                        </div>
                        <div>
                            <label for="lastname" class="block text-gray-700 font-medium mb-2">Nom</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-feather="user" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" id="lastname" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Votre nom">
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="mail" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="email" id="email" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="votre@email.com">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="password" id="password" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="confirm-password" class="block text-gray-700 font-medium mb-2">Confirmer le mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="password" id="confirm-password" class="w-full pl-10 pr-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="role" class="block text-gray-700 font-medium mb-2">Rôle</label>
                        <select id="role" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                            <option value="">Sélectionner un rôle</option>
                            <option value="admin">Administrateur</option>
                            <option value="subadmin">Sous-Administrateur</option>
                            <option value="user">Utilisateur standard</option>
                        </select>
                    </div>
                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">J'accepte les <a href="#" class="text-blue-600 hover:text-blue-500">conditions d'utilisation</a></label>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-bold hover:bg-blue-700 transition flex items-center justify-center">
                        <i data-feather="user-plus" class="w-5 h-5 mr-2"></i> S'inscrire
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-600">Vous avez déjà un compte? <a href="login.html" class="text-blue-600 hover:text-blue-500 font-medium">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
