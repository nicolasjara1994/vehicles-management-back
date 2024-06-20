<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = "vehicles";

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand',
        'model',
        'number_plate',
        'year',
        'owner',
        'price',
    ];

    /**
     * Get the UserVehicle that owns the vehicle.
     */
    public function UserVehicle()
    {
        return $this->belongsTo(UserVehicle::class);
    }
}
