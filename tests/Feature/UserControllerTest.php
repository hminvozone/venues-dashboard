<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;
use Inertia\Testing\AssertableInertia as Assert;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_method_displays_Users()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some Users associated with the user
        $user->staff()->saveMany(User::factory()->count(4)->create([
            'role_id' => 3,
        ]));

        // Make a GET request to the index method
        $response = $this->get('/users');

        // Assert that the response contains the Users and has a 200 status code
        $response->assertStatus(200);

        // This test intertia component and validate if it has User data
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Users/Index')
            ->has('users')
            ->has('users.data')
        );
    }

    public function test_create_method_displays_create_form()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make a GET request to the create method
        $response = $this->get('/users/create');

        // Assert that the response contains the create form and has a 200 status code
        $response->assertStatus(200);
    }

    public function test_store_method_creates_User()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate data for a new User
        $requestData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('123456'),
            'role_id' => 3,
        ];

        // Make a POST request to the store method with the User data
        $response = $this->post('/users', $requestData);
        
        // Assert that the User was created and has been redirected to the index page
        $response->assertRedirect(route('users.index'));
    }

    public function test_edit_method_displays_edit_form()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a User
        $newUser = User::factory()->create();

        // Make a GET request to the edit method
        $response = $this->get('/users/' . $newUser->id . '/edit');

        // Assert that the response contains the edit form and has a 200 status code
        $response->assertStatus(200);

        // This test intertia component and validate if it has User data
        $response->assertInertia(fn (Assert $page) => $page
            ->has('user')
            ->has('user.id')
        );
    }

    public function test_update_method_updates_User()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a User
        $newUser = User::factory()->create();

        $updatedData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ];

        // Make a PUT request to the update method with the updated data
        $response = $this->put(route('users.update', ['user' => $newUser->id]), $updatedData);

        // Assert that the user was created and has been redirected to the index page
        $response->assertRedirect(route('users.index'));
    }

    public function test_destroy_method_deletes_User()
    {
        // this create user and consider as authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a user
        $newUser = User::factory()->create([
            'parent_id' => $user->id
        ]);

        // Make a DELETE request to the destroy method
        $response = $this->delete('/users/' . $newUser->id);

        // Check that the user is not in the database
        $this->assertSoftDeleted('users', ['id' => $newUser->id]);
    }
}

