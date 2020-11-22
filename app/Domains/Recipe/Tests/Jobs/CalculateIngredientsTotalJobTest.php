<?php

namespace App\Domains\Recipe\Tests\Jobs;

use App\Data\Values\Ingredient;
use App\Domains\Recipe\Tests\FakeRecipe;
use App\Data\Collections\IngredientsCollection;
use App\Domains\Recipe\Jobs\CalculateIngredientsTotalJob;
use Tests\TestCase;

class CalculateIngredientsTotalJobTest extends TestCase
{
    use FakeRecipe;

    public function test_calculate_ingredients_total_job()
    {
        $raw = $this->randomIngredients(10);

        $ingredients = new IngredientsCollection();

        foreach($raw as $line) {
            $ingredients->push(new Ingredient(...explode(',', $line)));
        }

        $job = new CalculateIngredientsTotalJob($ingredients);

        $total = $job->handle();

        $this->assertGreaterThan(0, $total);
        $this->assertEquals($ingredients->sum('total'), $total);
    }
}
