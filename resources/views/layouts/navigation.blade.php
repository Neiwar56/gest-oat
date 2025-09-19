<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo + Liens -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-9 w-auto text-blue-600" />
                    <span class="font-bold text-lg text-gray-800 hidden sm:inline">IdentifiGen</span>
                </a>

                <!-- Liens principaux -->
                <div class="hidden sm:flex space-x-6">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center space-x-2 {{ request()->routeIs('dashboard') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }}">
                        <i data-feather="home" class="h-4 w-4"></i>
                        <span>Tableau de Bord</span>
                    </a>
                    <a href="{{ route('personnes.index') }}"
                       class="flex items-center space-x-2 {{ request()->routeIs('personnes.*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }}">
                        <i data-feather="users" class="h-4 w-4"></i>
                        <span>Personnes</span>
                    </a>
                    <a href="{{ route('admins.index') }}"
                       class="flex items-center space-x-2 {{ request()->routeIs('admins.*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900' }}">
                        <i data-feather="shield" class="h-4 w-4"></i>
                        <span>Administrateurs</span>
                    </a>
                </div>
            </div>

            <!-- Profil + Déconnexion -->
            <div class="hidden sm:flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <span class="hidden md:block text-right">
                        <span class="text-gray-800 font-medium">{{ Auth::user()->name }}</span><br>
                        <span class="text-xs text-gray-500">{{ __('Super Admin') }}</span>
                    </span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff"
                         class="h-9 w-9 rounded-full border" alt="Avatar">
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700">
                        <i data-feather="log-out" class="h-4 w-4 mr-1"></i> Déconnexion
                    </button>
                </form>
            </div>

            <!-- Bouton mobile -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <i data-feather="menu" class="h-5 w-5"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-t">
        <div class="py-3 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                <i data-feather="home" class="inline h-4 w-4 mr-2"></i> Tableau de Bord
            </a>
            <a href="{{ route('personnes.index') }}" class="block px-4 py-2 {{ request()->routeIs('personnes.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                <i data-feather="users" class="inline h-4 w-4 mr-2"></i> Personnes
            </a>
            <a href="{{ route('admins.index') }}" class="block px-4 py-2 {{ request()->routeIs('admins.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                <i data-feather="shield" class="inline h-4 w-4 mr-2"></i> Administrateurs
            </a>
            <div class="border-t mt-2"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                    <i data-feather="log-out" class="inline h-4 w-4 mr-2"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    <script>feather.replace();</script>
</nav>
