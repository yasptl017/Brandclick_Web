@extends('layouts.admin')

@section('title', 'WhatsApp settings')
@section('heading', 'WhatsApp settings')

@section('content')
    <div class="mb-8">
        <p class="text-sm font-semibold text-indigo-600">Public link destination</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">WhatsApp group URL</h1>
        <p class="mt-3 max-w-2xl text-slate-600">Visitors using <span class="font-medium text-slate-700">/go/whatsapp</span> will be redirected to this invite link.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">
            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            {{ session('status') }}
        </div>
    @endif

    <section class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
        <form method="POST" action="{{ route('admin.whatsapp-settings.update') }}" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-2">
                <label for="whatsapp_group_url" class="text-sm font-semibold text-slate-800">Group invite URL</label>
                <input id="whatsapp_group_url" name="whatsapp_group_url" type="url" value="{{ old('whatsapp_group_url', $whatsAppGroupUrl) }}" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-950 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15" placeholder="https://chat.whatsapp.com/..." aria-describedby="whatsapp_group_url_hint">
                <p id="whatsapp_group_url_hint" class="text-sm leading-6 text-slate-500">Use a <span class="font-medium">chat.whatsapp.com</span> group invite link.</p>
                @error('whatsapp_group_url')
                    <p class="text-sm font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-5">
                <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/30">Save changes</button>
                <a href="{{ route('go.whatsapp') }}" target="_blank" rel="noopener noreferrer" class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950">Test public link</a>
            </div>
        </form>
    </section>
@endsection
