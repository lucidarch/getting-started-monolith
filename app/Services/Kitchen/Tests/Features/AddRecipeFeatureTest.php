<?php

namespace App\Services\Kitchen\Tests\Features;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddRecipeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_submit_a_recipe()
    {
        $response = $this->post('/kitchen/recipes', [
            'title' => 'Avocado Salad Starter',
            'ingredients' => "Avocado, 1, 1.2\r\nLettuce, 0.4, 0.8",
            'instructions' => 'Mix it with oil and enjoy!',
        ]);

        $response->assertStatus(403);
        $response->assertSee('This action is unauthorized.');
    }

    public function test_recipe_is_not_created_if_validation_fails()
    {
        $response = $this->actingAs(User::factory()->create())->post('/kitchen/recipes');

        $response->assertSessionHasErrors(['title', 'ingredients']);
    }

    public function test_max_length_fails_when_too_long()
    {
        $title = str_repeat('a', 256);
        $ingredients = str_repeat('a', 256);
        $instructions = str_repeat('a', 256);

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post('/kitchen/recipes', compact('title', 'ingredients', 'instructions'));

        $response->assertSessionHasErrors([
            'title' => 'The title may not be greater than 255 characters.',
            'ingredients' => 'The ingredients may not be greater than 255 characters.',
            'instructions' => 'The instructions may not be greater than 255 characters.',
        ]);
    }

    public function test_max_length_succeeds_when_under_max()
    {
        $data = [
            'title' => str_repeat('a', 255),
            'ingredients' => str_repeat('a', 255),
            'instructions' => str_repeat('a', 255),
        ];

        $this->actingAs(User::factory()->create())->post('/kitchen/recipes', $data);

        $this->assertDatabaseHas('recipes', $data);
    }
}
