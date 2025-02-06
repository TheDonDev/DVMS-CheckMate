<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id', 'feedback'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}