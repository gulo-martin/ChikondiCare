<!DOCTYPE html>
<html lang="en" >
<head>
  

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('imagees/login-illustration.png') }}">
    <title>Admin - chikondiCare</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])

     <!-- <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">  -->

</head>
<body class="bg-[#f4f7f6] font-sans text-slate-900 antialiased">
<div class="min-h-screen">
    <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col border-r border-slate-200/80 bg-[#123f3d] px-4 py-5 lg:flex">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-2 py-1">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white ring-1 ring-white/15">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14" stroke-linecap="round"/></svg>
            </span>
            <div><p class="text-base font-bold leading-none text-white">ChikondiCare</p><p class="mt-1 text-[11px] font-medium text-teal-100/70">Administration</p></div>
        </a>

        @php
            $navItems = [
                ['Overview', 'admin.dashboard', 'M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z'],
                ['Staff accounts', 'admin.staff.index', 'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87'],
                ['Doctors', 'admin.doctors.index', 'M12 2a5 5 0 0 1 5 5c0 2-1 3-2 4v2l4 3v4H5v-4l4-3v-2a5 5 0 0 1-2-4 5 5 0 0 1 5-5Z'],
                ['Medicines', 'admin.medicines.index', 'M10.5 20.5a6 6 0 0 1-8.5-8.5l8-8a6 6 0 0 1 8.5 8.5l-8 8ZM8.5 14.5l5-5'],
                ['Consultation fees', 'admin.fees.index', 'M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6'],
                ['Audit logs', 'admin.audit.index', 'M14 2H6a2 2 0 0 0-2 2v16h16V8l-6-6ZM14 2v6h6M8 13h8M8 17h8'],
            ];
        @endphp

        <nav class="mt-8 space-y-1" aria-label="Administrator navigation">
            @foreach ($navItems as $item)
                @php $active = request()->routeIs($item[1]); @endphp
                <a href="{{ route($item[1]) }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ $active ? 'bg-white text-[#123f3d] shadow-sm' : 'text-teal-50/75 hover:bg-white/8 hover:text-white' }}">
                    <svg class="h-5 w-5 {{ $active ? 'text-[#147d7a]' : 'text-teal-100/60 group-hover:text-white' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="{{ $item[2] }}" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ $item[0] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-auto border-t border-white/10 pt-4">
            <div class="flex items-center gap-3 rounded-xl px-2 py-2">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-teal-400/20 text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <div class="min-w-0"><p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</p><p class="text-xs text-teal-100/60">Administrator</p></div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-2">@csrf<button type="submit" class="w-full rounded-xl border border-white/10 px-3 py-2.5 text-sm font-semibold text-teal-50/80 transition hover:border-white/20 hover:bg-white/8 hover:text-white">Sign out</button></form>
        </div>
    </aside>

    <div class="min-h-screen lg:ml-64">
        <!-- Topbar -->
        <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200/80 bg-white/90 px-5 backdrop-blur-xl lg:px-8">
            <div class="min-w-0">
                <p class="text-lg font-bold tracking-tight text-slate-900">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ auth()->user()->name }}</p>
                <p class="mt-0.5 text-sm text-slate-500">Here is what is happening at ChikondiCare today.</p>
            </div>
            <div class="ml-auto flex items-center gap-3">
                <button type="button" class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-teal-200 hover:text-[#147d7a]" aria-label="Notifications">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                </button>
                <div class="hidden h-9 w-px bg-slate-200 sm:block"></div>
                <span class="hidden items-center gap-3 sm:flex"><span class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-50 text-sm font-bold text-[#147d7a]">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span><span><span class="block text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</span><span class="block text-xs text-slate-400">Administrator</span></span></span>
            </div>
        </header>

        <main class="p-5 lg:p-8">
            @yield('content')
        </main>
    </div>
</div>



</body>
</html>