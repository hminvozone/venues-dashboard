<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueStoreRequest;
use App\Models\AssignVenue;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $term = $request->input('term');

        $venuesQuery = Venue::query()
            ->where('user_id', $userId)
            ->when($term, function ($query) use ($term) {
                return $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email_address', 'LIKE', '%' . $term . '%');
            })
            ->latest();

        // Paginate the query result
        $venues = $venuesQuery->paginate(5);

        // Cache the paginated result
        Cache::put('venues_' . $userId, $venues, now()->addMinutes(60));

        return Inertia::render('Venues/Index', compact('venues'));
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
        $venue = Venue::find($id);

        if ($venue) {
            $venue->update($request->all());
        }

        $user = Auth::user();
        if ($user->role_id == 2) {
            return redirect('/venues')->with('success', 'Venue has been updated!');
        } else {
            return redirect('/staff/venue/list')->with('success', 'Venue has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $venue = Venue::find($id);
        $venue->delete();
        Cache::forget('venues_' . $user->id);
        return back()->with('delete', 'Venue has been deleted!');
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
