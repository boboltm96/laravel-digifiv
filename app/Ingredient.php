<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $guarded = [];

    //
    public function recipes() {
        return $this->belongsToMany('App\Recipe', 'recipe_ingredients', 'ingredient_id', 'recipe_id');
    }
}
