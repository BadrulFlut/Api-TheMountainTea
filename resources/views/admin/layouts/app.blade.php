<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js for interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        .content-transition {
            transition: margin-left 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar-transition fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transform" 
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-6 bg-gray-800">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-300 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.users') }}" 
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.users*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-users w-5 mr-3"></i>
                        Users
                    </a>
                    
                    <a href="{{ route('admin.products') }}" 
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.products*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-box w-5 mr-3"></i>
                        Products
                    </a>
                    
                    <a href="{{ route('admin.shipments') }}" 
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.shipments*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-shipping-fast w-5 mr-3"></i>
                        Shipments
                    </a>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="content-transition flex-1 flex flex-col" :class="sidebarOpen ? 'lg:ml-64' : 'ml-0'">
            
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between h-16 px-6">
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff" alt="Admin">
                                <span class="ml-2 hidden md:block">Administrator</span>
                                <i class="fas fa-chevron-down ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @stack('scripts')
</body>
</html>