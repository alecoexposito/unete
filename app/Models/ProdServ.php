<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdServ extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raf_prod_servs';

    protected $fillable = ["name", "description", "price_mn", "price_cuc", "dependence_id"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function dependence()
    {
        return $this->belongsTo("App\Models\Dependence");
    }


}
