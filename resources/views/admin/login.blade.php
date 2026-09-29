<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin sign in · Brandclick</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 font-sans text-slate-900 antialiased">
        <main class="grid min-h-screen place-items-center p-4 sm:p-6">
            <section class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl shadow-black/30 sm:p-8">
                <div class="mb-8 flex items-center gap-3">
                    <span class="grid size-10 place-items-center rounded-xl bg-indigo-500 text-lg font-black text-white">B</span>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-slate-950">Brandclick Admin</h1>
                        <p class="text-sm text-slate-500">Sign in to manage your site.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}" class="flex flex-col gap-5">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label for="username" class="text-sm font-medium text-slate-700">Admin ID</label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required autofocus class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15" placeholder="admin">
                        @error('username')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-sm font-medium text-slate-700">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15">
                        @error('password')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" value="1" class="size-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        Keep me signed in
                    </label>

                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/30">Sign in</button>
                </form>
            </section>
        </main>
    </body>
</html>
