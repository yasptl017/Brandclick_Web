@extends('layouts.admin')

@section('title', 'Overview')
@section('heading', 'Overview')

@section('content')
    <div class="mb-8">
        <p class="text-sm font-semibold text-indigo-600">Brandclick administration</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Welcome back, {{ auth()->user()->name }}.</h1>
        <p class="mt-3 max-w-2xl text-slate-600">Manage the public WhatsApp invite from one place. Changes are reflected instantly at your short link.</p>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <a href="{{ route('admin.whatsapp-settings.edit') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-950/5">
            <div class="flex items-start justify-between gap-4">
                <span class="grid size-11 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20.5 11.5a8.38 8.38 0 01-1.2 4.3L21 21l-5.3-1.7a8.5 8.5 0 114.8-7.8z" /></svg>
                </span>
                <svg class="size-5 text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
            </div>
            <h2 class="mt-6 text-lg font-semibold text-slate-950">WhatsApp group</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600">Set the destination for the public <span class="font-medium text-slate-700">/go/whatsapp</span> link.</p>
        </a>
    </div>
@endsection
