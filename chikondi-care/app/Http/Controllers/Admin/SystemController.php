<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ConsultationFee;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'staff' => User::count(),
            'doctors' => Doctor::where('is_active', true)->count(),
            'medicines' => Medicine::where('is_active', true)->count(),
            'inactive_staff' => User::where('is_active', false)->count(),
        ];
        $recentLogs = AuditLog::with('user')->latest()->take(8)->get();

        return view('admin.dashboard.dashboard', compact('stats', 'recentLogs'));
    }

    public function fees(): View
    {
        $fees = ConsultationFee::latest()->paginate(12);

        return view('admin.fees.index', compact('fees'));
    }

    public function updateFee(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $fee = ConsultationFee::updateOrCreate(['name' => $validated['name']], [
            'amount' => $validated['amount'],
            'is_active' => true,
        ]);

        AuditLog::create(['user_id' => $request->user()?->id, 'action' => 'fee_updated', 'subject' => 'Consultation fee', 'description' => "Set {$fee->name} fee to {$fee->amount}", 'ip_address' => $request->ip()]);

        return back()->with('success', 'Consultation fee saved successfully.');
    }

    public function audit(Request $request): View
    {
        $logs = AuditLog::with('user')
            ->when($request->string('search')->toString(), fn ($query, $search) => $query->where('action', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%"))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.audit.index', compact('logs'));
    }
}
