@extends('layouts.admin')

@section('title', 'Account settings')
@section('heading', 'Account settings')

@section('content')
    <div class="mb-8">
        <p class="text-sm font-semibold text-indigo-600">Administrator access</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Account settings</h1>
        <p class="mt-3 max-w-2xl text-slate-600">Update the Admin ID used to sign in or choose a new password for this account.</p>
    </div>

    <div class="grid max-w-4xl gap-6 lg:grid-cols-2">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-950">Change Admin ID</h2>
                <p class="mt-1 text-sm leading-6 text-slate-500">Your Admin ID must be unique and is used at the sign-in page.</p>
            </div>

            @if (session('username_status'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">{{ session('username_status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.account.username.update') }}" class="flex flex-col gap-5">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-2">
                    <label for="username" class="text-sm font-semibold text-slate-800">Admin ID</label>
                    <input id="username" name="username" type="text" value="{{ old('username', auth()->user()->name) }}" autocomplete="username" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15">
                    @error('username')
                        <p class="text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="username_current_password" class="text-sm font-semibold text-slate-800">Current password</label>
                    <input id="username_current_password" name="current_password" type="password" autocomplete="current-password" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15">
                    @error('current_password')
                        <p class="text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="self-start rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/30">Save Admin ID</button>
            </form>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-950">Change password</h2>
                <p class="mt-1 text-sm leading-6 text-slate-500">Use at least 8 characters and keep your new password private.</p>
            </div>

            @if (session('password_status'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">{{ session('password_status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.account.password.update') }}" class="flex flex-col gap-5">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-2">
                    <label for="password_current_password" class="text-sm font-semibold text-slate-800">Current password</label>
                    <input id="password_current_password" name="current_password" type="password" autocomplete="current-password" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15">
                    @error('current_password')
                        <p class="text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password" class="text-sm font-semibold text-slate-800">New password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15">
                    @error('password')
                        <p class="text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="text-sm font-semibold text-slate-800">Confirm new password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15">
                </div>

                <button type="submit" class="self-start rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/30">Save password</button>
            </form>
        </section>
    </div>
@endsection
