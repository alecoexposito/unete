<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_transactions';

    protected $fillable = ["business_client_id", "amount"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function clientAccount()
    {
        return $this->belongsTo("App\Models\ClientAccount");
    }

    public function businessAccount()
    {
        return $this->belongsTo("App\Models\BusinessAccount");
    }


}
