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
            Receptionist!. You have successfully logged in.
        </p>

        <x-dashboard title="Reception" role="Receptionist">
            <section class="grid gap-4 sm:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Today's appointments</p>
                    <p class="mt-3 text-3xl font-bold">24</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Checked in</p>
                    <p class="mt-3 text-3xl font-bold text-[#147d7a]">8</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Available slots</p>
                    <p class="mt-3 text-3xl font-bold text-blue-700">16</p>
                </article>
            </section>
            <section class="mt-6 grid gap-6 xl:grid-cols-[1fr_320px]">
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Today's appointments</h2>
                        <button class="rounded-lg bg-[#147d7a] px-4 py-2.5 text-sm font-semibold text-white">
                            Book appointment
                        </button>
                    </div>
                    <div class="mt-5 divide-y divide-slate-100">
                        @foreach ([['JM','Jane Mbewe','09:30','Dr. Banda','Checked in'],['PN','Peter Nkhoma','10:15','Dr. Phiri','Scheduled'],['AM','Anna Moyo','11:00','Dr. Banda','Scheduled']] as $row)
                        <div class="flex items-center gap-3 py-4">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-600">{{ $row[0] }}</span>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">{{ $row[1] }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $row[2] }} • {{ $row[3] }}</p>
                            </div>
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $row[4] === 'Checked in' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $row[4] }}</span>
                        </div>
                        @endforeach
                    </div>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">Quick patient search</h2>
                    <label class="mt-5 block text-sm font-semibold text-slate-600" for="patient-search">Patient number or name</label>
                    <input id="patient-search" type="search" placeholder="e.g. CHC-000184" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    <button class="mt-3 w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white">
                        Search patient
                    </button>
                </article>
            </section>
        </x-dashboard>

        <form action="{{ route('logout') }}" method="POST" class="mt-7">
            @csrf
            <button class="bg-[#209F9B] hover:bg-[#176F6C] text-white px-8 py-3 rounded-xl">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
