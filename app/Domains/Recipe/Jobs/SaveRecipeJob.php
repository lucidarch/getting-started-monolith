<?php

namespace App\Domains\Recipe\Jobs;

use Lucid\Units\Job;
use App\Models\User;
use App\Data\Models\Recipe;

class SaveRecipeJob extends Job
{
    private string $title;
    private string $ingredients;
    private string $instructions;
    private string $price;
    private User $user;

    /**
     * Create a new job instance.
     *
     * @param $title
     * @param $ingredients
     * @param $instructions
     * @param $price
     * @param User $user
     */
    public function __construct($title, $ingredients, $instructions, $price, User $user)
    {
        $this->title = $title;
        $this->ingredients = $ingredients;
        $this->instructions = $instructions;
        $this->price = $price;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return Recipe
     */
    public function handle(): Recipe
    {
        $attributes = [
            'title' => $this->title,
            'ingredients' => $this->ingredients,
            'instructions' => $this->instructions,
            'price' => $this->price,
            'user_id' => $this->user->getKey(),
        ];

        return tap(new Recipe($attributes))->save();
    }
}
