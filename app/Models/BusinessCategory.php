<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model {

    use \Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_business_categories';

    protected $fillable = ["name", "description", "parent_id"];

    protected $dates = [];

    public static $rules = [
        "name" => "required",
    ];

    public function category() {
        return $this->belongsTo("App\Models\BusinessCategory", 'parent_id');
    }

    public function subcategories() {
        return $this->hasMany("App\Models\BusinessCategory", 'parent_id');
    }


}
