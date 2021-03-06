<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependence extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_dependencies';

    protected $with = ["business", "account", "client_types"];

    protected $fillable = ["name", "description", "main"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function account()
    {
        return $this->hasOne("App\Models\BusinessAccount");
    }

    public function prod_servs()
    {
        return $this->hasMany("App\Models\ProdServ");
    }

    public function business()
    {
        return $this->belongsTo("App\Models\Business");
    }

    public function client_types() {
        return $this->hasMany(ClientTypeDependence::class);
    }



}
