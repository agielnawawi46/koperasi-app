<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('super-admin.dashboard.index', compact('users', 'roles'));
    }

    public function storeAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'member_code' => 'USR-'.strtoupper(uniqid()),
        ]);

        $role = Role::findOrCreate('admin');
        $user->assignRole($role);

        return redirect()->route('super-admin.dashboard')->with('status', 'Admin utama berhasil ditambahkan.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->hasRole('super_admin')) {
            return back()->with('error', 'Tidak dapat menghapus super admin.');
        }

        $user->delete();

        return redirect()->route('super-admin.dashboard')->with('status', 'Pengguna berhasil dihapus.');
    }
}
