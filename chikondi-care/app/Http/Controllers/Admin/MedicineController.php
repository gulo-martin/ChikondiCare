<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Medicine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function index(Request $request): View
    {
        $medicines = Medicine::query()
            ->when($request->string('search')->toString(), fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.medicines.index', compact('medicines'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:medicines,name'],
            'dosage_form' => ['nullable', 'string', 'max:50'],
            'strength' => ['nullable', 'string', 'max:50'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
        ]);

        $medicine = Medicine::create($validated);
        $this->audit($request, 'medicine_created', 'Medicine', "Added {$medicine->name} to the catalogue");

        return back()->with('success', 'Medicine added successfully.');
    }

    public function update(Request $request, Medicine $medicine): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:medicines,name,'.$medicine->id],
            'dosage_form' => ['nullable', 'string', 'max:50'],
            'strength' => ['nullable', 'string', 'max:50'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $medicine->update($validated);
        $this->audit($request, 'medicine_updated', 'Medicine', "Updated {$medicine->name}");

        return back()->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Request $request, Medicine $medicine): RedirectResponse
    {
        $name = $medicine->name;
        $medicine->delete();
        $this->audit($request, 'medicine_deleted', 'Medicine', "Removed {$name} from the catalogue");

        return back()->with('success', 'Medicine removed successfully.');
    }

    private function audit(Request $request, string $action, string $subject, string $description): void
    {
        AuditLog::create(['user_id' => $request->user()?->id, 'action' => $action, 'subject' => $subject, 'description' => $description, 'ip_address' => $request->ip()]);
    }
}
