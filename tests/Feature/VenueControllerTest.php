<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;
use Inertia\Testing\AssertableInertia as Assert;

class VenueControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_method_displays_venues()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some venues associated with the user
        $venue = Venue::factory()->create();
        $venue->user_id = $user->id;
        $venue->save();

        // Make a GET request to the index method
        $response = $this->get('/venues');

        // Assert that the response contains the venues and has a 200 status code
        $response->assertStatus(200);

        // This test intertia component and validate if it has venue data
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Venues/Index')
            ->has('venues')
            ->has('venues.data')
        );
    }

    public function test_create_method_displays_create_form()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make a GET request to the create method
        $response = $this->get('/venues/create');

        // Assert that the response contains the create form and has a 200 status code
        $response->assertStatus(200);
    }

    public function test_store_method_creates_venue()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate data for a new venue
        $venue = Venue::factory()->make();

        // Call makeHidden on the model instance
        $venue->makeHidden(['formatted_created_at']);

        // Convert the model to an array
        $venueData = $venue->toArray();

        // Make a POST request to the store method with the venue data
        $response = $this->post('/venues', $venueData);

        // Assert that the venue was created and has been redirected to the index page
        $response->assertRedirect(route('venues.index'));
        $this->assertDatabaseHas('venues', $venueData);
    }

    public function test_edit_method_displays_edit_form()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a venue
        $venue = Venue::factory()->create();
        $venue->user_id = $user->id;
        $venue->save();

        // Make a GET request to the edit method
        $response = $this->get('/venues/' . $venue->id . '/edit');

        // Assert that the response contains the edit form and has a 200 status code
        $response->assertStatus(200);

        // This test intertia component and validate if it has venue data
        $response->assertInertia(fn (Assert $page) => $page
            ->has('venue')
            ->has('venue.id')
        );
    }

    public function test_update_method_updates_venue()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a venue
        $venue = Venue::factory()->create();
        $venue->user_id = $user->id;
        $venue->save();

        // Generate updated data for the venue
        $updatedData = Venue::factory()->make();

        // Call makeHidden on the model instance
        $updatedData->makeHidden(['formatted_created_at']);

        // Convert the model to an array
        $updatedData = $updatedData->toArray();

        // Make a PUT request to the update method with the updated data
        $response = $this->put(route('venues.update', ['venue' => $venue->id]), $updatedData);

        // Check that the venue in the database matches the updated data
        $this->assertDatabaseHas('venues', $updatedData);
    }

    public function test_destroy_method_deletes_venue()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a venue
        $venue = Venue::factory()->create();
        $venue->user_id = $user->id;
        $venue->save();

        // Make a DELETE request to the destroy method
        $response = $this->delete('/venues/' . $venue->id);

        // Check that the venue is not in the database
        $this->assertSoftDeleted('venues', ['id' => $venue->id]);
    }

    public function test_assign_method_displays_assign_form()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a venue
        $venue = Venue::factory()->create();
        $venue->user_id = $user->id;
        $venue->save();

        // Make a GET request to the assign method
        $response = $this->get('/venues/assign/' . $venue->id);

        // Assert that the response contains the assign form and has a 200 status code
        $response->assertStatus(200);
        
        // This test intertia component and validate if it has venue data
        $response->assertInertia(fn (Assert $page) => $page
            ->has('venue')
            ->has('venue.id')
        );
    }

    public function test_assignVenues_method_assigns_venues_to_users()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a venue
        $venue = Venue::factory()->create();
        $venue->user_id = $user->id;
        $venue->save();

        // Create some users
        $users = User::factory()->count(3)->create(['parent_id' => $user->id]);

        // Make a POST request to the assignVenues method with user IDs
        $response = $this->post('/venues/assign', [
            'venue' => $venue->id,
            'assignList' => $users->pluck('id')->toArray(),
        ]);

        // Assert that the venues have been assigned and redirected
        $response->assertRedirect('/venues');

        // Check that the assignments are in the database
        foreach ($users as $user) {
            $this->assertDatabaseHas('assign_venues', [
                'user_id' => $user->id,
                'venue_id' => $venue->id,
            ]);
        }
    }
}

