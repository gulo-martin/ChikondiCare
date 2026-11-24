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
            administrator!. You have successfully logged in.
        </p>

        <form action="{{ route('logout') }}" method="POST" class="mt-7">
            @csrf
            <button class="bg-[#209F9B] hover:bg-[#176F6C] text-white px-8 py-3 rounded-xl">
                Logout
            </button>
        </form>
    </div>

    <x-dashboard title="Administration" role="Administrator">
        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([['Staff accounts','48','+4 this month','bg-blue-50 text-blue-700'],['Registered doctors','12','3 visiting','bg-violet-50 text-violet-700'],['Active patients','2,148','+18 today','bg-teal-50 text-[#147d7a]'],['System alerts','3','Needs review','bg-amber-50 text-amber-700']] as $stat)
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm font-semibold text-slate-500">{{ $stat[0] }}</p><p class="mt-3 text-3xl font-bold text-slate-900">{{ $stat[1] }}</p><p class="mt-2 text-xs font-semibold {{ $stat[3] }} inline-block rounded-full px-2.5 py-1">{{ $stat[2] }}</p></article>
            @endforeach
        </section>
        <section class="mt-6 grid gap-6 xl:grid-cols-[1fr_320px]">
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"><div class="flex items-center justify-between"><div><p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Operations</p><h2 class="mt-1 text-lg font-bold">Recent activity</h2></div><button class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-600">View audit log</button></div><div class="mt-5 divide-y divide-slate-100">@foreach ([['New patient record created','Reception desk','10 minutes ago'],['Doctor schedule updated','Dr. Banda','28 minutes ago'],['Consultation fee changed','Finance','1 hour ago']] as $activity)<div class="flex items-center justify-between gap-4 py-4"><div><p class="text-sm font-semibold text-slate-800">{{ $activity[0] }}</p><p class="mt-1 text-xs text-slate-500">{{ $activity[1] }}</p></div><span class="text-xs text-slate-400">{{ $activity[2] }}</span></div>@endforeach</div></article>
            <article class="rounded-2xl bg-[#147d7a] p-6 text-white shadow-lg shadow-teal-900/10"><p class="text-sm text-teal-100">System status</p><p class="mt-3 text-3xl font-bold">Operational</p><p class="mt-3 text-sm leading-6 text-teal-100">All core hospital workflows are available.</p><button class="mt-6 w-full rounded-xl bg-white px-4 py-3 text-sm font-bold text-[#147d7a]">Manage system</button></article>
        </section>
    </x-dashboard>

</body>
</html>
