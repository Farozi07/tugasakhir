<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [] ;

    protected $fillable = [
        'user_id', 'nama_bidang', 'penanggung_jawab'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
