<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    // Define fillable fields
    protected $fillable = [
        'first_name',
        'last_name',
        'designation',
        'organization',
        'email',
        'phone',
        'id_number',
        'visit_number',
        'host_name',
    ];
}
