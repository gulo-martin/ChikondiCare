@extends('admin.layouts.admin')

@section('content')
    @if (session('success'))
        <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
    @endif

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <article class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,.04)]"><div class="flex items-start justify-between"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87" stroke-linecap="round"/></svg></span><span class="rounded-full bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">Active</span></div><p class="mt-5 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['staff'] }}</p><p class="mt-1 text-sm font-medium text-slate-500">Staff accounts</p></article>
        <article class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,.04)]"><div class="flex items-start justify-between"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2a5 5 0 0 1 5 5c0 2-1 3-2 4v2l4 3v4H5v-4l4-3v-2a5 5 0 0 1-2-4 5 5 0 0 1 5-5Z"/></svg></span><span class="rounded-full bg-violet-50 px-2 py-1 text-xs font-bold text-violet-700">Care</span></div><p class="mt-5 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['doctors'] }}</p><p class="mt-1 text-sm font-medium text-slate-500">Active doctors</p></article>
        <article class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,.04)]"><div class="flex items-start justify-between"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-teal-50 text-[#147d7a]"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10.5 20.5a6 6 0 0 1-8.5-8.5l8-8a6 6 0 0 1 8.5 8.5l-8 8ZM8.5 14.5l5-5"/></svg></span><span class="rounded-full bg-teal-50 px-2 py-1 text-xs font-bold text-[#147d7a]">Catalogue</span></div><p class="mt-5 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['medicines'] }}</p><p class="mt-1 text-sm font-medium text-slate-500">Available medicines</p></article>
        <article class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,.04)]"><div class="flex items-start justify-between"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 9v4M12 17h.01M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/></svg></span><span class="rounded-full bg-amber-50 px-2 py-1 text-xs font-bold text-amber-700">Review</span></div><p class="mt-5 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['inactive_staff'] }}</p><p class="mt-1 text-sm font-medium text-slate-500">Inactive staff</p></article>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[minmax(0,1fr)_340px]">
        <section class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-[0_8px_30px_rgba(15,23,42,.04)]">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4"><div><h2 class="font-bold text-slate-900">Recent system activity</h2><p class="mt-1 text-xs text-slate-500">Latest administrative actions</p></div><a href="{{ route('admin.audit.index') }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-600 transition hover:border-teal-200 hover:text-[#147d7a]">View all</a></div>
            <div class="divide-y divide-slate-100 px-5">
                @forelse ($recentLogs as $log)
                    <div class="flex items-center gap-3 py-4"><span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-teal-50 text-xs font-bold text-[#147d7a]">{{ strtoupper(substr($log->user?->name ?? 'S', 0, 1)) }}</span><div class="min-w-0 flex-1"><p class="truncate text-sm font-semibold text-slate-800">{{ $log->description ?? $log->action }}</p><p class="mt-1 text-xs text-slate-400">{{ $log->user?->name ?? 'System' }} · {{ $log->created_at->diffForHumans() }}</p></div><span class="hidden rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-slate-500 sm:block">{{ str_replace('_', ' ', $log->action) }}</span></div>
                @empty
                    <div class="py-12 text-center"><p class="text-sm font-semibold text-slate-700">No activity recorded yet</p><p class="mt-1 text-xs text-slate-400">Administrative actions will appear here.</p></div>
                @endforelse
            </div>
        </section>

        <section class="rounded-2xl bg-[#123f3d] p-6 text-white shadow-[0_16px_40px_rgba(18,63,61,.18)]">
            <p class="text-xs font-bold uppercase tracking-[.16em] text-teal-200/70">Quick actions</p><h2 class="mt-2 text-xl font-bold">Administration tools</h2>
            <div class="mt-5 space-y-3">
                <a href="{{ route('admin.staff.index') }}" class="flex items-center justify-between rounded-xl bg-white/8 px-4 py-3 text-sm font-semibold transition hover:bg-white/12"><span>Create or manage staff</span><span>→</span></a>
                <a href="{{ route('admin.doctors.index') }}" class="flex items-center justify-between rounded-xl bg-white/8 px-4 py-3 text-sm font-semibold transition hover:bg-white/12"><span>Manage doctor profiles</span><span>→</span></a>
                <a href="{{ route('admin.medicines.index') }}" class="flex items-center justify-between rounded-xl bg-white/8 px-4 py-3 text-sm font-semibold transition hover:bg-white/12"><span>Update medicine catalogue</span><span>→</span></a>
                <a href="{{ route('admin.fees.index') }}" class="flex items-center justify-between rounded-xl bg-white/8 px-4 py-3 text-sm font-semibold transition hover:bg-white/12"><span>Configure fees</span><span>→</span></a>
            </div>
            <div class="mt-6 border-t border-white/10 pt-5"><div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span><p class="text-sm font-semibold">All systems operational</p></div></div>
        </section>
    </div>
@endsection