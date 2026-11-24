<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChikondiCare | Hospital Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#edf7f6] text-slate-900">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute -left-24 top-20 h-72 w-72 rounded-full bg-teal-200/40 blur-3xl"></div>
        <div class="absolute -right-24 bottom-10 h-80 w-80 rounded-full bg-cyan-200/40 blur-3xl"></div>

        <header class="relative z-10 mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="ChikondiCare home">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#147d7a] text-white shadow-lg shadow-teal-900/10">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 5v14M5 12h14" stroke-linecap="round"/>
                        <path d="M19 8.5A7.5 7.5 0 1 1 16.5 5" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="text-xl font-bold tracking-tight text-slate-900">Chikondi<span class="text-[#147d7a]">Care</span></span>
            </a>

            @auth
                <a href="{{ url('/login') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-teal-300 hover:text-[#147d7a]">Open dashboard</a>
            @else
                <a href="{{ route('login') }}" class="rounded-xl bg-[#147d7a] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-900/15 transition hover:bg-[#106a67]">Staff login</a>
            @endauth
        </header>

        <main class="relative z-10 mx-auto grid max-w-7xl items-center gap-12 px-6 pb-16 pt-10 lg:min-h-[calc(100vh-110px)] lg:grid-cols-[1.05fr_.95fr] lg:px-10 lg:pb-20 lg:pt-4">
            <section class="max-w-2xl">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-teal-200 bg-white/80 px-4 py-2 text-sm font-semibold text-[#147d7a] shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Hospital operations, connected
                </div>

                <h1 class="text-4xl font-bold leading-[1.08] tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    Better care starts with <span class="text-[#147d7a]">better information.</span>
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                    ChikondiCare helps hospital teams register patients, coordinate appointments, complete consultations, and manage payments from one secure workspace.
                </p>

                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a href="{{ url('/login') }}" class="rounded-xl bg-[#147d7a] px-6 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-teal-900/15 transition hover:bg-[#106a67]">Go to dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl bg-[#147d7a] px-6 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-teal-900/15 transition hover:bg-[#106a67]">Login to ChikondiCare</a>
                    @endauth
                    <a href="#workflows" class="rounded-xl border border-slate-200 bg-white px-6 py-4 text-center text-sm font-semibold text-slate-700 shadow-sm transition hover:border-teal-300">Explore workflows</a>
                </div>

                <div id="workflows" class="mt-12 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/80 bg-white/70 p-4 shadow-sm">
                        <p class="text-2xl font-bold text-slate-900">Patients</p>
                        <p class="mt-1 text-sm text-slate-500">Secure registration records</p>
                    </div>
                    <div class="rounded-2xl border border-white/80 bg-white/70 p-4 shadow-sm">
                        <p class="text-2xl font-bold text-slate-900">Appointments</p>
                        <p class="mt-1 text-sm text-slate-500">Fast booking and check-in</p>
                    </div>
                    <div class="rounded-2xl border border-white/80 bg-white/70 p-4 shadow-sm">
                        <p class="text-2xl font-bold text-slate-900">Reports</p>
                        <p class="mt-1 text-sm text-slate-500">Clear operational insight</p>
                    </div>
                </div>
            </section>

            <section class="relative hidden lg:block" aria-label="ChikondiCare hospital workflow preview">
                <div class="absolute left-8 top-10 h-full w-[85%] rounded-[2.5rem] bg-[#147d7a]/10"></div>
                <div class="relative ml-auto max-w-lg rounded-[2rem] border border-white/80 bg-white p-5 shadow-[0_30px_80px_rgba(15,118,110,.16)]">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Today</p>
                            <p class="mt-1 font-bold text-slate-900">Care overview</p>
                        </div>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-50 text-[#147d7a]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 3v3M16 3v3M4 9h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z"/></svg>
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 py-5">
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-3xl font-bold text-slate-900">24</p><p class="mt-1 text-sm text-slate-500">Appointments</p></div>
                        <div class="rounded-2xl bg-teal-50 p-4"><p class="text-3xl font-bold text-[#147d7a]">8</p><p class="mt-1 text-sm text-slate-500">Waiting</p></div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-3 rounded-xl border border-slate-100 p-3"><span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">JM</span><div class="flex-1"><p class="text-sm font-semibold text-slate-900">Jane Mbewe</p><p class="text-xs text-slate-500">09:30 • Dr. Banda</p></div><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Checked in</span></div>
                        <div class="flex items-center gap-3 rounded-xl border border-slate-100 p-3"><span class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 font-bold text-violet-700">PN</span><div class="flex-1"><p class="text-sm font-semibold text-slate-900">Peter Nkhoma</p><p class="text-xs text-slate-500">10:15 • Dr. Phiri</p></div><span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Scheduled</span></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
