<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(Request $request): View
    {
        $staff = User::query()
            ->when($request->string('search')->toString(), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.staff.index', compact('staff'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:administrator,receptionist,attendant,doctor,accountant'],
        ]);

        $user = User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
            'is_active' => true,
            'must_change_password' => true,
        ]);

        $this->audit('staff_created', 'User', "Created staff account {$user->name}", $request);

        return back()->with('success', 'Staff account created successfully.');
    }

    public function update(Request $request, User $staff): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email,'.$staff->id],
            'role' => ['required', 'in:administrator,receptionist,attendant,doctor,accountant'],
            'is_active' => ['required', 'boolean'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->role = $validated['role'];
        $staff->is_active = (bool) $validated['is_active'];
        if (! empty($validated['password'])) {
            $staff->password = Hash::make($validated['password']);
        }
        $staff->save();

        $this->audit('staff_updated', 'User', "Updated staff account {$staff->name}", $request);

        return back()->with('success', 'Staff account updated successfully.');
    }

    public function destroy(Request $request, User $staff): RedirectResponse
    {
        if ($staff->id === $request->user()->id) {
            return back()->withErrors(['staff' => 'You cannot delete your own account.']);
        }

        $name = $staff->name;
        $staff->delete();
        $this->audit('staff_deleted', 'User', "Deleted staff account {$name}", $request);

        return back()->with('success', 'Staff account deleted successfully.');
    }

    private function audit(string $action, string $subject, string $description, Request $request): void
    {
        AuditLog::create([
            'user_id' => $request->user()?->id,
            'action' => $action,
            'subject' => $subject,
            'description' => $description,
            'ip_address' => $request->ip(),
        ]);
    }
}
