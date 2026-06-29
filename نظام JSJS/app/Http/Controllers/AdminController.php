<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin Login Page
    public function showLogin()
    {
        return view('admin.login');
    }

    // Admin Login Action
    public function login(Request $request)
    {
        if ($request->password === '12345') {
            session(['is_admin' => true]);
            return redirect()->route('admin.users.index');
        }

        return back()->withErrors(['password' => 'كلمة مرور الإدارة غير صحيحة']);
    }

    // Logout
    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('welcome');
    }

    // Middleware check
    private function checkAdmin()
    {
        if (!session('is_admin')) {
            return false;
        }
        return true;
    }

    // Users List
    public function usersIndex()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Create User Form
    public function usersCreate()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        return view('admin.users.create');
    }

    // Store User
    public function usersStore(Request $request)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // Edit User Form
    public function usersEdit($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function usersUpdate(Request $request, $id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:4|confirmed',
        ]);

        $user->username = $request->username;
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح');
    }

    // Delete User
    public function usersDestroy($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }

    // ========== JUDGES MANAGEMENT ==========

    public function judgesIndex()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $judges = Judge::all();
        return view('admin.judges.index', compact('judges'));
    }

    public function judgesCreate()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        return view('admin.judges.create');
    }

    public function judgesStore(Request $request)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'specialization' => 'nullable|string',
            'court' => 'nullable|string',
        ]);

        Judge::create($request->only('name', 'phone', 'specialization', 'court'));

        return redirect()->route('admin.judges.index')->with('success', 'تم إضافة القاضي بنجاح');
    }

    public function judgesEdit($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $judge = Judge::findOrFail($id);
        return view('admin.judges.edit', compact('judge'));
    }

    public function judgesUpdate(Request $request, $id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $judge = Judge::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'specialization' => 'nullable|string',
            'court' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $judge->update($request->only('name', 'phone', 'specialization', 'court', 'status'));

        return redirect()->route('admin.judges.index')->with('success', 'تم تحديث بيانات القاضي بنجاح');
    }

    public function judgesDestroy($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.login');
        }

        $judge = Judge::findOrFail($id);
        $judge->delete();

        return redirect()->route('admin.judges.index')->with('success', 'تم حذف القاضي بنجاح');
    }
}
