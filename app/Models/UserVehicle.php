<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'brand',
        'model',
        'number_plate',
        'year',
        'price',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
