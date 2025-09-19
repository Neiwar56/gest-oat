<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IdentifiGen')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('head')
    <style>
        .sidebar{
            transition: all .3s ease;
            z-index: 40;
            display: flex;
            flex-direction: column;
        }
        .sidebar.collapsed{
            width: 80px;
        }
        .sidebar.collapsed .sidebar-text{
            display: none;
        }
        .sidebar.collapsed .sidebar-icon{
            margin-right: 0;
        }
        .sidebar.collapsed .w-10{
            width: 2rem;
            height: 2rem;
        }
        .sidebar.collapsed .p-6{
            padding: 1rem;
        }
        .sidebar.collapsed .p-4{
            padding: 0.75rem;
        }
        .sidebar.collapsed .px-6{
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .sidebar.collapsed .space-x-3 > * + * {
            margin-left: 0;
        }
        .sidebar.collapsed .sidebar-content {
            justify-content: center;
            width: 100%;
        }
        .sidebar.collapsed .w-10 {
            margin: 0;
        }
        .sidebar.collapsed .justify-between {
            justify-content: center;
        }
        
        /* Mobile sidebar styles */
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 280px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 50;
            }
            .sidebar.block {
                transform: translateX(0);
            }
            .sidebar.hidden {
                transform: translateX(-100%);
            }
        }
        
        /* Backdrop for mobile */
        .sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 45;
        }
        
        /* Smooth transitions for all elements */
        .sidebar * {
            transition: all 0.3s ease;
        }
        
        /* Perfect alignment for header and sidebar borders */
        .header-border, .sidebar-border {
            padding: 1.5rem 1.5rem !important;
            margin: 0 !important;
            box-sizing: border-box !important;
        }
        
        /* Ensure the sidebar and main content are perfectly aligned */
        .sidebar {
            box-sizing: border-box !important;
        }
        
        .flex-1 {
            box-sizing: border-box !important;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">
    <div class="sidebar bg-white w-64 flex-shrink-0" style="box-shadow: none; border-right: 1px solid #e5e7eb;">
        <div class="px-6 py-4 sidebar-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 sidebar-content">
        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <img src="{{ asset('images/images.jpg') }}" 
                 alt="Communauté Internationale de la Rédemption" 
                 class="w-8 h-8 object-contain">
        </div>
                    <div class="sidebar-text">
                        <span class="text-xl font-bold text-gray-800">IdentifiGen</span>
                    </div>
                </div>
                <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700 p-1 rounded hover:bg-gray-100 flex-shrink-0">
                    <i data-feather="chevron-left" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
        <div class="p-4">
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 {{ request()->routeIs('dashboard') ? 'active-link' : '' }}">
                            <i data-feather="home" class="w-5 h-5 sidebar-icon"></i>
                            <span class="ml-3 sidebar-text">Tableau de Bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('personnes.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 {{ request()->routeIs('personnes.*') ? 'active-link' : '' }}">
                            <i data-feather="users" class="w-5 h-5 sidebar-icon"></i>
                            <span class="ml-3 sidebar-text">Personnes</span>
                        </a>
                    </li>
                    @can('is-super-admin')
                    <li>
                        <a href="{{ route('admins.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admins.*') ? 'active-link' : '' }}">
                            <i data-feather="shield" class="w-5 h-5 sidebar-icon"></i>
                            <span class="ml-3 sidebar-text">Administrateurs</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </nav>
        </div>
    </div>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white sticky top-0 z-10" style="box-shadow: none; border-bottom: 1px solid #e5e7eb;">
            <div class="flex items-center justify-between px-6 py-4 header-border">
                <div class="flex items-center space-x-4">
                    <button id="mobileMenuToggle" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <i data-feather="menu" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="h-9 w-9 rounded-full bg-blue-100 text-blue-700 font-semibold flex items-center justify-center">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-medium text-gray-800">{{ auth()->user()->name ?? '' }}</div>
                            <div class="text-xs text-gray-500">
                                @can('is-super-admin') Super Admin @else Admin @endcan
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md">
                            <i data-feather="log-out" class="w-4 h-4 mr-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-auto bg-gray-50">
            <!-- Page Header -->
            @hasSection('header')
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('header')</h1>
                </div>
            @endif
            
            <!-- Main Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script>
    AOS.init({duration:800, once:true});
    feather.replace();
    
    // Sidebar toggle functionality
    document.getElementById('sidebarToggle')?.addEventListener('click', function(){
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
        const icon = this.querySelector('i');
        if (sidebar.classList.contains('collapsed')) {
            feather.icons['chevron-right'].replace(icon);
        } else {
            feather.icons['chevron-left'].replace(icon);
        }
    });

    // Mobile menu toggle
    document.getElementById('mobileMenuToggle')?.addEventListener('click', function(){
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('block');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const mobileToggle = document.getElementById('mobileMenuToggle');
        
        if (window.innerWidth < 1024 && 
            !sidebar.contains(event.target) && 
            !mobileToggle.contains(event.target)) {
            sidebar.classList.add('hidden');
            sidebar.classList.remove('block');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.querySelector('.sidebar');
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('hidden');
            sidebar.classList.add('block');
        }
    });

    // Initialize sidebar state based on screen size
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        if (window.innerWidth < 1024) {
            sidebar.classList.add('hidden');
            sidebar.classList.remove('block');
        }
    });
</script>
</body>
</html>


