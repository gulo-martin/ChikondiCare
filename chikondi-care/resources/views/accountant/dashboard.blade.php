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
            Accountant!. You have successfully logged in.
        </p>

        <x-dashboard title="Payments" role="Accountant">
            <section class="grid gap-4 sm:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Today's collections</p>
                    <p class="mt-3 text-3xl font-bold">MWK 184,500</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Transactions</p>
                    <p class="mt-3 text-3xl font-bold text-[#147d7a]">42</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Outstanding</p>
                    <p class="mt-3 text-3xl font-bold text-amber-600">MWK 12,000</p>
                </article>
            </section>
            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-lg font-bold">Recent payments</h2>
                    <button class="rounded-lg bg-[#147d7a] px-4 py-2.5 text-sm font-semibold text-white">
                        Record payment
                    </button>
                </div>
                <div class="mt-5 overflow-x-auto">
                    <table class="w-full min-w-[620px] text-left text-sm">
                        <thead class="border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400">
                            <tr>
                                <th class="py-3">Receipt</th>
                                <th>Patient</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ([['RC-1042','Jane Mbewe','Cash','MWK 8,500','Paid'],['RC-1041','Peter Nkhoma','Mobile money','MWK 12,000','Paid'],['RC-1040','Anna Moyo','Card','MWK 15,500','Paid']] as $payment)
                            <tr>
                                <td class="py-4 font-semibold">{{ $payment[0] }}</td>
                                <td>{{ $payment[1] }}</td>
                                <td class="text-slate-500">{{ $payment[2] }}</td>
                                <td class="font-semibold">{{ $payment[3] }}</td>
                                <td>
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">{{ $payment[4] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
