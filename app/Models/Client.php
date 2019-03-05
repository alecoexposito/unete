<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_clients';

    protected $fillable = ["phone", "birth_date"];

    protected $dates = ["birth_date"];

    public static $rules = [
        // Validation rules
    ];

    public function account()
    {
        return $this->hasOne("App\Models\ClientAccount");
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }


}
