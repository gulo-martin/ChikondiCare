<x-dashboard title="Front desk & patients" role="Health care attendant">
    <section class="grid gap-4 sm:grid-cols-3">
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Appointments today</p><p class="mt-3 text-3xl font-bold">24</p></article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Checked in</p><p class="mt-3 text-3xl font-bold text-[#147d7a]">8</p></article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">New registrations</p><p class="mt-3 text-3xl font-bold text-blue-700">5</p></article>
    </section>

    <section class="mt-6 grid gap-6 xl:grid-cols-[1fr_340px]">
        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between"><h2 class="text-lg font-bold">Arrival queue</h2><button class="rounded-lg bg-[#147d7a] px-4 py-2.5 text-sm font-semibold text-white">Register patient</button></div>
            <div class="mt-5 divide-y divide-slate-100">
                @foreach ([['JM','Jane Mbewe','CHC-000184','09:30','Ready'],['PN','Peter Nkhoma','CHC-000231','10:15','Waiting'],['AM','Anna Moyo','CHC-000316','11:00','Waiting']] as $row)
                    <div class="flex items-center gap-3 py-4"><span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-600">{{ $row[0] }}</span><div class="flex-1"><p class="text-sm font-semibold">{{ $row[1] }}</p><p class="mt-1 text-xs text-slate-500">{{ $row[2] }} • {{ $row[3] }}</p></div><button class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-600">Check in</button></div>
                @endforeach
            </div>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"><h2 class="text-lg font-bold">Find a patient</h2><label for="patient-id" class="mt-5 block text-sm font-semibold text-slate-600">Patient number</label><input id="patient-id" type="text" placeholder="CHC-000000" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"><button class="mt-3 w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white">Verify appointment</button></article>
    </section>
</x-dashboard>
