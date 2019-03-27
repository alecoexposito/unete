<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Business extends Model {

    protected $with = ["dependences", "categories"];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_businesses';

    protected $fillable = ["name", "description"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function dependences() {
        return $this->hasMany("App\Models\Dependence");
    }

    public function categories() {
        return $this->belongsToMany("App\Models\BusinessCategory", "business_business_category", 'business_id', 'category_id')->withTimestamps();
    }

}
