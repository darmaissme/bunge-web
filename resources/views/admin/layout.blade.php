<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50 text-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Overview') - Bunge FlexiBetter Admin</title>

    <!-- Favicons & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('android-chrome-512x512.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Inter (Extracted from Public Site) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        bunge: {
                            navy: {
                                950: '#030B18',
                                900: '#0A192F',
                                800: '#002D6E',
                                700: '#0E529B',
                                600: '#1D3557',
                            },
                            blue: {
                                500: '#002D6E',
                                600: '#0E529B',
                                700: '#053C78',
                            }
                        }
                    },
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        sans: ['"Inter"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="h-full font-sans antialiased bg-[#F8FAFC] text-slate-900 flex flex-col md:flex-row min-h-screen">

    <!-- Mobile Menu Toggle Script -->
    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('admin-sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>

    <!-- Mobile Header -->
    <header class="md:hidden h-16 bg-white border-b border-slate-200 px-4 flex items-center justify-between z-40 sticky top-0 shadow-sm">
        <div class="flex items-center gap-3">
            <button onclick="toggleMobileMenu()" class="p-2 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            
            <!-- White Logo Card Container for Mobile -->
            <div class="bg-white rounded-xl p-1.5 shadow-sm border border-slate-200 flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Bunge Logo" class="h-6 w-auto object-contain">
            </div>
            <span class="font-display font-extrabold text-sm text-[#002D6E] tracking-tight">FlexiBetter</span>
        </div>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold">Live</span>
    </header>

    <!-- Sidebar Navigation (Branded Navy Anchor) -->
    <aside id="admin-sidebar" class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-[#002D6E] border-r border-[#0E529B]/40 flex flex-col shrink-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl">
        
        <!-- Sidebar Brand Header with White Logo Container Card -->
        <div class="h-24 px-6 border-b border-white/10 flex items-center justify-between bg-[#002458]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <!-- White Container Card for Bunge Logo -->
                <div class="bg-white rounded-xl px-3 py-2 shadow-md flex items-center justify-center transition-transform group-hover:scale-105 border border-slate-100">
                    <img src="{{ asset('images/logo.png') }}" alt="Bunge Logo" class="h-7 w-auto object-contain">
                </div>
                
                <div class="flex flex-col">
                    <span class="font-display font-extrabold text-base text-white tracking-tight leading-tight">FlexiBetter</span>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-blue-200">Admin System</span>
                </div>
            </a>
            <button onclick="toggleMobileMenu()" class="md:hidden text-slate-300 hover:text-white">&times;</button>
        </div>

        <!-- Navigation Menu Links -->
        <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
            
            <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-blue-200/80">Main Navigation</div>

            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#002D6E] font-extrabold shadow-lg shadow-black/10' : 'text-slate-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-[#002D6E]' : 'text-blue-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                <span>Dashboard</span>
            </a>

            <!-- Bookings Link -->
            <a href="{{ route('admin.bookings.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-white text-[#002D6E] font-extrabold shadow-lg shadow-black/10' : 'text-slate-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.bookings.*') ? 'text-[#002D6E]' : 'text-blue-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Bookings / Consultations</span>
            </a>

            <!-- Availability Control Link -->
            <a href="{{ route('admin.availability.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('admin.availability.*') ? 'bg-white text-[#002D6E] font-extrabold shadow-lg shadow-black/10' : 'text-slate-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.availability.*') ? 'text-[#002D6E]' : 'text-blue-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Slot Availability</span>
            </a>

            <!-- Website Link Section -->
            <div class="pt-6 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-blue-200/80">Public Website</div>

            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center justify-between px-4 py-3 rounded-xl font-medium text-sm text-slate-200 hover:text-white hover:bg-white/10 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Public Site</span>
                </div>
                <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </nav>

        <!-- Authenticated Admin Profile Footer -->
        <div class="p-4 border-t border-white/10 bg-[#001D47]">
            <div class="flex items-center gap-3 mb-3 px-2">
                <div class="w-9 h-9 rounded-full bg-white text-[#002D6E] font-black text-sm flex items-center justify-center shrink-0 shadow-sm border border-slate-100">
                    {{ strtoupper(substr(Auth::user()->name ?? 'B', 0, 1)) }}
                </div>
                <div class="truncate">
                    <p class="text-xs font-extrabold text-white truncate">{{ Auth::user()->name ?? 'Bunge Admin' }}</p>
                    <p class="text-[11px] text-blue-200 truncate">{{ Auth::user()->email ?? 'admin@bunge.com' }}</p>
                </div>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-white/10 hover:bg-rose-500/30 text-white font-semibold text-xs transition border border-white/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area (Clean White / Light Surface) -->
    <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
        
        <!-- Desktop Top Bar Header (Light White Surface) -->
        <header class="hidden md:flex h-20 bg-white border-b border-slate-200 px-8 items-center justify-between shrink-0 shadow-xs">
            <div>
                <h1 class="font-display text-xl font-extrabold text-[#002D6E] tracking-tight">@yield('title', 'Dashboard Overview')</h1>
                <p class="text-xs font-medium text-slate-500 mt-0.5">Bunge FlexiBetter — Internal Booking Management System</p>
            </div>

            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live System Active
                </span>
            </div>
        </header>

        <!-- Main View Output -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            
            <!-- Toast Notifications -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 text-lg leading-none">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm font-semibold">{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 text-lg leading-none">&times;</button>
                </div>
            @endif

            @yield('content')
        </main>

    </div>

</body>
</html>
