<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];

    public static $status = [
        1 => 'active',
        0 => 'inactive',
    ];

    public function recipes() {
        return $this->hasMany('App\Recipes');
    }
}
