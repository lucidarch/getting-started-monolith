<?php

namespace App\Domains\Recipe\Jobs;

use Lucid\Units\Job;
use App\Data\Values\Ingredient;
use App\Data\Collections\IngredientsCollection;

class ParseIngredientsJob extends Job
{
    private string $ingredients;

    /**
     * Create a new job instance.
     *
     * @param string $ingredients
     */
    public function __construct(string $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Execute the job.
     *
     * @return IngredientsCollection
     */
    public function handle(): IngredientsCollection
    {
        $ingredients = new IngredientsCollection();

        foreach (array_filter(explode("\r\n", $this->ingredients)) as $line) {
            $ingredient = new Ingredient(...explode(',', $line));
            $ingredients->push($ingredient);
        }

        return $ingredients;
    }
}
