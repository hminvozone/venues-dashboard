<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;

class VenueControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_method_displays_venues()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some venues associated with the user
        Venue::factory()->create(['user_id' => $user->id]);

        // Make a GET request to the index method
        $response = $this->get('/venues');

        // Assert that the response contains the venues and has a 200 status code
        $response->assertStatus(200);
        $response->assertViewHas('venues');
    }

//    public function test_create_method_displays_create_form()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Make a GET request to the create method
//        $response = $this->get('/venues/create');
//
//        // Assert that the response contains the create form and has a 200 status code
//        $response->assertStatus(200);
//    }
//
//    public function test_store_method_creates_venue()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Generate data for a new venue
//        $venueData = factory(Venue::class)->make()->toArray();
//
//        // Make a POST request to the store method with the venue data
//        $response = $this->post('/venues', $venueData);
//
//        // Assert that the venue was created and has been redirected to the index page
//        $response->assertRedirect('/venues');
//        $this->assertDatabaseHas('venues', $venueData);
//    }
//
//    public function test_show_method_displays_venue_details()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Create a venue
//        $venue = factory(Venue::class)->create(['user_id' => $user->id]);
//
//        // Make a GET request to the show method
//        $response = $this->get('/venues/' . $venue->id);
//
//        // Assert that the response contains the venue details and has a 200 status code
//        $response->assertStatus(200);
//        $response->assertViewHas('venue', $venue);
//    }
//
//    public function test_edit_method_displays_edit_form()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Create a venue
//        $venue = factory(Venue::class)->create(['user_id' => $user->id]);
//
//        // Make a GET request to the edit method
//        $response = $this->get('/venues/' . $venue->id . '/edit');
//
//        // Assert that the response contains the edit form and has a 200 status code
//        $response->assertStatus(200);
//        $response->assertViewHas('venue', $venue);
//    }
//
//    public function test_update_method_updates_venue()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Create a venue
//        $venue = factory(Venue::class)->create(['user_id' => $user->id]);
//
//        // Generate updated data for the venue
//        $updatedVenueData = factory(Venue::class)->make()->toArray();
//
//        // Make a PUT request to the update method with the updated data
//        $response = $this->put('/venues/' . $venue->id, $updatedVenueData);
//
//        // Assert that the venue has been updated and has been redirected
//        $response->assertRedirect('/venues/' . $venue->id);
//
//        // Check that the venue in the database matches the updated data
//        $this->assertDatabaseHas('venues', $updatedVenueData);
//    }
//
//    public function test_destroy_method_deletes_venue()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Create a venue
//        $venue = factory(Venue::class)->create(['user_id' => $user->id]);
//
//        // Make a DELETE request to the destroy method
//        $response = $this->delete('/venues/' . $venue->id);
//
//        // Assert that the venue has been deleted and has been redirected
//        $response->assertRedirect('/venues');
//
//        // Check that the venue is not in the database
//        $this->assertDatabaseMissing('venues', ['id' => $venue->id]);
//    }
//
//    public function test_assign_method_displays_assign_form()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Create a venue
//        $venue = factory(Venue::class)->create(['user_id' => $user->id]);
//
//        // Make a GET request to the assign method
//        $response = $this->get('/venues/' . $venue->id . '/assign');
//
//        // Assert that the response contains the assign form and has a 200 status code
//        $response->assertStatus(200);
//        $response->assertViewHas('venue', $venue);
//    }
//
//    public function test_assignVenues_method_assigns_venues_to_users()
//    {
//        // Create a user and log in
//        $user = factory(User::class)->create();
//        $this->actingAs($user);
//
//        // Create a venue
//        $venue = factory(Venue::class)->create(['user_id' => $user->id]);
//
//        // Create some users
//        $users = factory(User::class, 3)->create(['parent_id' => $user->id]);
//
//        // Make a POST request to the assignVenues method with user IDs
//        $response = $this->post('/venues/assign', [
//            'venue' => $venue->id,
//            'assignList' => $users->pluck('id')->toArray(),
//        ]);
//
//        // Assert that the venues have been assigned and redirected
//        $response->assertRedirect('/venues');
//
//        // Check that the assignments are in the database
//        foreach ($users as $user) {
//            $this->assertDatabaseHas('assign_venues', [
//                'user_id' => $user->id,
//                'venue_id' => $venue->id,
//            ]);
//        }
//    }
}

