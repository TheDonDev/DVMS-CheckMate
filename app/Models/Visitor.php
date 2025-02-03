<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    // Define fillable fields
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
        'host_name',
    ];
}
