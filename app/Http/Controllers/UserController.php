<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Services\ForgetPassword;
use App\Services\EmailService;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('is_customer', false)->with('role')->get();
        return view('portal.pages.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('portal.pages.users.newUser', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    
     public function store(Request $request)
     {
         if (Auth::user()->is_customer) {
             return redirect()->route('users')->with('error', 'Customers cannot add a user.');
         }
     
         $validatedData = $request->validate([
             'firstName' => 'required|string|max:255',
             'lastName' => 'required|string|max:255',
             'email' => 'required|email|unique:users',
             'phone' => 'required|string|max:255',
             'role_id' => 'required|exists:roles,id',
         ]);

         $pass = 'password';
     
         try {
             // Create user with mass assignment
             $user = User::create([
                 'firstName' => $validatedData['firstName'],
                 'lastName' => $validatedData['lastName'],
                 'email' => $validatedData['email'],
                 'phone' => $validatedData['phone'],
                 'password' => Hash::make($pass),
                 'role_id' => $validatedData['role_id'],
             ]);
         } catch (\Exception $e) {
             // For debugging, you might want to log the error
             \Log::error('User creation failed: ' . $e->getMessage());
             return redirect()->route('users')->with('error', 'Failed to create new user.');
         }
     
         $forgetPassword = new ForgetPassword();
         $forgetPassword->PasswordLink($user->email);
     
         return redirect()->route('users')->with('success', 'User created');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
