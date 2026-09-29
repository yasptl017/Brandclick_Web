<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin') · Brandclick</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100 font-sans text-slate-900 antialiased">
        <div data-admin-shell class="min-h-screen lg:grid lg:grid-cols-[16rem_minmax(0,1fr)] lg:transition-[grid-template-columns] lg:duration-300">
            <div data-mobile-backdrop class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden"></div>

            <aside id="admin-sidebar" data-sidebar class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col overflow-hidden bg-slate-950 text-slate-300 shadow-2xl transition-transform duration-300 lg:static lg:w-full lg:translate-x-0 lg:shadow-none">
                <div class="flex h-16 shrink-0 items-center gap-3 border-b border-white/10 px-5" data-brand>
                    <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-indigo-500 text-sm font-black text-white">B</span>
                    <span data-sidebar-label class="whitespace-nowrap text-lg font-semibold tracking-tight text-white">Brandclick</span>
                </div>

                <nav class="flex flex-1 flex-col gap-2 p-3" aria-label="Admin navigation">
                    <a href="{{ route('admin.dashboard') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500 text-white shadow-lg shadow-indigo-950/30' : 'hover:bg-white/10 hover:text-white' }}">
                        <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9v8a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-8z" /></svg>
                        <span data-sidebar-label class="whitespace-nowrap">Overview</span>
                    </a>

                    <a href="{{ route('admin.whatsapp-settings.edit') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition {{ request()->routeIs('admin.whatsapp-settings.*') ? 'bg-indigo-500 text-white shadow-lg shadow-indigo-950/30' : 'hover:bg-white/10 hover:text-white' }}">
                        <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20.5 11.5a8.38 8.38 0 01-1.2 4.3L21 21l-5.3-1.7a8.5 8.5 0 114.8-7.8z" /><path stroke-linecap="round" d="M8.6 8.2c.2-.4.5-.4.7-.4h.4c.2 0 .4.1.5.4l.7 1.6c.1.2.1.4 0 .6l-.5.6c.4.8 1 1.4 1.8 1.8l.6-.5c.2-.1.4-.1.6 0l1.6.7c.3.1.4.3.4.5v.4c0 .2 0 .5-.4.7-.5.2-1 .3-1.5.2-2.7-.7-4.8-2.8-5.5-5.5-.1-.5 0-1 .2-1.5z" /></svg>
                        <span data-sidebar-label class="whitespace-nowrap">WhatsApp settings</span>
                    </a>
                </nav>

                <div class="border-t border-white/10 p-3">
                    <a href="{{ route('go.whatsapp') }}" target="_blank" rel="noopener noreferrer" data-nav-link class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition hover:bg-white/10 hover:text-white">
                        <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3h7v7m0-7L10 14" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 14v5a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h5" /></svg>
                        <span data-sidebar-label class="whitespace-nowrap">Open WhatsApp</span>
                    </a>
                </div>
            </aside>

            <div class="min-w-0">
                <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button type="button" data-mobile-toggle class="grid size-10 place-items-center rounded-lg text-slate-600 hover:bg-slate-100 lg:hidden" aria-label="Open navigation" aria-controls="admin-sidebar">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        </button>
                        <button type="button" data-desktop-toggle class="hidden size-10 place-items-center rounded-lg text-slate-600 hover:bg-slate-100 lg:grid" aria-label="Collapse navigation">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        </button>
                        <p class="text-sm font-semibold text-slate-700">@yield('heading', 'Admin panel')</p>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4">
                        <span class="hidden text-sm text-slate-500 sm:block">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-950">Sign out</button>
                        </form>
                    </div>
                </header>

                <main class="mx-auto w-full max-w-6xl p-4 sm:p-6 lg:p-8">
                    @yield('content')
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const shell = document.querySelector('[data-admin-shell]');
                const sidebar = document.querySelector('[data-sidebar]');
                const backdrop = document.querySelector('[data-mobile-backdrop]');
                const desktopToggle = document.querySelector('[data-desktop-toggle]');
                const mobileToggle = document.querySelector('[data-mobile-toggle]');

                const setCollapsed = (collapsed) => {
                    shell.classList.toggle('lg:grid-cols-[5rem_minmax(0,1fr)]', collapsed);
                    shell.classList.toggle('lg:grid-cols-[16rem_minmax(0,1fr)]', !collapsed);

                    document.querySelectorAll('[data-sidebar-label]').forEach((element) => {
                        element.classList.toggle('lg:hidden', collapsed);
                    });

                    document.querySelectorAll('[data-nav-link]').forEach((element) => {
                        element.classList.toggle('lg:justify-center', collapsed);
                    });

                    desktopToggle.setAttribute('aria-label', collapsed ? 'Expand navigation' : 'Collapse navigation');
                };

                let isCollapsed = localStorage.getItem('brandclick-admin-sidebar-collapsed') === 'true';
                setCollapsed(isCollapsed);

                desktopToggle.addEventListener('click', () => {
                    isCollapsed = !isCollapsed;
                    localStorage.setItem('brandclick-admin-sidebar-collapsed', isCollapsed);
                    setCollapsed(isCollapsed);
                });

                const closeMobileNavigation = () => {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                };

                mobileToggle.addEventListener('click', () => {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                });

                backdrop.addEventListener('click', closeMobileNavigation);
            });
        </script>
    </body>
</html>
