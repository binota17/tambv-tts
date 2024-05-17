<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($admin->email)->send(new \App\Mail\WelcomeAdmin($admin));

        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        if (Gate::forUser(Auth::guard('admin')->user())->allows('view-users')) {
            return view('admin.index');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to view users.');
    }

    public function details()
    {
        if (Gate::allows('view-users')) {
            return view('users.show');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to view this user.');
    }

    public function create()
    {
        if (Gate::allows('create-users')) {
            return view('users.create');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to create users.');
    }


    public function edit()
    {
        if (Gate::allows('update-users')) {
            return view('users.edit');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to edit users.');
    }

    public function delete()
    {
        if (Gate::allows('delete-users')) {
            return redirect()->route('users.index');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to delete users.');
    }
}
