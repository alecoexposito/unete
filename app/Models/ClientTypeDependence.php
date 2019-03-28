<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientTypeDependence extends Model {

    protected $table = "raf_client_type_dependences";

    protected $fillable = ["global_percent", "local_percent"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function clientType() {
        return $this->belongsTo(ClientType::class);
    }

    public function dependence() {
        return $this->belongsTo(Dependence::class);
    }
}
