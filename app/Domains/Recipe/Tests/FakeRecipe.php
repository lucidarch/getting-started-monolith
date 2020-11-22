<?php

namespace App\Domains\Recipe\Tests;

use Faker\Factory as Fake;

trait FakeRecipe
{
    protected function randomIngredients(int $count = 1)
    {
        $ingredient = function() {
            $f = Fake::create();

            return sprintf(
                "%s, %s, %s",
                $f->word,
                $f->randomFloat(2, 0, 10),
                $f->randomFloat(2, 0, 10)
            );
        };

        if ($count > 1) {
            $ingredients = [];
            for ($i = 0; $i <= $count; $i++) {
                $ingredients[] = $ingredient();
            }

            return $ingredients;
        }

        return $ingredient();
    }
}
