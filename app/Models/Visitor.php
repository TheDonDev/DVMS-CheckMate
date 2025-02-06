<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_number',
        'first_name',
        'last_name',
        'designation',
        'organization',
        'email',
        'phone_number',
        'id_number',
        'visit_type',
        'visit_facility',
        'visit_date',
        'visit_from',
        'visit_to',
        'purpose_of_visit',
        'host_id', // Ensure host_id is included here
    ];

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}