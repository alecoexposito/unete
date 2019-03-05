<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAccount extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_business_accounts';

    protected $fillable = ["account_number", "default_percent", "dependence_id"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function transactions()
    {
        return $this->hasMany("App\Models\Transaction");
    }


}
