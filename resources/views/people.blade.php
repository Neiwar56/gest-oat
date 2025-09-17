<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Personnes - IdentifiGen</title>
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
                            <a href="people.html" class="flex items-center p-3 rounded-lg active-link">
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Personnes</h1>
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

            <!-- People Content -->
            <main class="p-6">
                <!-- Filters and Search -->
                <div class="bg-white p-6 rounded-xl shadow mb-6" data-aos="fade-up">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-1">
                            <input type="text" placeholder="Rechercher..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:outline-none">
                                <option value="">Tous les genres</option>
                                <option value="male">Homme</option>
                                <option value="female">Femme</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>
                        <div>
                            <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:outline-none">
                                <option value="">Tous les statuts</option>
                                <option value="verified">Validé</option>
                                <option value="pending">En attente</option>
                                <option value="rejected">Rejeté</option>
                            </select>
                        </div>
                        <div>
                            <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center">
                                <i data-feather="filter" class="w-4 h-4 mr-2"></i> Filtrer
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add New Button -->
                <div class="mb-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="add-person.html" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> Ajouter une personne
                    </a>
                </div>

                <!-- People List -->
                <div class="bg-white rounded-xl shadow overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold">Liste des Personnes</h2>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">1-10 sur 1,248 résultats</span>
                                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
                                    <i data-feather="chevron-left" class="w-4 h-4"></i>
                                </button>
                                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
                                    <i data-feather="chevron-right" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Naissance</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identifiant</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1254</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="http://static.photos/people/200x200/9" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Sophie Laurent</div>
                                                <div class="text-sm text-gray-500">sophie@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Femme</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/03/1985</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ID-789456</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validé</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900 mr-3">Modifier</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1253</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="http://static.photos/people/200x200/10" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Thomas Moreau</div>
                                                <div class="text-sm text-gray-500">thomas@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Homme</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22/07/1990</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ID-654321</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900 mr-3">Modifier</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1252</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="http://static.photos/people/200x200/11" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Emma Dubois</div>
                                                <div class="text-sm text-gray-500">emma@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Femme</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/12/1978</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ID-321654</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validé</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900 mr-3">Modifier</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1251</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="http://static.photos/people/200x200/12" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Jean Lefèvre</div>
                                                <div class="text-sm text-gray-500">jean@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Homme</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">03/05/1982</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ID-987123</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejeté</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900 mr-3">Modifier</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1250</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="http://static.photos/people/200x200/13" alt="" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Camille Petit</div>
                                                <div class="text-sm text-gray-500">camille@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Femme</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/11/1995</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ID-456789</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validé</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900 mr-3">Modifier</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Supprimer</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-700">Affichage <span class="font-medium">1</span> à <span class="font-medium">5</span> sur <span class="font-medium">1,248</span> résultats</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Précédent</button>
                                <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">1</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Suivant</button>
                            </div>
                        </div>
                    </div>
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
s