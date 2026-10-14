<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($header) ? trim(strip_tags((string) $header)) . ' — ' : '' }}{{ config('app.name', 'Pemesanan Tiket') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen">

            <!-- Overlay (mobile) -->
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
                 class="fixed inset-0 z-30 bg-gray-900/50 lg:hidden" style="display: none;"></div>

            <!-- Sidebar -->
            <aside x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-gray-900 text-gray-100 transition-transform duration-200 ease-in-out lg:translate-x-0">

                <div class="flex h-16 shrink-0 items-center gap-3 border-b border-gray-800 px-5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-sm font-bold text-white">
                        PT
                    </div>
                    <div>
                        <p class="text-sm font-bold leading-tight">Pemesanan Tiket</p>
                        <p class="text-[11px] text-gray-400">Panel Admin</p>
                    </div>
                </div>

                <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Pesanan
                    </a>

                    <a href="{{ route('events.index') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('events.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Event
                    </a>

                    <a href="{{ route('home') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9a9 9 0 009-9M3 12a9 9 0 019-9m0 0a9 9 0 019 9" />
                        </svg>
                        Lihat Situs
                    </a>
                </nav>

                <div class="shrink-0 space-y-1 border-t border-gray-800 p-3">
                    <div class="px-3 py-2">
                        <p class="truncate text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="truncate text-[11px] text-gray-400">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 transition hover:bg-gray-800 hover:text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Content -->
            <div class="lg:pl-64">
                <header class="sticky top-0 z-20 flex h-16 items-center gap-4 border-b border-gray-200 bg-white px-4 sm:px-6 lg:px-8">
                    <button @click="sidebarOpen = true" type="button"
                            class="rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 lg:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <h1 class="text-lg font-semibold text-gray-800">
                        {{ $header ?? '' }}
                    </h1>
                </header>

                <main class="p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
