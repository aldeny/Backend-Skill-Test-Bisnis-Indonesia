<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'location',
        'province_id',
        'category_id',
        'description',
        'information',
        'image',
        'start_date',
        'end_date',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Category::class);
    }
}
