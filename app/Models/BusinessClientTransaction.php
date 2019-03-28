<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessClientTransaction extends Model {

    protected $table = "raf_business_client_transactions";

    protected $fillable = ["ticket", "amount"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function dependenceAccount() {
        return $this->belongsTo(BusinessAccount::class);
    }

    public function businessClient() {
        return $this->belongsTo(BusinessClient::class);
    }

    public function visit() {
        return $this->belongsTo(Visit::class);
    }
}
