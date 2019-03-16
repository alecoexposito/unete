<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model {


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_advertisements';

    protected $fillable = ["title", "description", "image"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

}
