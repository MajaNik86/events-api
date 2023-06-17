<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $fillable = [
        'url',
        'event_id',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}