<?php

namespace App\Domains\Recipe\Jobs;

use Lucid\Units\Job;
use App\Data\Collections\IngredientsCollection;

class CalculateIngredientsTotalJob extends Job
{
    private IngredientsCollection $ingredients;

    /**
     * Create a new job instance.
     *
     * @param IngredientsCollection $ingredients
     */
    public function __construct(IngredientsCollection $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Execute the job.
     *
     * @return float
     */
    public function handle(): float
    {
        return $this->ingredients->sum('total');
    }
}
