<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model {

    protected $table = 'raf_visits';

    protected $fillable = ["visited_at"];

    protected $dates = ["visited_at"];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function businessClient() {
        return $this->belongsTo("App\Models\BusinessClient", 'business_client_id');
    }

}
