<?php

namespace App\Domains\Recipe\Tests\Jobs;

use Tests\TestCase;
use App\Data\Collections\IngredientsCollection;
use App\Domains\Recipe\Jobs\ParseIngredientsJob;

class ParseIngredientsJobTest extends TestCase
{
    public function test_parse_ingredients_job()
    {
        $input = "Avocado, 1, 1.2\r\nLettuce, 0.4, 0.8";

        $job = new ParseIngredientsJob($input);

        $ingredients = $job->handle();

        $this->assertInstanceOf(IngredientsCollection::class, $ingredients);

        $this->assertEquals('Avocado', $ingredients[0]->name);
        $this->assertEquals(1.0, $ingredients[0]->quantity);
        $this->assertEquals(1.2, $ingredients[0]->price);
        $this->assertEquals(1.2, $ingredients[0]->total);

        $this->assertEquals('Lettuce', $ingredients[1]->name);
        $this->assertEquals(0.4, $ingredients[1]->quantity);
        $this->assertEquals(0.8, $ingredients[1]->price);
        $this->assertEquals(0.32, $ingredients[1]->total);
    }

    public function test_parsing_empty_ingredients()
    {
        $job = new ParseIngredientsJob("");

        $ingredients = $job->handle();

        $this->assertInstanceOf(IngredientsCollection::class, $ingredients);
        $this->assertTrue($ingredients->isEmpty());
    }

    public function test_failsafe_parsing_ingredients_with_missing_values()
    {
        $input = "Missing Price, 1\r\nOnly Title\r\n";

        $job = new ParseIngredientsJob($input);

        $ingredients = $job->handle();

        $this->assertInstanceOf(IngredientsCollection::class, $ingredients);
        $this->assertEquals(2, $ingredients->count());

        $this->assertEquals('Missing Price', $ingredients[0]->name);
        $this->assertEquals(1.0, $ingredients[0]->quantity);
        $this->assertEquals(0, $ingredients[0]->price);
        $this->assertEquals(0, $ingredients[0]->total);

        $this->assertEquals('Only Title', $ingredients[1]->name);
        $this->assertEquals(0, $ingredients[1]->quantity);
        $this->assertEquals(0, $ingredients[1]->price);
        $this->assertEquals(0, $ingredients[1]->total);
    }
}
