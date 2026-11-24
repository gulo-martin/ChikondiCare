@props(['title', 'role', 'active' => 'Overview'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | ChikondiCare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f3f7f6] text-slate-900">
    <div class="flex min-h-screen">
        <aside class="fixed inset-y-0 left-0 z-30 hidden w-72 flex-col border-r border-slate-200 bg-white px-5 py-6 lg:flex">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-2">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#147d7a] text-white">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14" stroke-linecap="round"/></svg>
                </span>
                <span class="text-lg font-bold">Chikondi<span class="text-[#147d7a]">Care</span></span>
            </a>

            <nav class="mt-10 space-y-1" aria-label="Main navigation">
                @foreach ([['Overview','M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z'], ['Patients','M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87'], ['Appointments','M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Z'], ['Reports','M4 19V9M10 19V5M16 19v-7M22 19H2']] as $item)
                    <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold {{ $active === $item[0] ? 'bg-teal-50 text-[#147d7a]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="{{ $item[1] }}" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ $item[0] }}
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto rounded-2xl border border-slate-100 bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Signed in as</p>
                <p class="mt-1 truncate text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                <p class="mt-0.5 text-xs capitalize text-slate-500">{{ str_replace('_', ' ', $role) }}</p>
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:text-red-600">Sign out</button>
                </form>
            </div>
        </aside>

        <main class="w-full lg:ml-72">
            <header class="sticky top-0 z-20 flex h-20 items-center justify-between border-b border-slate-200 bg-white/90 px-5 backdrop-blur lg:px-8">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">{{ $role }}</p>
                    <h1 class="mt-1 text-xl font-bold text-slate-900">{{ $title }}</h1>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500" aria-label="Notifications">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-100 text-sm font-bold text-[#147d7a]">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
            </header>

            <div class="p-5 lg:p-8">{{ $slot }}</div>
        </main>
    </div>
</body>
</html>
