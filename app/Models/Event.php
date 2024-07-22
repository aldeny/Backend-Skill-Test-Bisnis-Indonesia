<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}
