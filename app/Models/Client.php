<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 * @mixin Eloquent
 * @package App\Models
 */
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

    protected $with = ["user", "account"];

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
