<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 0,
        'popularity' => 0,
    ];

    public static $status = [
        1 => 'active',
        0 => 'inactive',
    ];

    public function chef()
    {
        return $this->belongsTo('App\Chef');
    }

    public function ingredients() {
        return $this->belongsToMany('App\Ingredient', 'recipe_ingredients', 'recipe_id', 'ingredient_id');
    }

    public function category() {
        return $this->belongsTo('App\Categories');
    }
}
