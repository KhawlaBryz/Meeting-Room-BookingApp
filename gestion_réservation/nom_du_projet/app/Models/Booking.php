<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'user_id',
       
        'effectif',
        'salle_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function salle()
    {
        return $this->belongsTo(salle::class);
    }
}
