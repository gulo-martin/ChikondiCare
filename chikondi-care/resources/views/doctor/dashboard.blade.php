<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ChikondiCare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#DDF4F2] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-3xl shadow-lg p-10 max-w-xl w-full text-center">
        

        <h1 class="text-2xl font-bold text-slate-800">
            Welcome to ChikondiCare
        </h1>

        <p class="text-slate-500 mt-2">
            Doctor!. You have successfully logged in.
        </p>

        <form action="{{ route('logout') }}" method="POST" class="mt-7">
            @csrf
            <button class="bg-[#209F9B] hover:bg-[#176F6C] text-white px-8 py-3 rounded-xl">
                Logout
            </button>
        </form>
    </div>

    <x-dashboard title="Doctor workspace" role="Doctor">
        <section class="grid gap-4 sm:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">My appointments</p>
                <p class="mt-3 text-3xl font-bold">10</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Waiting now</p>
                <p class="mt-3 text-3xl font-bold text-[#147d7a]">4</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Completed today</p>
                <p class="mt-3 text-3xl font-bold text-blue-700">6</p>
            </article>
        </section>
        <section class="mt-6 grid gap-6 xl:grid-cols-[1fr_320px]">
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-bold">Checked-in patients</h2>
                <div class="mt-5 divide-y divide-slate-100">
                    @foreach ([['JM','Jane Mbewe','09:30','Routine consultation'],['PN','Peter Nkhoma','10:15','Follow-up'],['AM','Anna Moyo','11:00','General review']] as $row)
                    <div class="flex items-center gap-3 py-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-full bg-teal-50 text-sm font-bold text-[#147d7a]">{{ $row[0] }}</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold">{{ $row[1] }}</p>
                            <p class="mt-1 text-xs text-slate-500">{{ $row[2] }} • {{ $row[3] }}</p>
                        </div>
                        <button class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-600">Open record</button>
                    </div>
                    @endforeach
                </div>
            </article>
            <article class="rounded-2xl bg-slate-900 p-6 text-white">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Next appointment</p>
                <p class="mt-4 text-xl font-bold">Jane Mbewe</p>
                <p class="mt-1 text-sm text-slate-300">09:30 • Consultation room 2</p>
                <button class="mt-6 w-full rounded-xl bg-white px-4 py-3 text-sm font-bold text-slate-900">Start consultation</button>
            </article>
        </section>
    </x-dashboard>

</body>
</html>
