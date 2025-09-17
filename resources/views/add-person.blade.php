<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Personne - IdentifiGen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar.collapsed .sidebar-icon {
            margin-right: 0;
        }
        .active-link {
            background-color: #eff6ff;
            color: #3b82f6;
        }
        .active-link svg {
            color: #3b82f6;
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-lg w-64 flex-shrink-0">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i data-feather="users" class="w-6 h-6 text-blue-600"></i>
                        <span class="ml-2 text-xl font-bold">IdentifiGen</span>
                    </div>
                    <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700">
                        <i data-feather="chevron-left" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div class="mb-8">
                    <div class="flex items-center p-3 rounded-lg bg-blue-50">
                        <div class="relative">
                            <img src="http://static.photos/people/200x200/5" alt="User" class="w-10 h-10 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                        </div>
                        <div class="ml-3 sidebar-text">
                            <p class="font-medium">Admin Principal</p>
                            <p class="text-sm text-gray-500">Super Admin</p>
                        </div>
                    </div>
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="dashboard.html" class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                                <i data-feather="home" class="w-5 h-5 sidebar-icon"></i>
                                <span class="ml-3 sidebar-text">Tableau de Bord</span>
                            </a>
                        </li>
                        <li>
                            <a href="people.html" class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                                <i data-feather="users" class="w-5 h-5 sidebar-icon"></i>
                                <span class="ml-3 sidebar-text">Personnes</span>
                            </a>
                        </li>
                        <li>
                            <a href="admins.html" class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                                <i data-feather="shield" class="w-5 h-5 sidebar-icon"></i>
                                <span class="ml-3 sidebar-text">Administrateurs</span>
                            </a>
                        </li>
                        <li>
                            <a href="reports.html" class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                                <i data-feather="file-text" class="w-5 h-5 sidebar-icon"></i>
                                <span class="ml-3 sidebar-text">Rapports</span>
                            </a>
                        </li>
                        <li>
                            <a href="settings.html" class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                                <i data-feather="settings" class="w-5 h-5 sidebar-icon"></i>
                                <span class="ml-3 sidebar-text">Paramètres</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="p-4 border-t border-gray-200 absolute bottom-0 w-full">
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                    <i data-feather="log-out" class="w-5 h-5 sidebar-icon"></i>
                    <span class="ml-3 sidebar-text">Déconnexion</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Ajouter une Personne</h1>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
                            <i data-feather="bell" class="w-5 h-5"></i>
                        </button>
                        <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
                            <i data-feather="help-circle" class="w-5 h-5"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center space-x-2">
                                <img src="http://static.photos/people/200x200/5" alt="User" class="w-8 h-8 rounded-full">
                                <span class="hidden md:inline">Admin Principal</span>
                                <i data-feather="chevron-down" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Add Person Form -->
            <main class="p-6">
                <div class="bg-white p-8 rounded-xl shadow" data-aos="fade-up">
                    <form>
                        <!-- Personal Information Section -->
                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Informations Personnelles</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="firstname" class="block text-gray-700 font-medium mb-2">Prénom</label>
                                    <input type="text" id="firstname" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez le prénom">
                                </div>
                                <div>
                                    <label for="lastname" class="block text-gray-700 font-medium mb-2">Nom</label>
                                    <input type="text" id="lastname" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez le nom">
                                </div>
                                <div>
                                    <label for="gender" class="block text-gray-700 font-medium mb-2">Genre</label>
                                    <select id="gender" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                                        <option value="">Sélectionner un genre</option>
                                        <option value="male">Homme</option>
                                        <option value="female">Femme</option>
                                        <option value="other">Autre</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="birthdate" class="block text-gray-700 font-medium mb-2">Date de Naissance</label>
                                    <input type="date" id="birthdate" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="nationality" class="block text-gray-700 font-medium mb-2">Nationalité</label>
                                    <input type="text" id="nationality" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez la nationalité">
                                </div>
                                <div>
                                    <label for="id-number" class="block text-gray-700 font-medium mb-2">Numéro d'Identification</label>
                                    <input type="text" id="id-number" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez le numéro d'ID">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Coordonnées</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                    <input type="email" id="email" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez l'email">
                                </div>
                                <div>
                                    <label for="phone" class="block text-gray-700 font-medium mb-2">Téléphone</label>
                                    <input type="tel" id="phone" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez le numéro de téléphone">
                                </div>
                                <div>
                                    <label for="address" class="block text-gray-700 font-medium mb-2">Adresse</label>
                                    <input type="text" id="address" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez l'adresse">
                                </div>
                                <div>
                                    <label for="city" class="block text-gray-700 font-medium mb-2">Ville</label>
                                    <input type="text" id="city" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez la ville">
                                </div>
                                <div>
                                    <label for="country" class="block text-gray-700 font-medium mb-2">Pays</label>
                                    <input type="text" id="country" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez le pays">
                                </div>
                                <div>
                                    <label for="postal-code" class="block text-gray-700 font-medium mb-2">Code Postal</label>
                                    <input type="text" id="postal-code" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez le code postal">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Informations Supplémentaires</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="profession" class="block text-gray-700 font-medium mb-2">Profession</label>
                                    <input type="text" id="profession" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Entrez la profession">
                                </div>
                                <div>
                                    <label for="education" class="block text-gray-700 font-medium mb-2">Niveau d'Éducation</label>
                                    <select id="education" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                                        <option value="">Sélectionner un niveau</option>
                                        <option value="primary">Primaire</option>
                                        <option value="secondary">Secondaire</option>
                                        <option value="bachelor">Licence</option>
                                        <option value="master">Master</option>
                                        <option value="phd">Doctorat</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="status" class="block text-gray-700 font-medium mb-2">Statut</label>
                                    <select id="status" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none">
                                        <option value="">Sélectionner un statut</option>
                                        <option value="verified">Validé</option>
                                        <option value="pending">En attente</option>
                                        <option value="rejected">Rejeté</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="notes" class="block text-gray-700 font-medium mb-2">Notes</label>
                                    <textarea id="notes" rows="3" class="w-full px-4 py-3 rounded-lg form-input border border-gray-300 focus:border-blue-500 focus:outline-none" placeholder="Ajoutez des notes si nécessaire"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Upload Section -->
                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Photo d'Identité</h2>
                            <div class="flex items-center justify-center w-full">
                                <label for="photo" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i data-feather="upload" class="w-12 h-12 text-gray-400 mb-3"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquez pour télécharger</span> ou glissez-déposez</p>
                                        <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                                    </div>
                                    <input id="photo" type="file" class="hidden" />
                                </label>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4">
                            <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">
                                Annuler
                            </button>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition flex items-center">
                                <i data-feather="save" class="w-4 h-4 mr-2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
        feather.replace();

        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            const icon = this.querySelector('i');
            if (document.querySelector('.sidebar').classList.contains('collapsed')) {
                feather.icons['chevron-right'].replace(icon);
            } else {
                feather.icons['chevron-left'].replace(icon);
            }
        });
    </script>
</body>
</html>