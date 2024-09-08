<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $guarded = [] ;
    use HasFactory;

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}
