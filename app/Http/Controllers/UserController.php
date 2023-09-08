<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $term = $request->input('term');

        $users = User::with('role')
            ->where('parent_id', $userId)
            ->when($term, function ($query, $term) {
                $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', 'LIKE', '%' . $term . '%');
            })
            ->latest()
            ->paginate(5);

        return Inertia::render('Users/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleId = Auth::user()->role_id;
        return Inertia::render('Users/Create', compact('roleId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = Auth::user();
        $validatedData = $request->validated();
        $validatedData['parent_id'] = $user->id;
        $validatedData['password'] = Hash::make($validatedData['password']);
        if ($user->role_id == 1) {
            $validatedData['role_id'] = 2;
        } elseif ($user->role_id == 2) {
            $validatedData['role_id'] = 3;
        }
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('Users/Edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::where('id', $id)->update($request->all());

        return redirect('/users')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('delete', 'User has been deleted!');
    }
}
