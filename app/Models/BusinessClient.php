<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessClient extends Model {

    protected $table = 'raf_business_client_accounts';

    use SoftDeletes;

    protected $fillable = ["client_id", "business_id"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function clientType() {
        return $this->belongsTo(ClientType::class);
    }

}
