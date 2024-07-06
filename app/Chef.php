<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 0,
    ];

    public static $status = [
        1 => 'active',
        0 => 'inactive',
    ];

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}
