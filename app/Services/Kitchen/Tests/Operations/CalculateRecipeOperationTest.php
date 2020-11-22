<?php

namespace App\Services\Kitchen\Tests\Operations;

use Tests\TestCase;
use App\Services\Kitchen\Operations\CalculateRecipePriceOperation;

class CalculateRecipeOperationTest extends TestCase
{
    public function test_calculate_recipe_operation()
    {
        $input = "Avocado, 1, 1.2\r\nLettuce, 0.4, 0.8";

        $op = new CalculateRecipePriceOperation($input);

        $this->assertEquals(1.52, $op->handle());
    }

    public function test_calculating_empty_recipe_operation()
    {
        $op = new CalculateRecipePriceOperation("");

        $this->assertEquals(0.0, $op->handle());
    }

    public function test_calculating_recipe_with_missing_values_operation()
    {
        $input = "Missing Price, 1\r\nOnly Title\r\n";

        $op = new CalculateRecipePriceOperation($input);

        $this->assertEquals(0.0, $op->handle());
    }
}
