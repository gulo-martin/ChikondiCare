<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index(Request $request): View
    {
        $doctors = Doctor::query()
            ->when($request->string('search')->toString(), fn ($query, $search) => $query->where('name', 'like', "%{$search}%")->orWhere('doctor_number', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'doctor_number' => ['required', 'string', 'max:30', 'unique:doctors,doctor_number'],
            'name' => ['required', 'string', 'max:120'],
            'telephone' => ['required', 'string', 'max:30'],
            'room_number' => ['nullable', 'string', 'max:30'],
            'employment_type' => ['required', 'in:full_time,visiting'],
            'next_visit_date' => ['nullable', 'required_if:employment_type,visiting', 'date'],
            'next_visit_duration' => ['nullable', 'required_if:employment_type,visiting', 'integer', 'min:1'],
        ]);

        $doctor = Doctor::create($validated);
        $this->audit($request, 'doctor_created', 'Doctor', "Registered Dr. {$doctor->name}");

        return back()->with('success', 'Doctor profile created successfully.');
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $validated = $request->validate([
            'doctor_number' => ['required', 'string', 'max:30', 'unique:doctors,doctor_number,'.$doctor->id],
            'name' => ['required', 'string', 'max:120'],
            'telephone' => ['required', 'string', 'max:30'],
            'room_number' => ['nullable', 'string', 'max:30'],
            'employment_type' => ['required', 'in:full_time,visiting'],
            'next_visit_date' => ['nullable', 'required_if:employment_type,visiting', 'date'],
            'next_visit_duration' => ['nullable', 'required_if:employment_type,visiting', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        $doctor->update($validated);
        $this->audit($request, 'doctor_updated', 'Doctor', "Updated Dr. {$doctor->name}");

        return back()->with('success', 'Doctor profile updated successfully.');
    }

    public function destroy(Request $request, Doctor $doctor): RedirectResponse
    {
        $doctor->delete();
        $this->audit($request, 'doctor_deleted', 'Doctor', 'Removed a doctor profile');

        return back()->with('success', 'Doctor profile removed successfully.');
    }

    private function audit(Request $request, string $action, string $subject, string $description): void
    {
        AuditLog::create(['user_id' => $request->user()?->id, 'action' => $action, 'subject' => $subject, 'description' => $description, 'ip_address' => $request->ip()]);
    }
}
