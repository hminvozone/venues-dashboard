<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueStoreRequest;
use App\Models\AssignVenue;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $userId = Auth::id();
        $term = $request->input('term');

        $venues = AssignVenue::with('venues')
            ->where('user_id', $userId)
            ->when($term, function ($query, $term) {
                $query->whereHas('venues', function ($qry) use ($term) {
                    $qry->whereHas('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('email_address', 'LIKE', '%' . $term . '%');
                });
            })
            ->latest()
            ->paginate(5);

        return Inertia::render('StaffVenues/Index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleId = Auth::user()->role_id;
        return Inertia::render('Venues/Create', compact('roleId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VenueStoreRequest $request)
    {
        $userId = Auth::id();
        $validatedData = $request->validated();
        $validatedData['user_id'] = $userId;
        Venue::create($validatedData);

        return redirect()->route('venues.index')->with('success', 'Venue has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $venue = Venue::findOrFail($id);

        return Inertia::render('StaffVenues/Show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venue = Venue::findOrFail($id);

        return Inertia::render('Venues/Edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VenueStoreRequest $request, string $id)
    {
        Venue::where('id', $id)->update($request->all());

        return redirect('/venues')->with('success', 'Venue has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venue = Venue::find($id);
        $venue->delete();

        return back()->with('delete', 'Venue has been deleted!');
    }

    public function deleteMultiple(Request $request)
    {
        $venueIds = $request->input('ids');
        Venue::whereIn('id', $venueIds)->delete();

        return redirect()->route('venues.index')->with('success', 'Operation successfully!');
    }

    public function assign(string $id)
    {
        $userId = Auth::id();
        $venue = Venue::findOrFail($id);
        $users = User::where('parent_id', $userId)->get();
        return Inertia::render('Venues/Assign', compact('venue', 'users'));
    }

    public function assignVenues(Request $request)
    {
        $venueId = $request->input('venue');
        $users = $request->input('assignList');
        if (count($users) > 0) {
            foreach ($users as $id) {
                $assign = new AssignVenue();
                $assign->user_id = $id;
                $assign->venue_id = $venueId;
                $assign->save();
            }
            return redirect('/venues')->with('success', 'Venue assigned successfully.');
        }
    }
}
