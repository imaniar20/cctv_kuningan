<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;
    protected $table = 'cameras';
    protected $fillable = [
        'id_location',
        'name',
        'rtsp_url',
        'slug',
        'lat',
        'lng',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }
}
