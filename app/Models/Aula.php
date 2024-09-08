<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}
