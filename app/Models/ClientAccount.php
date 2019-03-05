<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model {


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_client_accounts';

    protected $fillable = ["account_number", "client_id"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function client()
    {
        return $this->belongsTo("App\Models\Client");
    }


}
