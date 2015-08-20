<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * No timestamps available in the table
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'name',
        'copyright_email'
    ];
}
