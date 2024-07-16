<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    protected $fillable = [
        'user_id', 'no_ktp', 'nama', 'telp', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
