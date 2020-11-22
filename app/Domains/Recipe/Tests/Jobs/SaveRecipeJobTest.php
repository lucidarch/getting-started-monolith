<?php

namespace App\Domains\Recipe\Tests\Jobs;

use Tests\TestCase;
use App\Models\User;
use Faker\Factory as Fake;
use App\Data\Models\Recipe;
use App\Domains\Recipe\Tests\FakeRecipe;
use App\Domains\Recipe\Jobs\SaveRecipeJob;

class SaveRecipeJobTest extends TestCase
{
    use FakeRecipe;

    public function test_save_recipe_job()
    {
        $f = Fake::create();

        $title = $f->words(3, true);
        $instructions = $f->paragraph;
        $ingredients = join("\r\n", [
            $this->randomIngredients(),
            $this->randomIngredients(),
            $this->randomIngredients(),
        ]);
        $price = $f->randomFloat(2, 0, 10);

        $user = User::factory()->create();

        $job = new SaveRecipeJob($title, $ingredients, $instructions, $price, $user);

        $recipe = $job->handle();

        $this->assertInstanceOf(Recipe::class, $recipe);
        $this->assertEquals($title, $recipe->title);
        $this->assertEquals($ingredients, $recipe->ingredients);
        $this->assertEquals($instructions, $recipe->instructions);
    }

}
