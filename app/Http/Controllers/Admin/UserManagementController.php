<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function index(): View
    {
        $roles = Role::all()->pluck('name');
        $users = User::with('roles')->orderBy('created_at', 'desc')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->first()?->name ?? 'N/A',
                'status' => $user->status === 'active' ? 'aktif' : 'nonaktif',
                'member_code' => $user->member_code,
            ];
        });

        return view('admin.pengguna.index', compact('roles', 'users'));
    }

    public function getData()
    {
        $roles = Role::all()->pluck('name');
        $users = User::with('roles')->orderBy('created_at', 'desc')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->first()?->name ?? 'N/A',
                'status' => $user->status === 'active' ? 'aktif' : 'nonaktif',
                'member_code' => $user->member_code,
            ];
        });

        return response()->json(compact('roles', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'member_code' => strtoupper(substr($request->role, 0, 3)).'-'.str_pad((string) (User::max('id') + 1), 4, '0', STR_PAD_LEFT),
            'status' => 'active',
            'join_date' => now(),
        ]);

        $user->assignRole($request->role);

        // Auto-create simpanan pokok for new anggota
        if ($request->role === 'anggota') {
            $org = Organization::first();
            $pokokAmount = $org?->pokok_amount ?? 500000;

            $saving = Saving::create([
                'user_id' => $user->id,
                'type' => 'pokok',
                'balance' => $pokokAmount,
            ]);

            SavingsTransaction::create([
                'saving_id' => $saving->id,
                'user_id' => $user->id,
                'type' => 'setor',
                'amount' => $pokokAmount,
                'description' => 'Setoran awal simpanan pokok',
                'transaction_date' => now(),
                'status' => 'approved',
                'payment_method' => 'otomatis',
                'verified_at' => now(),
            ]);
        }

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'create_user',
            'description' => 'Membuat akun '.$request->role.': '.$request->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Akun '.$request->role.' berhasil dibuat!');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$user->id],
            'role' => ['required', 'string', 'exists:roles,name'],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'update_user',
            'description' => 'Memperbarui akun: '.$user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Akun berhasil diperbarui!');
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        $user->update([
            'status' => $user->status === 'active' ? 'inactive' : 'active',
        ]);

        ActivityLog::create([
            'user_id' => request()->user()->id,
            'action' => 'toggle_user_status',
            'description' => 'Mengubah status akun: '.$user->email.' menjadi '.$user->status,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Status pengguna berhasil diubah!');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->hasRole('admin') && User::role('admin')->count() <= 1) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Tidak dapat menghapus admin terakhir!');
        }

        $user->delete();

        ActivityLog::create([
            'user_id' => request()->user()->id,
            'action' => 'delete_user',
            'description' => 'Menghapus akun: '.$user->email,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Akun berhasil dihapus!');
    }
}
