<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property-read string $title
 * @property-read string $ingredients
 * @property-read string $instructions
 * @property-read float $price
 */
class Recipe extends Model
{
    protected $fillable = ['title', 'ingredients', 'instructions', 'price', 'user_id'];
}
