<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = [
        'nama'
    ];

    public function camera()
    {
        return $this->hasMany(Camera::class, 'id_location');
    }
}
