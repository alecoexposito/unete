<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model {

    protected $table = "raf_client_types";

    protected $fillable = ["name", "description"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function business() {
        return $this->belongsTo(Business::class);
    }

}
